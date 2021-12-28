<?php

use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Models\User;
use Faker\Generator as Faker;

class UserForTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $address = [
            'cep' => '03704020',
            'state' => 'São Paulo',            
            'neighborhood' => 'Penha',        
            'street' => $faker->streetName(),
            'street_number' => $faker->numberBetween(10, 100),
            'complement' => 'Chaparral'
        ];
        
        $address = Address::create($address);
        
        $user = [
            'name' => $faker->name,
            'cpf_cnpj' => '14.899.427/0001-88',
            'email' => $faker->unique()->safeEmail,
            'phone' => $faker->phoneNumber,        
            'address_id' => $address->id,        
            'is_active' => 1,
            'password' => bcrypt(123456),
            'company_name' => 'Hope',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'user_type_id' => 2,
            'category_id' => 3
        ];
         
        User::create($user);
    }
}
