<?php

use Illuminate\Database\Seeder;
use App\Group;

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
            'name' => 'Grupo1',
            'creator_id' => '1'
        ]);
        $group->save();

        $group = new Group([
            'name' => 'Grupo2',
            'creator_id' => '2'
        ]);
        $group->save();

        $group = new Group([
            'name' => 'Grupo3',
            'creator_id' => '2'
        ]);
        $group->save();

        $group = new Group([
            'name' => 'Grupo4',
            'creator_id' => '3'
        ]);
        $group->save();
        
    }
}
