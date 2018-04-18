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
        if (session('user') === null){
            return redirect('/');
        }

        $genres = Genre::all();

        session(['genres' => $genres]);

        $songs = Song::where('user_id', session('user')->id)->get();

        session(['songs' => $songs]);

        return view('user.songs');
    }

    public function add_song(Request $request){
        if (session('user') === null){
            return redirect('/');
        }

        $request->validate([
            'file' => 'max:102400',
        ], [
            'file.max:102400' => 'The file exceeds the upload maximum (100MB).',
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

    public function removeSong(Request $request){
        if (session('user') === null){
            return redirect('/');
        }

        if ($request->has('song_id')){
            $song = Song::find($request->song_id);

            if ($song !== null){
                $song->delete();
            }
        }

        return back();
    }

    public function showSongs(Request $request){
        $songs = Song::all();

        session(['songs' => $songs]);
    }
}