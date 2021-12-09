<?php

namespace App\Service\V1\User;

use App\Repository\V1\User\UserRepository;
use App\Repository\V1\UserType\UserTypeRepository;
use App\Repository\V1\Category\CategoryRepository;
use App\Repository\V1\Address\AddressRepository;
use App\Components\AddressByZipCode\Client as ClientAuthorizationAddressByZipCode;
use function bcrypt;
use Validator;

class UserServiceRegistration {

    use Traits\RuleTrait;
    use \App\Service\Traits\VerifyCnpjOrCpfTrait;

    protected $userRepositor;
    protected $userTypeRepository;
    protected $addressRepository;

    public function __construct(
    UserRepository $userRepository, UserTypeRepository $userTypeRepository, CategoryRepository $categoryRepository, AddressRepository $addressRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userTypeRepository = $userTypeRepository;
        $this->categoryRepository = $categoryRepository;
        $this->addressRepository = $addressRepository;
    }

    public function store($request) {
        $attributes = null;
        if (is_object($request)) {
            $attributes = $request->all();
        } else {
            $attributes = $request;
        }

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

        $validator = Validator::make($attributes, $this->rules());

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

        $addressByZipCode = app(ClientAuthorizationAddressByZipCode::class)->addressByZipCode($attributes['cep']);

        if (!$addressByZipCode) {
            return (object) "error looking up address via zip code";
        }
        $attributes['state'] = $addressByZipCode->localidade;        
        $attributes['neighborhood'] = $addressByZipCode->bairro;
        $attributes['street'] = $addressByZipCode->logradouro;
        
        $attributes['password'] = bcrypt($attributes['password']);

        if (!empty($attributes['image']) && $request->hasFile('image')) {
            $image = $this->uploadImg($request->file('image'), $attributes['cpf_cnpj']);
        }

        $attributes['image'] = empty($image) ? null : $image;

        $addres = $this->addressRepository->save($attributes);
        if ($addres) {
            $attributes['address_id'] = $addres->id;
            $user = $this->userRepository->save($attributes);
            return $user ? $user : 'unidentified user';
        }
        return $user ? $user : 'unidentified addres';
    }

    public function uploadImg($file, $cpf_cnpj) {
        return $file->store('imagens/' . $cpf_cnpj, 'public');
    }

}
