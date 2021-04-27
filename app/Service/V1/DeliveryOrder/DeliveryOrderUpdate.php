<?php

namespace App\Service\V1\DeliveryOrder;

use App\Repository\V1\DeliveryOrder\DeliveryOrderRepository;
use Illuminate\Http\Request;
use Validator;

class DeliveryOrderUpdate
{

    use Traits\RuleTrait;

    protected $deliveryOrderRepository;

    public function __construct(
        DeliveryOrderRepository $deliveryOrderRepository

    ) {
        $this->deliveryOrderRepository = $deliveryOrderRepository;
    }

    public function update(int $id, Request $request)
    {
        $attributes = $request->all();

        $validator = Validator::make($attributes, $this->rules($id));

        if ($validator->fails()) {
            return $validator->errors();
        }

        if (!get_object_vars(($this->deliveryOrderRepository->show($id)))) {
            return "delivery order invalid";
        }

        return $this->deliveryOrderRepository->update($id, $attributes);
    }
}
