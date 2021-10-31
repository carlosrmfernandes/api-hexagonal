<?php

namespace App\Service\V1\Product;

use Illuminate\Http\Request;
use App\Repository\V1\Product\ProductRepository;
use App\Repository\V1\User\UserRepository;
use Illuminate\Support\Facades\Storage;
use App\Repository\V1\SubCategory\SubCategoryRepository;
use Validator;

class ProductServiceUpdate
{

    use Traits\RuleTrait;

    protected $userRepository;
    protected $productRepository;
    protected $subCategoryRepository;

    public function __construct(
        UserRepository $userRepository,
        ProductRepository $productRepository,
        SubCategoryRepository $subCategoryRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function update(int $id, Request $request)
    {
        $image = null;
        $attributes = $request->all();

        $attributes['user_id']= auth()->user()->id;
        $validator = Validator::make($attributes, $this->rules($id));

        if ($validator->fails()) {
            return $validator->errors();
        }

        if (!get_object_vars(($this->productRepository->show($id)))) {
            return "product invalid";
        }

        if (!get_object_vars(($this->userRepository->show($attributes['user_id'])))) {
            return "user_id invalid";
        }

        if (!($this->isValidCategoryAndSubCatecory($attributes['sub_category_id'],$attributes['user_id']))) {
            return "sub_category_id invalid";
        }

        if ($request->hasFile('image')) {
            $image = $this->uploadImg($request->file('image'), $id);
       }
       $attributes['image']= empty($image)?null:$image;

        return $this->productRepository->update($id, $attributes);
    }

    public function uploadImg($file, $id)
    {
        if($this->productRepository->show($id)->image){
            Storage::delete('public/'.$this->productRepository->show($id)->image);
        }

        return  $file->store('imagens/'.auth()->user()->cpf_cnpj, 'public');
    }

    public function isValidCategoryAndSubCatecory($subCategoryId,$userId)
    {
        $hasSubCatecory=false;
        if($this->subCategoryRepository->show($subCategoryId)){
            $userCategory = $this->userRepository->show($userId)->category_id;
            if($userCategory){
                if($this->subCategoryRepository->showSubcategory($userCategory)){
                    foreach($this->subCategoryRepository->showSubcategory($userCategory) as $subCategory){
                        if($subCategory->id==$subCategoryId){
                            $hasSubCatecory=true;
                            break;
                        }
                    }
                }

            }
            return $hasSubCatecory;
        }
    }

}
