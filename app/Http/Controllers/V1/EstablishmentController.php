<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Service\V1\Establishment\EstablishmentServiceShow;
use App\Service\V1\Establishment\EstablishmentServiceAll;
use App\Filters\V1\Establishment\EstablishmentFilters;
use App\Http\Controllers\Controller;


class EstablishmentController extends Controller
{
    protected $establishmentServiceShow;
    protected $establishmentServiceAll;
    protected $establishmentFilters;

    public function __construct(

        EstablishmentServiceShow $establishmentServiceShow,
        EstablishmentServiceAll $establishmentServiceAll,
        EstablishmentFilters $establishmentFilters

    ) {
        $this->establishmentServiceShow = $establishmentServiceShow;
        $this->establishmentServiceAll = $establishmentServiceAll;
        $this->establishmentFilters = $establishmentFilters;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $establishment = $this->establishmentFilters->apply($request->all());
        return response()->json(['data' => $establishment]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $establishmentWithProduct = $this->establishmentServiceShow->show($id);

        return response()->json(['data' => $establishmentWithProduct]);
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
