<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->json('POST',
             '/api/user',
            [
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
        ],["Content-Type"=>"application/json"]);
                
        $response->assertStatus(200);
    }
}
