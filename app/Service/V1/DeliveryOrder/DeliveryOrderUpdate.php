<?php

namespace App\Service\V1\DeliveryOrder;

use App\Repository\V1\DeliveryOrder\DeliveryOrderRepository;
use App\Events\ConsumerOrderDeliveryStatusEvent;
use Illuminate\Http\Request;
use App\Components\AddressByZipCode\Client as ClientAuthorizationAddressByZipCode;
use Validator;

class DeliveryOrderUpdate {

    use Traits\RuleTrait;

    protected $deliveryOrderRepository;

    public function __construct(
    DeliveryOrderRepository $deliveryOrderRepository
    ) {
        $this->deliveryOrderRepository = $deliveryOrderRepository;
    }

    public function update(int $id, Request $request) {
        $attributes = $request->all();

        $validator = Validator::make($attributes, $this->rules($id));

        if ($validator->fails()) {
            return $validator->errors();
        }

        if (!get_object_vars(($this->deliveryOrderRepository->show('seller_id', $id)))) {
            return "Order invalid";
        }

        if (!get_object_vars(($this->deliveryOrderRepository->verifyOrderSeller($id, $attributes['product_id'])))) {
            return "Order does not belong to this seller";
        }

        $addressByZipCode = app(ClientAuthorizationAddressByZipCode::class)->addressByZipCode($attributes['cep']);

        if (!$addressByZipCode) {
            return (object) "error looking up address via zip code";
        }
        $attributes['state'] = $addressByZipCode->localidade;
        $attributes['neighborhood'] = $addressByZipCode->bairro;
        $attributes['street'] = $addressByZipCode->logradouro;
        
        $deliveryOrder = $this->deliveryOrderRepository->update($id, $attributes);

        if ($deliveryOrder) {
            broadcast(new ConsumerOrderDeliveryStatusEvent($deliveryOrder->consumer_id, $deliveryOrder));
            return $deliveryOrder;
        }

        return "Order invalid";
    }

}
