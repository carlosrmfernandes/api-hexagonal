<?php
namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Filters\V1\Notification\NotificationFilters;
use App\Service\V1\Notification\NotificationServiceShow;
use App\Service\V1\Notification\NotificationNotRead;
use App\Service\V1\Notification\NotificationReadDone;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $notificationFilters;

    public function __construct(
        NotificationFilters $notificationFilters,
        NotificationServiceShow $notificationServiceShow,
        NotificationNotRead $notificationNotRead,
        NotificationReadDone $notificationReadDone

    ) {
        $this->notificationFilters = $notificationFilters;
        $this->notificationServiceShow = $notificationServiceShow;
        $this->notificationNotRead = $notificationNotRead;
        $this->notificationReadDone = $notificationReadDone;
    }
    public function index(Request $request)
    {
        $notification = $this->notificationFilters->apply($request->all());
        return response()->json(['data' => $notification]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = $this->notificationServiceShow->show($id);

        return response()->json(['data' => $notification]);
    }

    public function notificationNotRead()
    {
        $notification = $this->notificationNotRead->notificationNotRead();

        return response()->json(['data' => $notification]);
    }

    public function notificationReadDone()
    {
        $notification = $this->notificationReadDone->notificationReadDone();

        return response()->json(['data' => $notification]);
    }

}
