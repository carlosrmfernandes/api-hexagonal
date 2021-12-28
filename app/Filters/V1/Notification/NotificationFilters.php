<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MovieFilters
 *
 * @author carlosfernandes
 */

namespace App\Filters\V1\Notification;

use App\Service\V1\Notification\NotificationServiceAll;

class NotificationFilters
{

    private $searchQuery;
    private $notificationServiceAll;

    public function __construct(
        NotificationServiceAll $notificationServiceAll
    )
    {
        $this->notificationServiceAll = $notificationServiceAll;
    }

    public function apply($request)
    {
        if (!empty($request['searchQuery'])) {
            $this->searchQuery = $request['searchQuery'];
        }
        return $this->notificationServiceAll->all($this->searchQuery);
    }

}
