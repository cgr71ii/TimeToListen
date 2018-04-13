<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Song;
use App\Genre;
use Cookie;
use Redirect;

class SongController extends Controller
{
    public function add_song(Request $request)
    {
        if (empty($request->song_name) || empty($request->song_file) || empty($request->genres)){
            return redirect('/songs')->with('emptyfields', true);
        }

        $data = request()->all();
        $sname = $data['song_name'];
        $sfile = $data['song_file']; 
        $sgenres = $data['genres'];

        if(substr($sfile, -4) != '.mp3'){
            return redirect('/songs')->with('errorfile', true);
        }

        /*$target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);*/

        //move_uploaded_file($_FILES['myFile']['tmp_name'], '/public/user/myFile.txt');

        /*$target_dir = "public/user/"; // folder path
        $target_file = $target_dir . basename($_FILES[$sfile]['name']);
        move_uploaded_file($_FILES["song_file"]["tmp_name"], $target_file);*/

        /*$file=$request->file($sfile);
        $file->move(base_path('/public/user'),$file->getClientOriginalName());*/

        /*$file = $request->file('song_file');
        $name = $file->getClientOriginalName();
        $file->move('/public/user/', $file->getClientOriginalName());*/
        //$file->move('/public/user/', $name);

        $data = $request->input('song_file');
        $photo = $request->file('song_file')->getClientOriginalName();
        $destination = base_path() . '/public/user/songs';
        $request->file('song_file')->move($destination, $photo);

        return redirect('/songs');
    }
}


/*$data_validated = $request->validate([
            'song_name' => 'required',
            'song_file' => 'required',
            'genres' => 'required'
        ], [
            'song_name.required' => 'The song must be given a name.',
            'song_file.required' => 'You must choose a valid file (mp3 format).',
            'genres.required' => 'The song must have at least one genre.',
        ]);*/

        /*
        @if ($errors->any())
            <div class="alert alert-danger">
                <h5> There were errors with the song upload petition: </h5>
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
            </div>
        @endif
        */