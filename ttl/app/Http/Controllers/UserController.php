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

                session(['publications' => $publications,
                'publication_session_name' => 'publications']);
            }

            if ($request->ajax())
            {
                return view('user.publications', ['publications' => session('publications'), 'actions' => true])->render();
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
                                'publications' => $publications,
                                'publication_session_name' => 'publications']);

                    return view('user.profile');
                }
            }

            return redirect('/')->with('loginfail', true);
        }

        return redirect('/');
    }

    public function showFriend(Request $request, $friend_email)
    {
        if  (session('user') === null)
        {
            return redirect('/');
        }

        $count = User::where('email', $friend_email)->count();

        if ($count == 1)
        {
            $friend = User::where('email', $friend_email)->first();

            foreach (session('user')->userFriends as $f)
            {
                if ($f->id == $friend->id)
                {
                    $friend_publications = Publication::where('user_id', $friend->id)->orderBy('created_at', 'desc')->simplePaginate(5);

                    session([   'friend' => $friend,
                                'friend_publications' => $friend_publications,
                                'publication_session_name' => 'friend_publications']);
    
                    if ($request->ajax())
                    {
                        return view('user.publications', ['publications' => $friend_publications])->render();
                    }
    
                    return view('user.friend-profile');
                }
            }

            return back()->with('error_not_friend', true)->with('user_friend', $friend_email);
        }

        return back()->with('error_non_existent_user', true)->with('user_friend', $friend_email);
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

    public function publicate(Request $request)
    {
        if (session('user') === null)
        {
            return redirect('/');
        }

        if ($request->has('publication'))
        {
            if (empty($request->publication))
            {
                return back()->with('create_publication_fail', true);
            }

            $publication = new Publication([
                'text' => $request->publication,
                'user_id' => session('user')->id,
                'date' => date('Y-m-d h:i:s', time())
            ]);
            $publication->save();

            return redirect('/profile');
        }

        return redirect('/profile')->with('unexpected_error', true);
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
    }

    public function modifyPublication(Request $request)
    {
        if (session('user') === null)
        {
            return redirect('/');
        }

        if ($request->has('publication') && $request->has('publication_id'))
        {
            if (empty($request->publication))
            {
                return back()->with('publication_fail', true);
            }

            $count = Publication::where('id', $request->publication_id)->count();

            if ($count == 1)
            {
                $pub = Publication::where('id', $request->publication_id)->first();
                $pub->text = $request->publication;
                //$pub->date = date('Y-m-d h:i:s', time());
                $pub->save();

                return back();
            }
        }
        
        return back()->with('error_unexpected', true);
    }

    public function listUsers(Request $request)
    {
        /*
         * We use ::where(tautology) to get a Builder object and be able to use simplePaginate().
         * If we use ::get() then it returns a collection of objects and it is not possible to use simplePaginate().
         */
        $users = User::where('id', '>=', '0')->simplePaginate(5);

        if ($request->ajax())
        {
            return view('lists.pag.users', ['users' => $users])->render();
        }

        return view('lists.list-users', ['users' => $users]);
    }

    public function remove(Request $request)
    {
        if (session('user') === null)
        {
            return redirect('/');
        }

        $my_id = session('user')->id;

        $user = session('user');

        if ($request->has('user_id'))
        {
            $user = User::find($request->user_id);
        }
        
        $user->delete();

        if ($my_id == $request->user_id)
        {
            session(['user' => null]);

            return redirect('/');
        }

        return back();
    }

}
