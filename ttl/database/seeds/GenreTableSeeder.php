<?php

use Illuminate\Database\Seeder;
use App\Genre;

class GenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->delete();

        $genre = new Genre(['name' => 'Metalcore']);
        $genre->save();

        $genre = new Genre(['name' => 'Hard Rock']);
        $genre->save();

        $genre = new Genre(['name' => 'Heavy Metal']);
        $genre->save();

        $genre = new Genre(['name' => 'Rock']);
        $genre->save();

        $genre = new Genre(['name' => 'Pop']);
        $genre->save();

        $genre = new Genre(['name' => 'Indie']);
        $genre->save();
    }

}
