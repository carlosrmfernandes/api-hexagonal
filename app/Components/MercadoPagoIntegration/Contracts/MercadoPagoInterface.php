<?php

namespace App\Components\MercadoPagoIntegration\Contracts;

interface MercadoPagoInterface
{

    /**
     * @param int $id
     * @return Object
     */
    public function generateWeather(
        int $id
    ): Object;
}
