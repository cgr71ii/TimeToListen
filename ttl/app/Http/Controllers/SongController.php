<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceLayer\SongServices;
use App\User;
use App\Song;
use App\Genre;
use Cookie;
use Redirect;

use Auth;

class SongController extends Controller
{

    public function show(Request $request){
        $genres = Genre::all();

        session(['genres' => $genres]);

        $songs = Song::where('user_id', Auth::user()->id);

        if ($request->has('order-form'))
        {
            session([   'song_field' => null, 
                        'song_direction' => null]);
        }
        else if (session('song_field') === null || (session('song_field') == 'created_at' && session('song_direction') == 'desc'))
        {
            session([   'song_field' => 'created_at',
                        'song_direction' => 'desc']);
        }

        if (session('song_field') !== null)
        {
            $songs = $songs->orderBy(session('song_field'), session('song_direction'));
        }
        else if ($request->has('field') && $request->has('direction'))
        {
            $songs = $songs->orderBy($request->field, $request->direction);

            session([   'song_field' => $request->field,
                        'song_direction' => $request->direction]);
        }

        $songs = $songs->simplePaginate(5);

        session(['songs' => $songs]);

        if ($request->ajax())
        {
            return view('song.songs-pag', ['songs' => $songs])->render();
        }

        return view('song.songs');
    }

    public function add_song(Request $request){
        if ($request->song_name === null || $request->chosen_genres === null || $request->file === null)
        {
            return back()->with('emptyfields', true);
        }

        $response = SongServices::addSong($request);
        return back()->with($response, true);

        /*if (session('user') === null){
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

        $user = Auth::user();
        $audio = $request->file('file');
        $audioName = $user->email . ' - ' . $sname . '.' . $audio->getClientOriginalExtension();

        if (substr($audioName, -4) == '.mp4' || substr($audioName, -4) == '.wav'){
            $audio->move(public_path('/user/songs'), $audioName);

            $song = new Song([
                'name' => $sname,
                'song_path' => "user/songs/$audioName",
                'user_id' => Auth::user()->id
            ]);
            $song->save();
            
            foreach($sgenres as $sgenre){
                $song->genres()->attach($sgenre);
                $song->save();
            }

            $user = User::find(Auth::user()->id);
            //session(['user' => $user]);

            return back()->with('success', true);
        }
        else{
            return back()->with('errorfile', true);
        }

        return back();*/
    }

    public function removeSong(Request $request){
        SongServices::deleteSong($request);
        return back();
        /*if (session('user') === null){
            return redirect('/');
        }
        if ($request->has('song_id')){
            $song = Song::find($request->song_id);

            if ($song !== null){
                $song->delete();

                if (Auth::user()->song_status !== null && Auth::user()->song_status->id == $request->song_id)
                {
                    //session('user')->song_status()->associate(null);
                    Auth::user()->song_status()->dissociate();
                    Auth::user()->save();
                }
            }
        }

        return back();*/
    }

    public function listSongs(Request $request){
        //dd(Auth::user());
        $songs = Song::where('id', '>=', '0');

        if ($request->has('order-form'))
        {
            session([   'song_list_field' => null, 
                        'song_list_direction' => null]);
        }
        else if (session('song_list_field') === null || (session('song_list_field') == 'created_at' && session('song_list_direction') == 'desc'))
        {
            session([   'song_list_field' => 'created_at',
                        'song_list_direction' => 'desc']);
        }

        if (session('song_list_field') !== null)
        {
            $songs = $songs->orderBy(session('song_list_field'), session('song_list_direction'));
        }
        else if ($request->has('field') && $request->has('direction'))
        {
            session([   'song_list_field' => $request->field,
                        'song_list_direction' => $request->direction]);

            $songs = $songs->orderBy($request->field, $request->direction);
        }

        $songs = $songs->simplePaginate(5);

        if ($request->ajax())
        {
            return view('lists.pag.songs', ['songs' => $songs])->render();
        }

        return view('lists.list-songs', ['songs' => $songs]);
    }

    public function update(Request $request)
    {
        if ($request->has('song_id'))
        {
            $song = Song::find($request->song_id);

            if ($request->has('name') && !empty($request->name))
            {
                $song->name = $request->name;
            }

            if ($request->has('song_path') && !empty($request->song_path))
            {
                $song->song_path = $request->song_path;
            }

            $song->save();
    
            if (Auth::user()->song_status !== null && Auth::user()->song_status->id == $song->id)
            {
                Auth::user()->song_status = $song;
            }
        }

        return back();
    }
}