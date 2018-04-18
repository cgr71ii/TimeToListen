<?php

use Illuminate\Database\Seeder;
use App\Song;

class SongTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('songs')->delete();

        $song = new Song(['name' => 'CoolSong1',
                            'song_path' => 'user/songs/a7x - buried alive.mp3',
                            'user_id' => 1]);
        $song->save();

        $song = new Song(['name' => 'CoolSong2',
                            'song_path' => 'TestPath2',
                            'user_id' => 1]);
        $song->save();

        $song = new Song(['name' => 'NotSoGreatSong1',
                            'song_path' => 'TestPath3',
                            'user_id' => 1]);
        $song->save();

        $song = new Song(['name' => 'MediocreSong1',
                            'song_path' => 'TestPath4',
                            'user_id' => 1]);
        $song->save();

        $song = new Song(['name' => 'CouldBeWorseSong2',
                            'song_path' => 'TestPath5',
                            'user_id' => 1]);
        $song->save();
    }
}