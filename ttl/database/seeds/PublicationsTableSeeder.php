<?php

use Illuminate\Database\Seeder;

class PublicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('publications')->delete();
        // Añadimos entradas a la tabla
        DB::table('publications')->insert([
            'text' => 'Esto es genial es mi primera publicación',
            'user_id' => '1',
            'date' => '2013-10-07 08:23:19.120'
        ]);
        DB::table('publications')->insert([
            'text' => 'Hola mundo',
            'user_id' => '2',
            'date' => '2017-07-07 11:23:19.120'
        ]);
        DB::table('publications')->insert([
            'text' => 'Me encanta este sitio',
            'user_id' => '3',
            'date' => '2015-10-07 22:23:19.120'
        ]);
        DB::table('publications')->insert([
            'text' => 'Test',
            'user_id' => '1',
            'date' => '2015-11-07 22:23:19.120'
        ]);
    }
}