<?php

use Illuminate\Database\Seeder;
use App\User;

class UserUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('user_user')->delete();

        $friend_id = User::where('email', 'mike@gmail.com')->firstOrFail()->id;

        $user = User::where('email', 'kamil@gmail.com')->firstOrFail();
        $user->users()->attach($friend_id);

        $user = User::where('email', 'adrian@gmail.com')->firstOrFail();
        $user->users()->attach($friend_id);

        $user = User::where('email', 'tudor@gmail.com')->firstOrFail();
        $user->users()->attach($friend_id);

        $user = User::where('email', 'cristian@gmail.com')->firstOrFail();
        $user->users()->attach($friend_id);

        $friend_id = User::where('email', 'kamil@gmail.com')->firstOrFail()->id;

        $user = User::where('email', 'adrian@gmail.com')->firstOrFail();
        $user->users()->attach($friend_id);

        $user = User::where('email', 'tudor@gmail.com')->firstOrFail();
        $user->users()->attach($friend_id);

        $user = User::where('email', 'cristian@gmail.com')->firstOrFail();
        $user->users()->attach($friend_id);

        $friend_id = User::where('email', 'adrian@gmail.com')->firstOrFail()->id;

        $user = User::where('email', 'tudor@gmail.com')->firstOrFail();
        $user->users()->attach($friend_id);

        $user = User::where('email', 'cristian@gmail.com')->firstOrFail();
        $user->users()->attach($friend_id);

        $friend_id = User::where('email', 'tudor@gmail.com')->firstOrFail()->id;

        $user = User::where('email', 'cristian@gmail.com')->firstOrFail();
        $user->users()->attach($friend_id);

    }
}
