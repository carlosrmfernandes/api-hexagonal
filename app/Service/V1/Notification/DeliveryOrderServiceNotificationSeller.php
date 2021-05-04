<?php

namespace App\Service\V1\Notification;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Models\User;
use App\Jobs\JobDeliveryOrderNotificationSeller;

class DeliveryOrderServiceNotificationSeller
{

    private $deliveryOrder;
    private $sellerId;

    public function __construct($deliveryOrder,$sellerId)
    {
        $this->deliveryOrder = $deliveryOrder;
        $this->sellerId = $sellerId;
    }

    public function notification()
    {
        $seller = User::find($this->sellerId);
        if($seller){
            JobDeliveryOrderNotificationSeller::dispatch($seller, $this->deliveryOrder)
            ->delay(now()
                ->addSecond('15'));
        }
    }
}
