<?php

use Illuminate\Database\Seeder;
use App\Genre;
use App\Song;

class GenreSongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genre_song')->delete();

        $genre1 = Genre::findOrFail(1);
        $genre2 = Genre::findOrFail(2);

        $song = Song::findOrFail(1);
        $song->genres()->attach($genre1->id);
        $song->genres()->attach($genre2->id);

        $song = Song::findOrFail(3);
        
        $genre1->songs()->attach($song->id);
    }
}
