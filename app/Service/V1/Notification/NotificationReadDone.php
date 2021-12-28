<?php

namespace App\Service\V1\Notification;

use App\Repository\V1\Notification\NotificationRepository;

class NotificationReadDone
{

    protected $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository
    )
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function notificationReadDone()
    {
        return $this->notificationRepository->notificationReadDone();
    }

}
