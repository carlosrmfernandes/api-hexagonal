<?php

namespace App\Service\V1\DeliveryOrder;

use App\Repository\V1\Product\ProductRepository;
use App\Repository\V1\User\UserRepository;
use App\Repository\V1\DeliveryOrder\DeliveryOrderRepository;
use App\Service\V1\Notification\DeliveryOrderServiceNotificationSeller;
use Illuminate\Support\Facades\Log;
use Validator;

class DeliveryOrderRegistration
{

    use Traits\RuleTrait;

    protected $productRepository;
    protected $userRepository;
    protected $subCategoryRepository;
    protected $deliveryOrderRepository;
    protected $sellerId;
    protected $count = 1;
    protected $deliveryOrdersDone = [];

    public function __construct(
        ProductRepository $productRepository,
        UserRepository $userRepository,
        DeliveryOrderRepository $deliveryOrderRepository

    ) {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->deliveryOrderRepository = $deliveryOrderRepository;
    }

    public function store($request, $orderOk = false)
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
                foreach ($deliveryOrder as $key=>$delivery_order) {
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
                        $delivery_order['status'] = 0;
                        $delivery_order['user_id'] = auth()->user()->id;
                        $this->deliveryOrdersDone[$key] = $delivery_order;
                        $this->deliveryOrdersDone[$key]['order_user'] = auth()->user();
                        $this->deliveryOrdersDone[$key]['product'] = $this->productRepository
                            ->show($delivery_order['product_id']);
                        $this->sellerId=$this->deliveryOrdersDone[$key]['product']->user_id;
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

    function deliveryOrderServiceNotificationSeller()
    {
        (new DeliveryOrderServiceNotificationSeller(
            $this->deliveryOrdersDone,
            $this->sellerId
        ))->notification();
    }
}
