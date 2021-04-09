<?php

namespace Tests\Unit\Services;

use App\Service\V1\User\UserServiceRegistration;
use App\Repository\V1\User\UserRepository;
use App\Repository\V1\UserType\UserTypeRepository;
use App\Repository\V1\Category\CategoryRepository;
use App\Models\User;
use App\Models\UserType;
use App\Models\Category;
use Tests\TestCase;
use Illuminate\Support\Str;
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
            'name' => "Hope",
            'cpf_cnpj' => '35089173044',
            'email' => 'support@hopetecno.com',
            'phone' => '48996684418',
            'state' => 'São Paulo',
            'city' => 'Penha',
            'address' => 'Rua Henrique Casela, 54 - Penha de França, São Paulo - SP, Brazil',
            'is_active' => 1,
            'password' => bcrypt(123456),
            'company_name' => 'Hope',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'user_type_id' => 2,
            'category_id' => 1
        ];


       $UserRepository = new UserRepository(new User());
       $userTypeRepository = new UserTypeRepository(new UserType());
       $categoryRepository = new CategoryRepository(new Category());

       $userRepository = new UserServiceRegistration(
           $UserRepository,$userTypeRepository,$categoryRepository
        );
       $user = $userRepository->store($attributes);
        if (is_object($user)) {
            $expceted = User::find($user->id);
            $this->assertEquals($expceted->id, $user->id);
        } else {
            dd($user);
        }
    }



}
