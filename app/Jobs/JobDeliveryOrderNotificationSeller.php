<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Notifications\DeliveryOrderNotificationSeller;

class JobDeliveryOrderNotificationSeller implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $seller;
    public $deliveryOrder;
    public function __construct($seller,$deliveryOrder)
    {
        $this->seller = $seller;
        $this->deliveryOrder = $deliveryOrder;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->seller
                ->notify(new DeliveryOrderNotificationSeller
                        ($this->deliveryOrder)
        );
    }
}
