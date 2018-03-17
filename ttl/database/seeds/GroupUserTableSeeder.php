<?php

use Illuminate\Database\Seeder;

class GroupUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group_user')->delete();

        $group = Group::where('name','Grupo1')->FirstOrFail();
        $user = User::where('email', 'mike@gmail.com')->firstOrFail();
        $user->user_belongs()->attach($group->$id);
        $user = User::where('email', 'kamil@gmail.com')->firstOrFail();
        $user->user_belongs()->attach($group->$id);


        $group = Group::where('name','Grupo2')->FirstOrFail();
        $user = User::where('email', 'mike@gmail.com')->firstOrFail();
        $user->user_belongs()->attach($group->$id);
        $user = User::where('email', 'cristian@gmail.com')->firstOrFail();
        $user->user_belongs()->attach($group->$id);

        $group = Group::where('name','Grupo3')->FirstOrFail();
        $user = User::where('email', 'tudor@gmail.com')->firstOrFail();
        $user->user_belongs()->attach($group->$id);
        $user = User::where('email', 'adrian@gmail.com')->firstOrFail();
        $user->user_belongs()->attach($group->$id);


    }
}
