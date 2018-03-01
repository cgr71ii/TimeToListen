<?php

use Illuminate\Database\Seeder;
use App\Message;
use App\User;


class MessageUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('message_user')->delete();

        $user = User::where('email', 'mike@gmail.com')->firstOrFail();
        $message = Message::where('user_id', $user->id)->firstOrFail();
        $user = User::where('email', 'kamil@gmail.com')->firstOrFail();
        $message->user_receive()->attach($user);
        
        $user = User::where('email', 'kamil@gmail.com')->firstOrFail();
        $message = Message::where('user_id', $user->id)->firstOrFail();
        $user = User::where('email', 'mike@gmail.com')->firstOrFail();
        $message->user_receive()->attach($user);
        $user = User::where('email', 'tudor@gmail.com')->firstOrFail();
        $message->user_receive()->attach($user);
        
        
        $user = User::where('email', 'cristian@gmail.com')->firstOrFail();
        $message = Message::where('user_id', $user->id)->firstOrFail();
        $user = User::where('email', 'adrian@gmail.com')->firstOrFail();
        $message->user_receive()->attach($user);
    }
}
