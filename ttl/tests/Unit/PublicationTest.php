<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Publication;
use App\User;
 

class PublicationTest extends TestCase
{

    private function getPublications($id)
    {
        $publications = array();

        if (User::find($id) == null )
        {
            return null;
        }

        $publi = User::find($id)->publications()->get();

        foreach ($publi as $p)
        {
            array_push($publications, $p);
        }


        return $publications;
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDataExists()
    {
        $publication = Publication::where('id', '0')->first();
        $this->assertNull($publication);
        
        $publication->Publication::find(1);
        $this->assertEquals($publication->user_id,'1');

        $publication->Publication::find(2);
        $this->assertEquals($publication->text,'Hola mundo');
        
        $publication->Publication::find(3);
        $this->assertEquals($publication->date,'2015-10-07 22:23:19.120');
    }

    public function testCheckUserPublication()
    {
        $user_publications=$this->getPublications(1);
        $this->assertEquals($user_publications[0]->text,'Esto es genial es mi primera publicación');
        $this->assertEquals($user_publications[1]->text,'Test');
        $this->assertNull($user_publications[2]);

        $user_publications=$this->getPublications(2);
        $this->assertEquals($user_publications[0]->text,'Hola mundo');
        $this->assertEquals($user_publications[0]->date,'2017-07-07 11:23:19.120');
        $this->assertNull($user_publications[1]);

        $user_publications=$this->getPublications(3);
        $publication = Publication::where('user_id', '3')->first();
        $user = User::find(3);
        $this->assertEquals($user_publications[0]->text,'Me encanta este sitio');
        $this->assertEquals($user,$publication->user_publish()->get());
        $this->assertNull($user_publications[1]);


    }
}
