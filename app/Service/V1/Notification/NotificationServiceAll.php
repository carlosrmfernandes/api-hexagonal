<?php

namespace App\Service\V1\Notification;

use App\Repository\V1\Notification\NotificationRepository;

class NotificationServiceAll
{

    protected $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository
    )
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function all($searchQuery = null)
    {
        return $this->notificationRepository->all($searchQuery);
    }

}
