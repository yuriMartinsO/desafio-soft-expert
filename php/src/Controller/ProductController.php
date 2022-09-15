<?php

namespace Manager\Controller;

use Manager\Model\RequestBuilders\ProductRequestBuilder;
use Manager\Model\Product;
use Manager\Model\Validators\ProductValidator;

/**
 * Controller class of product
 */
class ProductController
{
    /**
     * Create a new product
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

        $productBuilder = new ProductRequestBuilder(new Product());
        $product = $productBuilder->build($data);

        $validator = (new ProductValidator($product))->validate();
        if ($validator->getErrors()) {
            http_response_code(400);
            return json_encode([
                'error' => true,
                'errorsMessages' => $validator->getErrors()
            ]);
        }

        try {
            $saved = $product->save();
        } catch (\Exception $e) {
            http_response_code(500);
            return json_encode([
                'error' => true,
                'errorsMessages' => $e->getMessage()
            ]);
        }

        if (!$saved) {
            http_response_code(500);
            return json_encode([
                'error' => true,
                'errorsMessages' => 'Não foi possível cadastrar produto'
            ]);
        }

        http_response_code(201);
        return json_encode([
            'error' => false,
            'data' => $product->toArray()
        ]);
    }
}