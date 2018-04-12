<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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


        return back()->with('success', 'You have successfully change your information.');
    }

    public function updateImage(Request $request)
    {
        request()->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $image = $request->file('image');

        $imageName = time().'.'.$image->getClientOriginalExtension();

        $image->move(public_path('images'), $imageName);

        return back()->with('success','You have successfully upload image.')->with('image',$imageName);
    }

}
