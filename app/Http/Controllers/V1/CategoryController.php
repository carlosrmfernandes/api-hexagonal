<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Service\V1\Category\CategoryServiceShow;
use App\Service\V1\Category\CategoryServiceAll;
use App\Service\V1\Category\CategoryServiceWithEstablishment;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{
    protected $categoryServiceShow;
    protected $categoryServiceAll;
    protected $categoryServiceWithEstablishment;

    public function __construct(

        CategoryServiceShow $categoryServiceShow,
        CategoryServiceAll $categoryServiceAll,
        CategoryServiceWithEstablishment $categoryServiceWithEstablishment

    ) {
        $this->categoryServiceShow = $categoryServiceShow;
        $this->categoryServiceAll = $categoryServiceAll;
        $this->categoryServiceWithEstablishment = $categoryServiceWithEstablishment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryServiceAll = $this->categoryServiceAll->all();

        return response()->json(['data' => $categoryServiceAll]);
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
        $product = $this->categoryServiceShow->show($id);

        return response()->json(['data' => $product]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function categoryWithEstablishment($id)
    {

        $categoryWithEstablishment = $this->categoryServiceWithEstablishment->categoryServiceWithEstablishment($id);

        return response()->json(['data' => $categoryWithEstablishment]);
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
