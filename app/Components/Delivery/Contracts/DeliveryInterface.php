<?php

namespace App\Components\Delivery\Contracts;

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
