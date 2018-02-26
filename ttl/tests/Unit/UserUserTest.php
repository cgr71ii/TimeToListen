<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserUserTest extends TestCase
{

    private function getFriends($id)
    {
        $users = array();

        if (User::find($id) == null )
        {
            return null;
        }

        $user1 = User::find($id)->users()->get();
        $user2 = User::find($id)->userFriends()->get();

        foreach ($user1 as $u)
        {
            array_push($users, $u);
        }

        foreach ($user2 as $u)
        {
            array_push($users, $u);
        }

        return $users;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFriensTableHasData()
    {
        $users = User::find(1)->users()->get()->count();
        $friends= User::find(1)->userFriends()->get()->count();

        $this->assertEquals($users + $friends, 4);

        $friends = $this->getFriends(1);
        $this->assertNotNull($friends);

        $friends = $this->getFriends(2);
        $this->assertNotNull($friends);

        $friends = $this->getFriends(3);
        $this->assertNotNull($friends);

        $friends = $this->getFriends(4);
        $this->assertNotNull($friends);

        $friends = $this->getFriends(5);
        $this->assertNotNull($friends);

        $friends = $this->getFriends(6);
        $this->assertNull($friends);
    }

    public function testCheckEmailFriends()
    {
        $user_friends = $this->getFriends(1);

        $this->assertEquals('kamil@gmail.com', $user_friends[0]->email);
        $this->assertEquals('adrian@gmail.com', $user_friends[1]->email);
        $this->assertEquals('tudor@gmail.com', $user_friends[2]->email);
        $this->assertEquals('cristian@gmail.com', $user_friends[3]->email);

        $user_friends = $this->getFriends(2);

        $this->assertEquals('mike@gmail.com', $user_friends[0]->email);
        $this->assertEquals('adrian@gmail.com', $user_friends[1]->email);
        $this->assertEquals('tudor@gmail.com', $user_friends[2]->email);
        $this->assertEquals('cristian@gmail.com', $user_friends[3]->email);

        $user_friends = $this->getFriends(3);

        $this->assertEquals('mike@gmail.com', $user_friends[0]->email);
        $this->assertEquals('kamil@gmail.com', $user_friends[1]->email);
        $this->assertEquals('tudor@gmail.com', $user_friends[2]->email);
        $this->assertEquals('cristian@gmail.com', $user_friends[3]->email);

        $user_friends = $this->getFriends(4);

        $this->assertEquals('mike@gmail.com', $user_friends[0]->email);
        $this->assertEquals('kamil@gmail.com', $user_friends[1]->email);
        $this->assertEquals('adrian@gmail.com', $user_friends[2]->email);
        $this->assertEquals('cristian@gmail.com', $user_friends[3]->email);

        $user_friends = $this->getFriends(5);

        $this->assertEquals('mike@gmail.com', $user_friends[0]->email);
        $this->assertEquals('kamil@gmail.com', $user_friends[1]->email);
        $this->assertEquals('adrian@gmail.com', $user_friends[2]->email);
        $this->assertEquals('tudor@gmail.com', $user_friends[3]->email);
    }
}
