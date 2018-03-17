<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->delete();


        $group = new Group([
            'name' => 'Grupo1'
        ]);
        $group->save();

        $group = new Group([
            'name' => 'Grupo2'
        ]);
        $group->save();

        $group = new Group([
            'name' => 'Grupo3'
        ]);
        $group->save();

        $group = new Group([
            'name' => 'Grupo4'
        ]);
        $group->save();
        
    }
}
