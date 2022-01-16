<?php

namespace App\Service\V1\DeliveryOrder;

use App\Repository\V1\Product\ProductRepository;
use App\Repository\V1\User\UserRepository;
use App\Repository\V1\DeliveryOrder\DeliveryOrderRepository;
use App\Service\V1\Notification\DeliveryOrderServiceNotificationSeller;
use App\Components\AddressByZipCode\Client as ClientAuthorizationAddressByZipCode;
use App\Components\EstimateDelivery\Client as ClientAuthorizationEstimateDelivery;
use App\Components\OpenDelivery\Client as ClientAuthorizationOpenDelivery;
use App\Models\DeliveryOrder;
use Validator;

class DeliveryOrderRegistration {

    use Traits\RuleTrait;

    protected $productRepository;
    protected $userRepository;
    protected $subCategoryRepository;
    protected $deliveryOrderRepository;
    protected $sellerId;
    protected $count = 1;
    protected $deliveryOrdersDone = [];
    protected $ordersForUpdateWithMotoboyID = [];
    protected $addressByZipCode;

    public function __construct(
    ProductRepository $productRepository, UserRepository $userRepository, DeliveryOrderRepository $deliveryOrderRepository
    ) {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->deliveryOrderRepository = $deliveryOrderRepository;
    }

    public function store($request, $orderOk = false) {
        $deliveryOrders = null;
        if (is_object($request)) {
            $deliveryOrders = $request->all();
        } else {
            $deliveryOrders = $request;
        }

        if ($deliveryOrders) {
            $orderEverythingOk = true;
            foreach ($deliveryOrders as $deliveryOrder) {
                foreach ($deliveryOrder as $key => $delivery_order) {
                    if (!get_object_vars(($this->productRepository->show($delivery_order['product_id'])))) {
                        return "product_id invalid";
                    }

                    $this->addressByZipCode = $this->addressByZipCode($delivery_order['cep']);

                    if (empty($this->addressByZipCode->cep)) {
                        return $this->addressByZipCode->scalar;
                    }

                    $validator = Validator::make($delivery_order, $this->rules());
                    if ($validator->fails()) {
                        return $validator->errors();
                    }

                    $delivery_order['state'] = $this->addressByZipCode->localidade;
                    $delivery_order['neighborhood'] = $this->addressByZipCode->bairro;
                    $delivery_order['street'] = $this->addressByZipCode->logradouro;
                    $delivery_order['amount_total'] = $delivery_order['quantity'] * $this->productRepository->show($delivery_order['product_id'])->price;

                    if ($orderOk) {
                        $delivery_order['status'] = 0;
                        $delivery_order['consumer_id'] = auth('api')->user()->id;
                        $this->deliveryOrdersDone[$key] = $delivery_order;
                        $this->deliveryOrdersDone[$key]['order_user'] = auth('api')->user();
                        $this->deliveryOrdersDone[$key]['product'] = $this->productRepository
                                ->show($delivery_order['product_id']);
                        $this->sellerId = $this->deliveryOrdersDone[$key]['product']->seller_id;
                        $delivery_order['seller_id'] = $this->sellerId;
                        $this->ordersForUpdateWithMotoboyID[$key] = $this->deliveryOrderRepository->save($delivery_order);
                    }
                }
            }

            if ($orderEverythingOk && $this->count == 1) {
                $this->count++;
                $this->store($deliveryOrders, true);
                $estimateDelivery = $this->estimateDelivery();
                if ($estimateDelivery->success) {
                    $openDelivery = $this->openDelivery($estimateDelivery);
                    if ($openDelivery->success) {
                        $this->ordersForUpdateWithMotoboyID($openDelivery);
                        $this->deliveryOrderServiceNotificationSeller();
                    }
                } else {
                    return 'Something went wrong';
                }
            }
        }

        return 'delivery orders done';
    }

    function deliveryOrderServiceNotificationSeller() {
        (new DeliveryOrderServiceNotificationSeller(
        $this->deliveryOrdersDone, $this->sellerId
        ))->notification();
    }

    function addressByZipCode($cep) {
        return app(ClientAuthorizationAddressByZipCode::class)->addressByZipCode($cep);
    }

    public function estimateDelivery() {

        $parameters = [
            "seller_id" => $this->deliveryOrdersDone[0]['product']['seller_id'],
            "endereco_desejado" => $this->addressByZipCode->logradouro,
            "bairro_desejado" => $this->addressByZipCode->bairro,
            "cidade_desejado" => $this->addressByZipCode->localidade
        ];
        return app(ClientAuthorizationEstimateDelivery::class)->delivery($parameters);
    }

    function openDelivery($estimateDelivery) {
        $parameters = [
            "forma_pagamento" => config('taximachine')['forma_pagamento'],
            "empresa_id" => config('taximachine')['empresa_id'],
            "retorno" => false,
            "estimativas" => [
                "estimativa_km" => $estimateDelivery->response->estimativa_km,
                "estimativa_minutos" => $estimateDelivery->response->estimativa_minutos,
                "estimativa_valor" => $estimateDelivery->response->estimativa_valor
            ],
            "partida" => [
                "endereco" => $this->deliveryOrdersDone[0]['product']['user']['address']['street'] . ', ' . $this->deliveryOrdersDone[0]['product']['user']['address']['street_number'],
                "bairro" => $this->deliveryOrdersDone[0]['product']['user']['address']['neighborhood'],
                "cidade" => $this->deliveryOrdersDone[0]['product']['user']['address']['state'],
                "referencia" => $this->deliveryOrdersDone[0]['product']['user']['address']['complement'],
                "lat" => $estimateDelivery->response->partida->lat,
                "lng" => $estimateDelivery->response->partida->lng
            ],
            "paradas" => [
                [
                    "nome_cliente_parada" => $this->deliveryOrdersDone[0]['order_user']['name'],
                    "telefone_cliente_parada" => $this->deliveryOrdersDone[0]['order_user']['phone'],
                    "id_externo" => 1,
                    "endereco_parada" => $this->deliveryOrdersDone[0]['street'] . ', ' . $this->deliveryOrdersDone[0]['street_number'],
                    "bairro_parada" => $this->deliveryOrdersDone[0]['neighborhood'],
                    "cidade_parada" => $this->deliveryOrdersDone[0]['state'],
                    "lat_parada" => $estimateDelivery->response->desejado->lat,
                    "lng_parada" => $estimateDelivery->response->desejado->lng,
                ]
            ]
        ];
        
        return app(ClientAuthorizationOpenDelivery::class)->delivery($parameters);
    }

    function ordersForUpdateWithMotoboyID($openDelivery) {

        foreach ($this->ordersForUpdateWithMotoboyID as $key => $value) {

            $deliveryOrder = DeliveryOrder::find($value['id']);
            if ($deliveryOrder) {
                $deliveryOrder = $deliveryOrder->update([
                    'id_mch' => $openDelivery->response->id_mch,
                ]);
            }
        }
    }

}
