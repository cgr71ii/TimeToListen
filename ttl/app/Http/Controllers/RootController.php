<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RootController extends Controller
{
    
    public function show()
    {
        if (session('username') !== null)
        {
            return redirect('/profile');
        }

        return view('loginsignup');
    }

}
