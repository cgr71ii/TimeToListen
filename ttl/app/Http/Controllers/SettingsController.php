<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Song;

class SettingsController extends Controller
{
    
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function show()
    {
        if (session('user') === null)
        {
            return redirect('/');
        }

        return view('settings');
    }

    public function update(Request $request)
    {
        if (session('user') === null)
        {
            return redirect('/');
        }

        $user = session('user');

        if ($request->has('name') && !empty($request->name))
        {
            $user->name = $request->name;
        }

        if ($request->has('lname') && !empty($request->lname))
        {
            $user->lastname = $request->lname;
        }

        if ($request->has('username') && !empty($request->username))
        {
            $user->email = $request->username;
        }

        if ($request->has('birthday') && !empty($request->birthday))
        {
            $user->birthday = "$request->birthday 00:00:00";
        }

        if ($request->has('status_song') && count($request->status_song) == 1)
        {
            $status_song = $request->status_song[0];

            if (!empty($status_song) && is_numeric($status_song))
            {
                $song = Song::find($status_song);

                if ($song !== null)
                {
                    $user->song_status()->associate($song);
                }
            }
        }

        $user->save();

        session(['user' => $user]);

        return back()->with('success', 'You have successfully changed your information.');
    }

    public function updateImage(Request $request)
    {
        if (session('user') === null)
        {
            return redirect('/');
        }

        request()->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $user = session('user');

        $image = $request->file('image');

        $imageName = $user->email.'-'.time().'.'.$image->getClientOriginalExtension();

        $image->move(public_path('/user/pic_profile'), $imageName);

        $user->pic_profile_path = "user/pic_profile/$imageName";

        $user->save();

        session(['user' => $user]);

        return back()->with('success','You have successfully uploaded the image.');
    }

}
