<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;

class RootController extends Controller
{
    
    public function show()
    {
        if (Cookie::get('TTLusername') !== null && Cookie::get('TTLpassword') !== null)
        {
            // Then log in with cookie credentials.
        }

        if (session('username') !== null)
        {
            return redirect('/profile');
        }

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
