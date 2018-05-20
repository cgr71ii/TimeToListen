<?php

namespace App\ServiceLayer;

use Illuminate\Support\Facades\DB;

use App\User;
use App\Song;

use Auth;

class SongServices {
    public static function addSong($request){
        $rollback = false;
        DB::beginTransaction();

        if (Auth::user() === null){
            $rollback = true;
        }

        $request->validate([
            'file' => 'max:102400',
        ], [
            'file.max:102400' => 'The file exceeds the upload maximum (100MB).',
        ]);

        if (empty($request->song_name) || empty($request->file) || empty($request->chosen_genres)){
            $rollback = true;
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
            session(['user' => $user]);
            
        }
        else{
            $rollback = true;
        }

        if($rollback){
            DB::rollback();
            return 'errorfile';
        } else {
            DB::commit();
            return 'success';

        }
    }

    public static function deleteSong($request){
        $rollback = false;
        DB::beginTransaction();

        if (Auth::user() === null){
            $rollback = true;
        }
        if ($request->has('song_id')){
            $song = Song::find($request->song_id);

            if ($song !== null){
                $song->delete();

                if (Auth::user()->song_status !== null && Auth::user()->song_status->id == $request->song_id)
                {
                    //Auth::user()->song_status()->associate(null);
                    Auth::user()->song_status()->dissociate();
                    Auth::user()->save();
                }
            } else {
                $rollback = true;
            }
        } else {
            $rollback = true;
        }
        if($rollback){
            DB::rollback();
        }

        DB::commit();
    }

}