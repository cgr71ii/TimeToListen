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

    public function show(Request $request){
        if (session('user') === null){
            return redirect('/');
        }

        $genres = Genre::all();

        session(['genres' => $genres]);

        $songs = Song::where('user_id', session('user')->id);

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
            // Transaction to save Song
            DB::beginTransaction();
            try{
                $song->save();
                DB::commit();
            } catch(\Exception $e){
                DB::rollback();
                return back()->with('errorfile', true);
            }
            
            foreach($sgenres as $sgenre){
                $song->genres()->attach($sgenre);
                $song->save();
            }

            $user = User::find(session('user')->id);
            session(['user' => $user]);

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
                // Transaction to save Song
                DB::beginTransaction();
                try{
                    $song->delete();
                    DB::commit();
                } catch(\Exception $e){
                    DB::rollback();
                    return back();
                }

                if (session('user')->song_status !== null && session('user')->song_status->id == $request->song_id)
                {
                    //session('user')->song_status()->associate(null);
                    session('user')->song_status()->dissociate();
                    session('user')->save();
                }
            }
        }

        return back();
    }

    public function listSongs(Request $request){
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

    public function update(Request $request){
        if (session('user') === null)
        {
            return redirect('/');
        }

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
            // Transaction to update Song
            DB::beginTransaction();
            try{
                $song->save();
                DB::commit();
            } catch(\Exception $e){
                DB::rollback();
                return back();
            }

            if (session('user')->song_status !== null && session('user')->song_status->id == $song->id)
            {
                session('user')->song_status = $song;
            }
        }

        return back();
    }
}