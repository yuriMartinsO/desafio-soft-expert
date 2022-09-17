<?php

namespace Manager\Controller;

use Manager\Model\RequestBuilders\OrderRequestBuilder;
use Manager\Model\Order;
use Manager\Model\OrderProduct;
use Manager\Model\RequestBuilders\OrderProductRequestBuilder;
use Manager\Model\Validators\OrderValidator;

/**
 * Controller class of order
 */
class OrderController
{
    public function buildOrderProduct($productItemsArrayInfo)
    {
        $orderProducts = [];
        foreach ($productItemsArrayInfo as $info) {
            if (!$info) {
                continue;
            }

            $orderProduct = new OrderProduct();
            $orderProductRequestBuilder = new OrderProductRequestBuilder($orderProduct);
            $orderProducts[] = $orderProductRequestBuilder->build((array) $info);
        }

        return $orderProducts;
    }

    /**
     * Create a new order
     *
     * @return string
     */
    public function create(): string
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data) {
            http_response_code(400);
            return json_encode([
                'error' => true,
                'errorsMessages' => 'Nenhum dado foi recebido'
            ]);
        }

        $orderProducts = $this->buildOrderProduct($data['productItemsArrayInfo']);
        $data = [
            'total_tax' => 0,
            'total_product' => 0,
            'total' => 0
        ];

        foreach ($orderProducts as $orderProduct) {
            $data['total_tax'] += $orderProduct['tax_total'];
            $data['total_product'] += $orderProduct['product_total'];
            $data['total'] += $orderProduct['total'];
        }

        $orderBuilder = new OrderRequestBuilder(new Order());
        $order = $orderBuilder->build($data);

        $validator = (new OrderValidator($order))->validate();
        if ($validator->getErrors()) {
            http_response_code(400);
            return json_encode([
                'error' => true,
                'errorsMessages' => $validator->getErrors()
            ]);
        }

        try {
            $saved = $order->save();
        } catch (\Exception $e) {
            http_response_code(400);
            return json_encode([
                'error' => true,
                'errorsMessages' => $e->getMessage()
            ]);
        }

        if (!$saved) {
            http_response_code(500);
            return json_encode([
                'error' => true,
                'errorsMessages' => 'Não foi possível cadastrar pedido'
            ]);
        }

        foreach ($orderProducts as $orderProduct) {
            $orderProduct->order = (int) $order->id;
            $orderProduct->save();
        }

        http_response_code(201);
        return json_encode([
            'error' => false,
            'data' => [
                'order' => $order->toArray(),
                'orderProduct' => $orderProducts
            ]
        ]);
    }
}