<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Cookie;
use Redirect;

class UserController extends Controller
{
    
    public function show($username)
    {
        $count = User::where('email', $username)->count();

        if ($count == 1)
        {
            $user = User::where('email', $username)->first();

            return view('user.profile', ["user" => $user]);
        }

        return view('loginsignup', ["loginfail" => "true"]);
    }

    public function login(Request $request)
    {
        if ($request->has('username') && $request->has('password'))
        {
            if ($request->has('remember'))
            {
                // Creating cookies.

                // 15 days.
                $minutes = 60 * 24 * 15;

                Cookie::queue(Cookie::make('TTLusername', $request->username, $minutes));
                Cookie::queue(Cookie::make('TTLpassword', $request->password, $minutes));
            }

            // Checking if user is valid.

            $count = User::where('email', $request->username)->count();

            if ($count == 1)
            {
                $user = User::where('email', $request->username)->first();

                if ($user->password === $request->password)
                {
                    session(["username" => $request->username]);

                    return view('user.profile');
                }
            }

            return view('loginsignup', ["loginfail" => true]);
        }
    }

    public function logout()
    {
        session(["username" => null]);

        return redirect('/');
    }

    public function signup(Request $request)
    {
        if ($request->has('name') && $request->has('lname') && 
            $request->has('username') && $request->has('password') && 
            $request->has('birthday'))
        {
            $user = new User([  'email' => $request->username, 
                                'password' => $request->password, 
                                'name' => $request->name,
                                'lastname' => $request->lname,
                                'birthday' => "$request->birthday 00:00:00",
                                'pic_profile_path' => 'default-user.png']);
            $user->save();

            session(["username" => $user->email]);

            //return redirect('/profile');
        }

        return redirect('/')->with('signupfail', 'asd');
    }

}
