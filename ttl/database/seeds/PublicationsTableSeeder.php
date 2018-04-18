<?php

use Illuminate\Database\Seeder;
use App\Publication;

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

        $publication = new Publication([
            'text' => 'Esto es genial es mi primera publicación',
            'user_id' => '1',
            'date' => '2013-10-07 08:23:19.120'
        ]);
        $publication->save();

        $publication = new Publication([
            'text' => 'Hola mundo',
            'user_id' => '2',
            'date' => '2017-07-07 11:23:19.120'
        ]);
        $publication->save();

        $publication = new Publication([
            'text' => 'Me encanta este sitio',
            'user_id' => '3',
            'date' => '2015-10-07 22:23:19.120'
        ]);

        $publication->save();

        $publication = new Publication([
            'text' => 'Test',
            'user_id' => '1',
            'date' => '2015-11-07 22:23:19.120'
        ]);

        $publication->save();


        //From here we are creating publications with groups

        $publication = new Publication([
            'text' => 'TestGrupo',
            'user_id' => '1',
            'date' => '2015-11-08 22:23:20.120',
            'group_id' => '1'
        ]);

        $publication->save();

        $publication = new Publication([
            'text' => 'TestGrupo',
            'user_id' => '3',
            'date' => '2015-11-08 22:23:20.120',
            'group_id' => '2'
        ]);

        $publication->save();

        $publication = new Publication([
            'text' => 'TestGrupo',
            'user_id' => '3',
            'date' => '2015-11-08 22:23:20.120',
            'group_id' => '3'
        ]);

        $publication->save();

    }
}