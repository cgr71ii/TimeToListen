<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDataExists()
    {
        
        $user = User::where('email', 'no-one@gmail.com')->first();
        $this->assertNull($user);

        $user = User::find(1);
        $this->assertEquals('mike@gmail.com', $user->email);

        $user = User::find(2);
        $this->assertEquals('kamil@gmail.com', $user->email);

        $user = User::find(3);
        $this->assertEquals('adrian@gmail.com', $user->email);

        $user = User::find(4);
        $this->assertEquals('tudor@gmail.com', $user->email);

        $user = User::find(5);
        $this->assertEquals('cristian@gmail.com', $user->email);

        $user = User::find(6);
        $this->assertNull($user);

    }
}
