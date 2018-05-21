<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;

use Auth;

class RootController extends Controller
{
    
    public function show()
    {
        if (Cookie::get('TTLusername') !== null && Cookie::get('TTLpassword') !== null)
        {
            // Then log in with cookie credentials.
        }

        /*
        if (Auth::user() !== null)
        {
            return redirect('/profile');
            //return redirect('/profile')->with('user', session('user'));
        }
        */

        // Error.

        if (isset($loginfail))
        {
            return view('loginsignup', ["loginfail" => $loginfail]);
        }
        if (isset($signupfail))
        {
            return view('loginsignup', ["signupfail" => $signupfail]);
        }
        
        return view('loginsignup');
    }

}
