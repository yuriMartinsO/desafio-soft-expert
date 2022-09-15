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
        $productBuilder = new ProductRequestBuilder(new Product());
        $product = $productBuilder->build($_POST);

        $validator = (new ProductValidator($product))->validate();
        if ($validator->getErrors()) {
            return json_encode([
                'error' => true,
                'errorsMessages' => $validator->getErrors()
            ]);
        }

        try {
            $saved = $product->save();
        } catch (\Exception $e) {
            return json_encode([
                'error' => true,
                'errorsMessages' => $e->getMessage()
            ]);
        }

        if (!$saved) {
            return json_encode([
                'error' => true,
                'errorsMessages' => 'Não foi possível cadastrar produto'
            ]);
        }

        return json_encode([
            'error' => false,
            'data' => $product->toArray()
        ]);
    }
}