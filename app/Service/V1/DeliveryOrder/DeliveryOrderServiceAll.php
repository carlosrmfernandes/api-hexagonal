<?php

namespace App\Service\V1\DeliveryOrder;

use App\Repository\V1\DeliveryOrder\DeliveryOrderRepository;

class DeliveryOrderServiceAll
{

    protected $categoryRepository;

    public function __construct(
        DeliveryOrderRepository $deliveryOrderRepository
    )
    {
        $this->deliveryOrderRepository = $deliveryOrderRepository;
    }

    public function all($searchQuery = null)
    {
        return $this->deliveryOrderRepository->all($searchQuery);
    }

}
