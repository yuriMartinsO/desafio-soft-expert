<?php

namespace Manager\Model\Validators;

use Manager\Model\Order;

/**
 * Class for validating order from request
 */
class OrderValidator
{
    /**
     * Constructor class
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->validatorResponse = new ValidatorResponse();
    }

    /**
     * Validate the Order total
     */
    public function orderHasTotal()
    {
        if (!$this->order->total) {
            $this->validatorResponse->addError("Valor da venda não pode ser gratuito!");
        }
    }

    /**
     * Validate if order is valid
     *
     * @return ValidatorResponse
     */
    public function validate(): ValidatorResponse
    {
        $this->orderHasTotal();

        return $this->validatorResponse;
    }
}