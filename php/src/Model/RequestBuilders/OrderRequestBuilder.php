<?php

namespace Manager\Model\RequestBuilders;

use Manager\Model\Order;

/**
 * Class for build orders from request
 */
class OrderRequestBuilder
{
    /**
     * Constructor class
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build object by request datas
     *
     * @param array $arrayData
     * @return Order
     */
    public function build(array $arrayData): Order
    {
        $this->order->total_tax = (float) $arrayData['total_tax'];
        $this->order->total_product = (float) $arrayData['total_product'];
        $this->order->total = (float) $arrayData['total'];

        return $this->order;
    }
}