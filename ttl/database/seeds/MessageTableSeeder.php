<?php

use Illuminate\Database\Seeder;
use App\Message;
use App\User;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')->delete();
        $user = DB::table('users')->where('email', 'mike@gmail.com')->first();
        $messages = new Message([ 'user_id' => $user->id,
                                  'title' => 'Test1',
                                  'text' => 'TextTest1',
                                  'read' => false,
                                  'date' => '2017-07-07 11:23:19.120'
        ]);
        $messages->save();
        $user = DB::table('users')->where('email', 'kamil@gmail.com')->first();
        $messages = new Message([ 'user_id' => $user->id,
                                  'title' => 'Test2',
                                  'text' => 'TextTest2',
                                  'read' => true,
                                  'date' => '2049-07-07 11:23:19.120'
        ]);
        $messages->save();
        $user = DB::table('users')->where('email', 'cristian@gmail.com')->first();
        $messages = new Message([ 'user_id' => $user->id,
                                  'title' => 'Test3',
                                  'text' => 'TextTest3',
                                  'read' => true,
                                  'date' => '2409-07-07 11:23:19.120'
        ]);
        $messages->save();
        $user = DB::table('users')->where('email', 'cristian@gmail.com')->first();
        $messages = new Message([ 'user_id' => $user->id,
                                  'title' => 'Test4',
                                  'text' => 'TextTest4',
                                  'read' => true,
                                  'date' => '2409-08-07 11:23:19.120'
        ]);
        $messages->save();
    }
}
