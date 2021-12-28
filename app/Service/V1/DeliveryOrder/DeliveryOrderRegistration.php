<?php

namespace App\Service\V1\DeliveryOrder;

use App\Repository\V1\Product\ProductRepository;
use App\Repository\V1\User\UserRepository;
use App\Repository\V1\DeliveryOrder\DeliveryOrderRepository;
use App\Service\V1\Notification\DeliveryOrderServiceNotificationSeller;
use App\Components\AddressByZipCode\Client as ClientAuthorizationAddressByZipCode;
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
                    $validator = Validator::make($delivery_order, $this->rules());
                    if ($validator->fails()) {
                        return $validator->errors();
                    }

                    $addressByZipCode = app(ClientAuthorizationAddressByZipCode::class)->addressByZipCode($delivery_order['cep']);

                    if (!$addressByZipCode) {
                        return (object) "error looking up address via zip code";
                    }
                    
                    $delivery_order['state'] = $addressByZipCode->localidade;
                    $delivery_order['neighborhood'] = $addressByZipCode->bairro;
                    $delivery_order['street'] = $addressByZipCode->logradouro;

                    if ($orderOk) {
                        $delivery_order['status'] = 0;
                        $delivery_order['consumer_id'] = auth('api')->user()->id;
                        $this->deliveryOrdersDone[$key] = $delivery_order;
                        $this->deliveryOrdersDone[$key]['order_user'] = auth('api')->user();
                        $this->deliveryOrdersDone[$key]['product'] = $this->productRepository
                                ->show($delivery_order['product_id']);
                        $this->sellerId = $this->deliveryOrdersDone[$key]['product']->seller_id;
                        $delivery_order['seller_id'] = $this->sellerId;

                        $this->deliveryOrderRepository->save($delivery_order);
                    }
                }
            }

            if ($orderEverythingOk && $this->count == 1) {
                $this->count++;
                $this->store($deliveryOrders, true);
                $this->deliveryOrderServiceNotificationSeller();
            }
        }

        return 'delivery orders done';
    }

    function deliveryOrderServiceNotificationSeller() {
        (new DeliveryOrderServiceNotificationSeller(
        $this->deliveryOrdersDone, $this->sellerId
        ))->notification();
    }

}
