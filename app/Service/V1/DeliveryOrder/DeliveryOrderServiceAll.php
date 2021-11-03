<?php

namespace App\Service\V1\DeliveryOrder;

use App\Repository\V1\DeliveryOrder\DeliveryOrderRepository;

class DeliveryOrderServiceAll
{

    protected $categoryRepository;
    protected $userType;
    public function __construct(
        DeliveryOrderRepository $deliveryOrderRepository
    )
    {
        $this->deliveryOrderRepository = $deliveryOrderRepository;
    }

    public function all($searchQuery = null)
    {

        if(auth('api')->user()->user_type_id==1){
            $this->userType = 'consumer_id';
        }else{
            $this->userType = 'seller_id';
        }
        return $this->deliveryOrderRepository->all($this->userType, $searchQuery);
    }

}
