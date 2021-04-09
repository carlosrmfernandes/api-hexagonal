<?php

namespace App\Components\MercadoPagoIntegration\Contracts;

interface MercadoPagoInterface
{

    /**
     * @param $request
     * @return Object
     */
    public function generatePayment(
        $request
    ): Object;

    /**
     * @param $request
     * @return Object
     */
    public function getIdentificationType(): Object;
}
