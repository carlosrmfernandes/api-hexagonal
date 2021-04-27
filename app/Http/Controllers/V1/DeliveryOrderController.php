<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Service\V1\DeliveryOrder\DeliveryOrderRegistration;
use App\Service\V1\DeliveryOrder\DeliveryOrderShow;
use App\Service\V1\DeliveryOrder\DeliveryOrderUpdate;
use App\Filters\V1\DeliveryOrder\DeliveryOrderFilters;
use App\Http\Controllers\Controller;




class DeliveryOrderController extends Controller
{
    protected $deliveryOrderRegistration;
    protected $deliveryOrderShow;
    protected $deliveryOrderFilters;
    protected $deliveryOrderUpdate;

    public function __construct(

        DeliveryOrderRegistration $deliveryOrderRegistration,
        DeliveryOrderShow $deliveryOrderShow,
        DeliveryOrderFilters $deliveryOrderFilters,
        DeliveryOrderUpdate $deliveryOrderUpdate

    ) {
        $this->deliveryOrderRegistration = $deliveryOrderRegistration;
        $this->deliveryOrderShow = $deliveryOrderShow;
        $this->deliveryOrderFilters = $deliveryOrderFilters;
        $this->deliveryOrderUpdate = $deliveryOrderUpdate;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $deliveryOrders = $this->deliveryOrderFilters->apply($request->all());
        return response()->json(['data' => $deliveryOrders]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $deliveryOrder = $this->deliveryOrderRegistration->store($request);

        return response()->json(['data' => $deliveryOrder]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deliveryOrder = $this->deliveryOrderShow->show($id);

        return response()->json(['data' => $deliveryOrder]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        $deliveryOrder = $this->deliveryOrderUpdate->update($id, $request);
        return response()->json(['data' => $deliveryOrder]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
