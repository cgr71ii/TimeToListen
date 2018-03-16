<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Genre;
use App\Song;

class GenreSongTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $genre = Genre::findOrFail(1);

        $this->assertEquals($genre->songs()->get()->first()->id, 1);

        $song = Song::findOrFail(1);

        $this->assertEquals($song->genres()->count(), 2);
        $this->assertTrue($song->genres()->get()->contains(1));
        $this->assertTrue($song->genres()->get()->contains(2));
    }
}
