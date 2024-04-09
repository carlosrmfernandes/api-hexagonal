<?php

namespace Tests\Unit\Services;

use App\Repository\V1\Address\AddressRepository;
use App\Repository\V1\Category\CategoryRepository;
use App\Repository\V1\User\UserRepository;
use App\Repository\V1\UserType\UserTypeRepository;
use App\Service\V1\User\UserServiceRegistration;
use Models\Address;
use Models\Category;
use Models\UserS;
use Models\UserType;
use Tests\TestCase;

class UserTest extends TestCase {

    /**
     * A basic unit test example.
     *
     * @return void
     */
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    function test_create() {
        $attributes = [
            'name' => "Drogaria Sao paulo 2",
            'email' => 'sp22@sp.com',
            'password' => bcrypt(123456),
            'category_id' => 2,
        ];

//         $this->assertEquals($user, "Successful registration, check your email please");
    }

}
