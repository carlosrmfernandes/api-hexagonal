<?php

namespace App\Service\V1\Product;

use App\Repository\V1\Product\ProductRepository;
use App\Repository\V1\User\UserRepository;
use App\Repository\V1\SubCategory\SubCategoryRepository;
use Validator;

class ProductServiceRegistration
{

    use Traits\RuleTrait;

    protected $productRepository;
    protected $userRepository;
    protected $subCategoryRepository;

    public function __construct(
        ProductRepository $productRepository,
        UserRepository $userRepository,
        SubCategoryRepository $subCategoryRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function store($request)
    {
        $attributes = null;
        $image = null;
        if (is_object($request)) {
            $attributes = $request->all();
        } else {
            $attributes = $request;
        }
         $attributes['user_id']= auth()->user()->id;
         $validator = Validator::make($attributes, $this->rules());

        if ($validator->fails()) {
             return $validator->errors();
        }

        if (!get_object_vars(($this->userRepository->show($attributes['user_id'])))) {
            return "user_id invalid";
        }

        if (!($this->isValidCategoryAndSubCatecory($attributes['sub_category_id'],$attributes['user_id']))) {
            return "sub_category_id invalid";
        }

        if ($request->hasFile('image')) {
             $image = $this->uploadImg($request->file('image'));
        }
        $attributes['image']= empty($image)?null:$image;
        $product = $this->productRepository->save($attributes);
        return $product?$product:'unidentified product';
    }
    public function uploadImg($file)
    {
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
