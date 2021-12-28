<?php

namespace App\Repository\V1\Notification;

use App\Models\Notification;
use App\Repository\V1\BaseRepository;
use Illuminate\Support\Facades\DB;

class NotificationRepository extends BaseRepository
{

    public function __construct(Notification $user)
    {
        parent::__construct($user);
    }

    public function all($searchQuery = null): object
    {
        if ($searchQuery) {
            return $this->obj
                            ->where('notifiable_id',auth('api')->user()->id)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
        }
        return $this->obj
                        ->where('notifiable_id',auth('api')->user()->id)
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
    }

    public function show($id): object
    {
        DB::beginTransaction();
        try {
            $notification = $this->obj->find($id);
            if ($notification) {
                $notification->update([
                    'read_at' => date("Y-m-d H:i:s"),
                ]);
            }
            DB::commit();
            return  (object) $notification;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function notificationNotRead():object
    {
        $notification = $this->obj->where('notifiable_id', auth('api')->user()->id)
            ->whereNull('read_at')
            ->paginate(10);

        return  (object) $notification;
    }

    public function notificationReadDone():object
    {
        $notification = $this->obj->where('notifiable_id', auth('api')->user()->id)
            ->whereNotNull('read_at')
            ->paginate(10);

        return  (object) $notification;
    }
}
