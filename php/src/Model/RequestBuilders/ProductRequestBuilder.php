<?php

namespace Manager\Model\RequestBuilders;

use Manager\Model\Product;

/**
 * Class for build products from request
 */
class ProductRequestBuilder
{
    /**
     * Constructor class
     *
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Build object by request datas
     *
     * @param array $arrayData
     * @return Product
     */
    public function build(array $arrayData): Product
    {
        $this->product->name = (string) $arrayData['name'];
        $this->product->type_id = (int) $arrayData['type_id'];
        $this->product->price = (float) $arrayData['price'];

        return $this->product;
    }
}