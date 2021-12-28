<?php

namespace Tests\Unit\Register;

use App\Models\User;
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

        $address = factory(Address::class)->create();
        $expcetedAddressId = Address::find($address->id);       
        $this->assertEquals($expcetedAddressId->id, $address->id);        
        $user = factory(User::class)->create();
        
        $expcetedUserId = User::find($user->id);        
        $this->assertEquals($expcetedUserId->id, $user->id);
        $this->login($user);
    }

    function login($user) {
        $this->be($user);
        $expceted = User::find($user->id);        
        $this->assertEquals($expceted->id, $user->id);
        
    }

}
