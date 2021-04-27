<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MovieFilters
 *
 * @author carlosfernandes
 */

namespace App\Filters\V1\DeliveryOrder;

use App\Service\V1\DeliveryOrder\DeliveryOrderServiceAll;

class DeliveryOrderFilters
{

    private $searchQuery;
    private $deliveryOrderServiceAll;

    public function __construct(
        DeliveryOrderServiceAll $deliveryOrderServiceAll
    )
    {
        $this->deliveryOrderServiceAll = $deliveryOrderServiceAll;
    }

    public function apply($request)
    {
        if (!empty($request['searchQuery'])) {
            $this->searchQuery = $request['searchQuery'];
        }

        return $this->deliveryOrderServiceAll->all($this->searchQuery);
    }

}
