<?php

namespace App\Repository\V1\SubCategory;
use Illuminate\Support\Facades\DB;
use App\Models\SubCategory;
use App\Models\User;
use App\Repository\V1\BaseRepository;

class SubCategoryRepository extends BaseRepository
{

    public function __construct(SubCategory $subCategory)
    {
        parent::__construct($subCategory);
    }

    public function show(int $id): object
    {
        return (object) $this->obj
            ->where('id', $id)
            ->first();
    }

    public function showSubcategory(int $id): object
    {
        return (object) $this->obj
            ->where('category_id', $id)
            ->get();
    }

    public function showSubCategoryWithProduct(int $id)
     {
         return [
             'seller' => User::where('id', $id)->first(),
             'data' => (object) $this->obj
                 ->with(['products'=> function($query) use ($id){
                    $query->where('seller_id', $id);
                 }])
                 ->get()
         ];
     }
}
