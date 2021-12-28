<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
  |--------------------------------------------------------------------------
  | Model Factories
  |--------------------------------------------------------------------------
  |
  | This directory should contain each of the model factory definitions for
  | your application. Factories provide a convenient way to generate new
  | model instances for testing / seeding your application's database.
  |
 */

$factory->define(User::class,  function (Faker $faker) {    
    
    return [
        'name' => $faker->name,
        'cpf_cnpj' => '24.925.701/0001-08',
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,        
        'address_id' => App\Models\Address::orderBy('created_at', 'desc')->first()->id,        
        'is_active' => 1,
        'password' => bcrypt(123456),
        'company_name' => 'Hope',
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
        'user_type_id' => 2,
        'category_id' => 3
    ];
});
