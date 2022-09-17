<?php

namespace Tests;

use Manager\Model\Order;
use PHPUnit\Framework\TestCase;
use Manager\Model\Validators\OrderValidator;

class OrderValidatorTest extends TestCase
{
    public function testValidateMethodIsInvalid()
    {
        $orderValidator = new OrderValidator(new Order());

        $invalid = (bool) $orderValidator->validate()->getErrors();
        $this->assertTrue($invalid);
    }

    public function testValidateMethodIsvalid()
    {
        $order = new Order();
        $order->total = 400;

        $orderValidator = new OrderValidator($order);

        $invalid = (bool) $orderValidator->validate()->getErrors();
        $this->assertFalse($invalid);
    }
}