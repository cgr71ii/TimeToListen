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

    public function songs(Request $request){

        $genres = Genre::all();

        session(['genres' => $genres]);

        $songs = Song::where('user_id', session('user')->id)->get();

        session(['songs' => $songs]);

        return view('user.songs');
    }

    public function add_song(Request $request)
    {
        $request->validate([
            'file' => 'max:102400',
        ]);

        if (empty($request->song_name) || empty($request->file) || empty($request->chosen_genres)){
            return back()->with('emptyfields', true);
        }

        $data = request()->all();
        $sname = $data['song_name'];
        $sfile = $data['file'];
        $sgenres = $data['chosen_genres'];

        $user = session('user');
        $audio = $request->file('file');
        $audioName = $user->email . ' - ' . $sname . '.' . $audio->getClientOriginalExtension();

        if (substr($audioName, -4) == '.mp4' || substr($audioName, -4) == '.wav'){
            $audio->move(public_path('/user/songs'), $audioName);

            $song = new Song([
                'name' => $sname,
                'song_path' => "user/songs/$audioName",
                'user_id' => session('user')->id
            ]);
            $song->save();
            
            foreach($sgenres as $sgenre){
                $song->genres()->attach($sgenre);
                $song->save();
            }

            return back()->with('success', true);
        }
        else{
            return back()->with('errorfile', true);
        }

        return back();
    }
}