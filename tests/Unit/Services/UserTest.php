<?php

namespace Tests\Unit\Services;

use App\Service\V1\User\UserServiceRegistration;
use App\Repository\V1\User\UserRepository;
use App\Repository\V1\UserType\UserTypeRepository;
use App\Repository\V1\Category\CategoryRepository;
use App\Repository\V1\Address\AddressRepository;
use App\Models\User;
use App\Models\UserType;
use App\Models\Category;
use App\Models\Address;
use Tests\TestCase;

class UserTest extends TestCase {

    /**
     * A basic unit test example.
     *
     * @return void
     */
    use \App\Service\V1\User\Traits\RuleTrait;
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    function test_create() {
        $attributes = [
            'name' => "Drogaria Sao paulo",
            'cpf_cnpj' => '22.525.423/0001-68',
            'email' => 'sp@sp.com',
            'phone' => '48996684418',
            'cep' => '03704020',
            'state' => 'São Paulo',
            'city' => 'São Paulo',
            'neighborhood' => 'Penha',
            'street' => 'Rua henrrique casela',
            'street_number' => 54,
            'complement' => 'Chaparral',
            'password' => bcrypt(123456),
            'company_name' => 'Drogaria Sao paulo',
            'image' => null,
            'user_type_id' => 2,
            'is_active' => 1,
            'category_id' => 2,
            
        ];


        $UserRepository = new UserRepository(new User());
        $userTypeRepository = new UserTypeRepository(new UserType());
        $categoryRepository = new CategoryRepository(new Category());
        $addressRepository = new AddressRepository(new Address());

        $userServiceRegistration = new UserServiceRegistration(
                $UserRepository, 
                $userTypeRepository, 
                $categoryRepository,
                $addressRepository
        );
        $user = $userServiceRegistration->store($attributes);
        
        $expceted = User::find($user->id);
        $this->assertEquals($expceted->id, $user->id);        
    }

}
