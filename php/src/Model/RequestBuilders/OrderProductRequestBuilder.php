<?php

namespace Manager\Model\RequestBuilders;

use Manager\Model\Order;
use Manager\Model\OrderProduct;
use Manager\Model\Product;
use Manager\Model\Type;

/**
 * Class for build product orderProducts from request
 */
class OrderProductRequestBuilder
{
    /**
     * Constructor class
     *
     * @param OrderProduct $orderProduct
     */
    public function __construct(OrderProduct $orderProduct)
    {
        $this->orderProduct = $orderProduct;
    }

    /**
     * Build object by request datas
     *
     * @param array $arrayData
     * @return OrderProduct
     */
    public function build(array $arrayData): OrderProduct
    {
        $product = Product::where('id', $arrayData['productId'])->first();
        $type = Type::where('id', $product->type_id)->first();
        $quantity = $arrayData['quantity'];

        $price = $product->price;
        $taxValue = $type->tax_value;

        $this->orderProduct->order = 0;
        $this->orderProduct->product_id = $product->id;
        $this->orderProduct->type_id = $type->id;
        $this->orderProduct->product_total = $price * $quantity;
        $this->orderProduct->tax_total = $price * ($taxValue/100) * $quantity;
        $this->orderProduct->quantity = $quantity;
        $this->orderProduct->total = $this->orderProduct->product_total + $this->orderProduct->tax_total;

        return $this->orderProduct;
    }
}