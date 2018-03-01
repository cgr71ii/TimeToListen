<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Message;

class MessageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testDataExists()
    {
        $message = Message::where ('user_id', '0')->first();
        $this->asserNull($message);

        $message = Message::where('title','Test1')->first();
        $this->assertEquals($message->text,'TextTest1');
        $this->assertEquals($message->read,false);
        $this->assertEquals($message->date, '2017-07-07 11:23:19.120');
        $this->assertEquals($message->user_id, 'mike@gmail.com');

        $message = Message::find(2);
        $user = User::where('email','kamil@gmail.com')->first();
        $this->assertEquals($message->user_id,$user->id);
        $this->assertEquals($message->title,'Test2');
        $this->assertEquals($message->text,'TextTest2');
        $this->assertEquals($message->read,true);
        $this->assertEquals($message->user_id, 'kamil@gmail.com');

        $message = Message::find(3);
        $user = User::where('email','cristian@gmail.com')->first();
        $this->assertEquals($message->user_id,$user->id);
        $this->assertEquals($message->title,'Test3');
        $this->assertEquals($message->text,'TextTest3');
        $this->assertEquals($message->read,true);
        $this->assertEquals($message->user_id, 'cristian@gmail.com');
        $this->assertEquals($message->date,'2409-07-07 11:23:19.120');
        
        $message = Message::find(4);
        $this->assertNull($message);

    }
    
}
