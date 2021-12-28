<?php

namespace App\Components\OpenDelivery\Contracts;

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
