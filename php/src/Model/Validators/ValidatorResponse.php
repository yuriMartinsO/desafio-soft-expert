<?php

namespace Manager\Model\Validators;

/**
 * Response of validator
 */
class ValidatorResponse
{
    /**
     * Errors of validator
     *
     * @var array
     */
    private $errors = [];

    /**
     * Get errors
     *
     * @return array
     */
    public function getErrors(): array
    {
        return (array) $this->errors;
    }

    /**
     * Set errors
     *
     * @param string $key
     * @param string $value
     * @return self
     */
    public function addError(string $value): self
    {
        $this->errors[] = $value;
        return $this;
    }
}