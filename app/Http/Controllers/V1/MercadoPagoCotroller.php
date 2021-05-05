<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Components\MercadoPagoIntegration\Client as ClientAuthorization;

class MercadoPagoCotroller extends Controller
{
    public function __construct()
    {

    }

    /**
     * storeCustomer a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCustomer(Request $request): object
    {
        return response()->json(['data' => app(ClientAuthorization::class)->createsCustomer($request)]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): object
    {
        return response()->json(['data' => app(ClientAuthorization::class)->generatePayment($request)]);
    }

    /**
     * storeCustomer a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCard(Request $request, $customerID): object
    {
        return response()->json(['data' => app(ClientAuthorization::class)->createsCard($request, $customerID)]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showIdentificationType()
    {
        return response()->json(['data' => app(ClientAuthorization::class)->getIdentificationType()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCustomer($id)
    {
        return response()->json(['data' => app(ClientAuthorization::class)->getCustomer($id)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['data' => app(ClientAuthorization::class)->generatePayment($id)]);
    }

    /**
     * Display the resource from specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCards($customerID)
    {
        return response()->json(['data' => app(ClientAuthorization::class)->getCards($customerID)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCard($customerID)
    {
        return response()->json(['data' => app(ClientAuthorization::class)->deleteCard($customerID)]);
    }

}
