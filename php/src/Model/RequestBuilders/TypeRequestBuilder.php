<?php

namespace Manager\Model\RequestBuilders;

use Manager\Model\Type;

/**
 * Class for build types from request
 */
class TypeRequestBuilder
{
    /**
     * Constructor class
     *
     * @param Type $type
     */
    public function __construct(Type $type)
    {
        $this->type = $type;
    }

    /**
     * Build object by request datas
     *
     * @param array $arrayData
     * @return Type
     */
    public function build(array $arrayData): Type
    {
        $this->type->name = (string) $arrayData['name'];
        $this->type->tax_value = (float) $arrayData['tax_value'];

        return $this->type;
    }
}