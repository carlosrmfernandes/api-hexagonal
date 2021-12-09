<?php

namespace App\Components\AddressByZipCode\Contracts;

interface AddressByZipCodeInterface
{

    /**
     * @param string $cep
     * @return Object
     */
    public function addressByZipCode(
        string $cep
    ): Object;
}
