<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Publication;
use Cookie;
use Redirect;

class UserController extends Controller
{

    public function login(Request $request)
    {
        if  (session('user') !== null)
        {
            {
                // We update pagination recalling the methods again.

                $publications = Publication::where('user_id', session('user')->id)->orderBy('created_at', 'desc')->simplePaginate(5);

                session(['publications' => $publications]);
            }

            if ($request->ajax()) {
                return view('user.publications', ['publications' => session('publications')])->render();  
            }

            return view('user.profile');
        }

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
                    //$publications = $user->publication->paginate(1);
                    $publications = Publication::where('user_id', $user->id)->orderBy('created_at', 'desc')->simplePaginate(5);

                    session([   'user' => $user,
                                'publications' => $publications]);

                    if ($request->ajax()) {
                        return view('publications', ['user.publications' => $publications])->render();  
                    }

                    return view('user.profile');
                }
            }

            return redirect('/')->with('loginfail', true);
        }

        return redirect('/');
    }

    public function logout()
    {
        session(['user' => null]);

        return redirect('/');
    }

    public function signup(Request $request)
    {
        if ($request->has('name') && $request->has('lname') && 
            $request->has('username') && $request->has('password') && 
            $request->has('birthday'))
        {
            if (empty($request->name) || empty($request->lname) || 
                empty($request->username) || empty($request->password) ||
                empty($request->birthday))
            {
                return redirect('/')->with('signupfailemptyfield', true);
            }

            $count = User::where('email', $request->username)->count();

            if ($count != 0)
            {
                return redirect('/')->with('signupfailuserexists', true);
            }

            $user = new User([  'email' => $request->username,
                                'password' => $request->password,
                                'name' => $request->name,
                                'lastname' => $request->lname,
                                'birthday' => "$request->birthday 00:00:00",
                                'pic_profile_path' => 'default-user.png']);
            $user->save();

            session(['user' => $user]);

            return redirect('/profile');
        }

        return redirect('/')->with('signupfail', true);
    }

   /* public function publicate(Request $request)
    {
        if (session('user') === null)
        {
            return redirect('/');
        }

        if ($request->has('publication'))
        {
            $publication = new Publication([
                'text' => $request->publication,
                'user_id' => session('user')->id,
                'date' => date('Y-m-d h:i:s', time())
            ]);
            $publication->save();

            return redirect('/profile');
        }

        return redirect('/profile')->with('publicatefail', true);
    }

    public function removePublication(Request $request)
    {
        if (session('user') === null)
        {
            return redirect('/');
        }

        if ($request->has('publication_id'))
        {
            $pub = Publication::find($request->publication_id);

            if ($pub !== null)
            {
                $pub->delete();
            }
        }
        
        return redirect('/profile');
    }*/

}
