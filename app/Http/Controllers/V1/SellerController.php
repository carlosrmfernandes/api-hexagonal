<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Service\V1\Seller\SellerServiceShow;
use App\Service\V1\Seller\SellerServiceAll;
use App\Filters\V1\Seller\SellerFilters;
use App\Http\Controllers\Controller;
use App\Service\V1\Seller\SellerWithProductsService;
use App\Service\V1\Seller\SellerServiceShowSubCategoryWithProduct;

class SellerController extends Controller
{
    protected $sellerServiceShow;
    protected $sellerServiceAll;
    protected $sellerFilters;
    protected $sellerWithProductsService;
    protected $sellerServiceShowSubCategoryWithProduct;

    public function __construct(

        SellerServiceShow $sellerServiceShow,
        SellerServiceAll $sellerServiceAll,
        SellerFilters $sellerFilters,
        SellerWithProductsService $sellerWithProductsService,
        SellerServiceShowSubCategoryWithProduct $sellerServiceShowSubCategoryWithProduct

    ) {
        $this->sellerServiceShow = $sellerServiceShow;
        $this->sellerServiceAll = $sellerServiceAll;
        $this->sellerFilters = $sellerFilters;
        $this->sellerWithProductsService = $sellerWithProductsService;
        $this->sellerServiceShowSubCategoryWithProduct = $sellerServiceShowSubCategoryWithProduct;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $seller = $this->sellerFilters->apply($request->all());
        return response()->json(['data' => $seller]);
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
        $seller = $this->sellerServiceShow->show($id);

        return response()->json(['data' => $seller]);
    }

    public function sellerWithProducts($id)
    {
        $seller = $this->sellerWithProductsService->sellerWithProducts($id);

        return response()->json(['data' => $seller]);
    }

    public function showSubCategoryWithProduct($id)
    {
        $sellerSubCategoryWithProduct = $this->sellerServiceShowSubCategoryWithProduct->showSubCategoryWithProduct($id);

        return response()->json(['data' => $sellerSubCategoryWithProduct]);
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
