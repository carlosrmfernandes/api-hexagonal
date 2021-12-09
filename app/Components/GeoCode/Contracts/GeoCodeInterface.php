<?php

namespace App\Components\GeoCode\Contracts;

interface GeoCodeInterface
{

    /**
     * @param array $data
     * @return Object
     */
    public function geoCode(
        array $data
    ): Object;
}
