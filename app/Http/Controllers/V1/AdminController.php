<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Report\AdminReport;
use App\Http\Controllers\Controller;
use App\Service\V1\Admin\AdminService;
use App\Report\Traits\RuleTrait;
use Validator;

class AdminController extends Controller {

    use RuleTrait;

    public $adminService;

    public function __construct(AdminService $adminService
    ) {
        $this->adminService = $adminService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    public function sellerWithProducts($id) {
        
    }

    public function showSubCategoryWithProduct($id) {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request) {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
    }

    public function export(Request $request) {

        $parameters = $request->all();
        $validator = Validator::make($parameters, $this->rules());
        if ($validator->fails()) {
            return $validator->errors();
        }

        return Excel::download(new AdminReport($parameters), 'relatorio.xlsx');
    }

    public function isActive($sellerId, Request $request) {
        
        $seller = $this->adminService->isActiveSeller($sellerId, $request);

        return response()->json(['data' => $seller]);
    }

}
