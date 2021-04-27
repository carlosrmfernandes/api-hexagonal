<?php

namespace App\Service\V1\DeliveryOrder;

use App\Repository\V1\DeliveryOrder\DeliveryOrderRepository;

class DeliveryOrderShow
{

    protected $deliveryOrderRepository;

    public function __construct(
        DeliveryOrderRepository $deliveryOrderRepository
    )
    {
        $this->deliveryOrderRepository = $deliveryOrderRepository;
    }

    public function show(int $id)
    {
        return $this->deliveryOrderRepository->show($id);
    }

}
