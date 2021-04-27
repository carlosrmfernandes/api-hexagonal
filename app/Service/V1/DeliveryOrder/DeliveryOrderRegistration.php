<?php

namespace App\Service\V1\DeliveryOrder;

use App\Repository\V1\Product\ProductRepository;
use App\Repository\V1\User\UserRepository;
use App\Repository\V1\DeliveryOrder\DeliveryOrderRepository;

use Validator;

class DeliveryOrderRegistration
{

    use Traits\RuleTrait;

    protected $productRepository;
    protected $userRepository;
    protected $subCategoryRepository;
    protected $deliveryOrderRepository;
    protected $count = 1;

    public function __construct(
        ProductRepository $productRepository,
        UserRepository $userRepository,
        DeliveryOrderRepository $deliveryOrderRepository

    ) {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->deliveryOrderRepository = $deliveryOrderRepository;
    }

    public function store($request, $orderOk = null)
    {
        $deliveryOrders = null;

        if (is_object($request)) {
            $deliveryOrders = $request->all();
        } else {
            $deliveryOrders = $request;
        }

        if ($deliveryOrders) {
            $orderEverythingOk = true;
            foreach ($deliveryOrders as $deliveryOrder) {
                foreach ($deliveryOrder as $delivery_order) {
                    if (!get_object_vars(($this->productRepository->show($delivery_order['product_id'])))) {
                        return "product_id invalid";
                    }
                    if (
                        $delivery_order['quantity'] == '' ||
                        $delivery_order['quantity'] < 1 ||
                        $delivery_order['delivery_address'] == ''
                    ) {
                        return "invalid quantity, delivery_address or price";
                    }

                    if ($orderOk) {
                        $delivery_order['user_id'] = auth()->user()->id;
                        $delivery_order['status'] = 0;
                        $this->deliveryOrderRepository->save($delivery_order);
                    }
                }
            }

            if ($orderEverythingOk && $this->count == 1) {
                $this->count++;
                $this->store($deliveryOrders, true);
            }
        }
        return 'delivery orders done';
    }
}
