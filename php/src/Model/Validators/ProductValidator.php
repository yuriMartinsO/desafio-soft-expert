<?php

namespace Manager\Model\Validators;

use Manager\Model\Product;

/**
 * Class for validating product from request
 */
class ProductValidator
{
    /**
     * Constructor class
     *
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->validatorResponse = new ValidatorResponse();
    }

    /**
     * Validate the Product name
     */
    public function productNameIsValid()
    {
        if (!$this->product->name) {
            $this->validatorResponse->addError('ProductName', "Nome do produto não pode ser nulo!");
        }
    }

    /**
     * Validate if product is valid
     *
     * @return ValidatorResponse
     */
    public function validate(): ValidatorResponse
    {
        $this->productNameIsValid();

        return $this->validatorResponse;
    }
}