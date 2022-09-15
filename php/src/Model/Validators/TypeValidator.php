<?php

namespace Manager\Model\Validators;

use Manager\Model\Type;

/**
 * Class for build types from request
 */
class TypeValidator
{
    /**
     * Constructor class
     *
     * @param Type $type
     */
    public function __construct(Type $type)
    {
        $this->type = $type;
        $this->validatorResponse = new ValidatorResponse();
    }

    /**
     * Validate the type name
     */
    public function typeNameIsValid()
    {
        if (!$this->type->name) {
            $this->validatorResponse->addError('TypeName', "Nome do tipo não pode ser nulo!");
        }
    }

    /**
     * Validate if Type is valid
     *
     * @return ValidatorResponse
     */
    public function validate(): ValidatorResponse
    {
        $this->typeNameIsValid();

        return $this->validatorResponse;
    }
}