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
                'name' => "Drogaria Sao paulo 2",
                'email' => 'sp22@sp.com',
                'password' => bcrypt(123456),
                'category_id' => 2,
            ], ["Content-Type" => "application/json"]);

        $response->assertStatus(200);
    }
}
