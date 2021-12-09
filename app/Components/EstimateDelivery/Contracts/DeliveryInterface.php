<?php

namespace App\Components\EstimateDelivery\Contracts;

interface DeliveryInterface
{

    /**
     * @param array $data
     * @return Object
     */
    public function delivery(
        array $data
    ): Object;
}
