<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Models\Address;

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

$factory->define(Address::class,  function (Faker $faker) {

    return [
        'cep' => '03704020',
        'state' => 'São Paulo',
        'neighborhood' => 'Penha',
        'street' => $faker->streetName(),
        'street_number' => $faker->numberBetween(10, 100),
        'complement' => 'Chaparral'
    ];
});
