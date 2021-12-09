<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConsumerOrderDeliveryStatusEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    protected $orderNewStatus;
    protected $userId;

    public function __construct($userId, $orderNewStatus)
    {
        $this->orderNewStatus = $orderNewStatus;
        $this->userId = $userId;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('channel-consumer-order-delivery-status.'.$this->userId);
    }

    public function broadcastAs()
    {
        return 'ConsumerOrderDeliveryStatusEvent';
    }

    public function broadcastWith()
    {
        return [
            'orderNewStatus' => $this->orderNewStatus
        ];
    }
}
