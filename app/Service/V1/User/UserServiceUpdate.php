<?php

namespace App\Service\V1\User;

use Illuminate\Http\Request;
use App\Repository\V1\User\UserRepository;
use App\Repository\V1\Category\CategoryRepository;
use App\Repository\V1\UserType\UserTypeRepository;
use App\Repository\V1\Address\AddressRepository;
use Illuminate\Support\Facades\Storage;
use function bcrypt;
use Validator;

class UserServiceUpdate
{

    use Traits\RuleTrait;
    use \App\Service\Traits\VerifyCnpjOrCpfTrait;

    protected $userRepository;
    protected $userTypeRepository;
    protected $addressRepository;

    public function __construct(
        UserRepository $userRepository,
        UserTypeRepository $userTypeRepository,
        CategoryRepository $categoryRepository,
        AddressRepository $addressRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userTypeRepository = $userTypeRepository;
        $this->categoryRepository = $categoryRepository;
        $this->addressRepository = $addressRepository;
    }

    public function update(int $id, Request $request)
    {
        $attributes = $request->all();

        if (($attributes['user_type_id']) && $attributes['user_type_id'] == 2) {
            if (empty($attributes['category_id'])) {
                return "The category_id field is required.";
            }
        }

        if (($attributes['user_type_id']) && $attributes['user_type_id'] == 1) {
            if (!empty($attributes['category_id'])) {
                return "Remove the field category_id.";
            }
        }

        $attributes['cpf_cnpj'] = preg_replace('/[^0-9]/', '', (string) $attributes['cpf_cnpj']);

        if (!$this->cnpjCpf($attributes['cpf_cnpj'])) {
            return "cpf_cnpj invalid";
        }

        $validator = Validator::make($attributes, $this->rules($id));

        if ($validator->fails()) {
            return $validator->errors();
        }

        if (!get_object_vars(($this->userTypeRepository->show($attributes['user_type_id'])))) {
            return "user_type_id invalid";
        }

        if (($attributes['user_type_id']) && $attributes['user_type_id'] == 2) {
            if (!get_object_vars($this->categoryRepository->show($attributes['category_id']))) {
                return "category_id invalid";
            }
        }

        if ($request->hasFile('image')) {
            $image = $this->uploadImg($request->file('image'), $id);
        }
        $attributes['image']= empty($image)?null:$image;
        $attributes['password'] = bcrypt($attributes['password']);
        
        $addres = $this->addressRepository->update(auth('api')->user()->address_id, $attributes);
        
        if ($addres) {
           return $this->userRepository->update($id, $attributes);
        } 
        return 'unidentified addres';
    }
    public function uploadImg($file, $id)
    {
        if ($this->userRepository->show($id)->image) {
            Storage::delete('public/' . $this->userRepository->show($id)->image);
        }

        return  $file->store('imagens/' . auth('api')->user()->cpf_cnpj, 'public');
    }
}
