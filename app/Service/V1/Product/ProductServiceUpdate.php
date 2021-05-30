<?php

namespace App\Service\V1\Product;

use Illuminate\Http\Request;
use App\Repository\V1\Product\ProductRepository;
use App\Repository\V1\User\UserRepository;
use Illuminate\Support\Facades\Storage;
use Validator;

class ProductServiceUpdate
{

    use Traits\RuleTrait;

    protected $userRepository;
    protected $productRepository;

    public function __construct(
        UserRepository $userRepository,
        ProductRepository $productRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
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

}
