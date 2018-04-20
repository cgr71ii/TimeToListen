<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //'email', 'password', 'name', 'lastname', 'birthday', 'pic_profile_path'
        DB::table('users')->delete();

        $user = new User([  'email' => 'mike@gmail.com', 
                            'password' => 'mikethebest', 
                            'name' => 'Mike',
                            'lastname' => 'Salty',
                            'birthday' => '2018-02-26 20:42:51',
                            'pic_profile_path' => 'user/pic_profile/mike@gmail.com_pic_profile.png',
                            'song_id' => '1']);
        $user->save();

        $user = new User([  'email' => 'kamil@gmail.com', 
                            'password' => 'kamilkamil', 
                            'name' => 'Kamil',
                            'lastname' => 'Mans',
                            'birthday' => '2018-02-26 20:43:51',
                            'pic_profile_path' => 'user/pic_profile/kamil@gmail.com_pic_profile.png',
                            'song_id' => '1']);
        $user->save();

        $user = new User([  'email' => 'adrian@gmail.com', 
                            'password' => 'adrianadrian', 
                            'name' => 'Adrian',
                            'lastname' => 'Fernandez',
                            'birthday' => '2018-02-26 20:44:51',
                            'pic_profile_path' => 'user/pic_profile/adrian@gmail.com_pic_profile.png',
                            'song_id' => '1']);
        $user->save();

        $user = new User([  'email' => 'tudor@gmail.com', 
                            'password' => 'tudortudor', 
                            'name' => 'Tudor',
                            'lastname' => 'Mateiu',
                            'birthday' => '2018-02-26 20:45:51',
                            'pic_profile_path' => 'user/pic_profile/tudor@gmail.com_pic_profile.png',
                            'song_id' => '1']);
        $user->save();

        $user = new User([  'email' => 'cristian@gmail.com', 
                            'password' => 'cristiancristian', 
                            'name' => 'Cristian',
                            'lastname' => 'Garcia',
                            'birthday' => '2018-02-26 20:46:51',
                            'pic_profile_path' => 'user/pic_profile/cristian@gmail.com_pic_profile.png',
                            'song_id' => '1']);
        $user->save();

        $user = new User([  'email' => 'a1@gmail.com', 
                            'password' => 'a1', 
                            'name' => 'a1',
                            'lastname' => 'a1',
                            'birthday' => '2018-02-26 20:46:51',
                            'pic_profile_path' => 'user/pic_profile/cristian@gmail.com_pic_profile.png',
                            'song_id' => '1']);
        $user->save();

        $user = new User([  'email' => 'a2@gmail.com', 
                            'password' => 'a2', 
                            'name' => 'a2',
                            'lastname' => 'a2',
                            'birthday' => '2018-02-26 20:46:51',
                            'pic_profile_path' => 'user/pic_profile/cristian@gmail.com_pic_profile.png',
                            'song_id' => '1']);
        $user->save();

        $user = new User([  'email' => 'a3@gmail.com', 
                            'password' => 'a3', 
                            'name' => 'a3',
                            'lastname' => 'a3',
                            'birthday' => '2018-02-26 20:46:51',
                            'pic_profile_path' => 'user/pic_profile/cristian@gmail.com_pic_profile.png',
                            'song_id' => '1']);
        $user->save();
        
        /*
        $user->teams()->saveMany(
            [
                new Team(['name' => 'Screaming Nachos']),
                new Team(['name' => 'Elemonators'])
            ]);
        */

    }
}
