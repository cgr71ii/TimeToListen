<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Publication;
use App\Song;
use Cookie;
use Redirect;
use Session;

class UserController extends Controller
{

    public function show(Request $request)
    {
        if  (session('user') !== null)
        {

            {
                // We update pagination recalling the methods again.

                $publications = Publication::where('user_id', session('user')->id);

                if ($request->has('order-form') || $request->has('find-form'))
                {
                    session([   'pub_data_field' => null, 
                                'pub_data_direction' => null,
                                'pub_data_min_date' => null,
                                'pub_data_max_date' => null,
                                'pub_data_pub_contains' => null,
                                'pub_data_date_field' => null]);
                }
                else
                {
                    $publications = $publications->orderBy('created_at', 'desc');
                }

                if (session('pub_data_field') !== null)
                {
                    $publications = $publications->orderBy(session('pub_data_field'), session('pub_data_direction'));
                }
                else if ($request->has('field') && $request->has('direction'))
                {
                    $publications = $publications->orderBy($request->field, $request->direction);

                    session([   'pub_data_field' => $request->field,
                                'pub_data_direction' => $request->direction]);
                }

                if (session('pub_data_pub_contains') !== null)
                {
                    $publications = $publications->where('text', 'like', '%' . session('pub_data_pub_contains') . '%');
                }
                else if ($request->has('pub_contains') && !empty($request->pub_contains))
                {
                    $publications = $publications->where('text', 'like', '%' . $request->pub_contains . '%');
                    
                    session(['pub_data_pub_contains' => $request->pub_contains]);
                }

                if (session('pub_data_min_date') !== null)
                {
                    $publications = $publications->whereBetween(session('pub_data_date_field'), array(session('pub_data_min_date'), session('pub_data_max_date')));
                }
                else if ($request->has('min_date') && $request->has('max_date') && $request->has('date_field') && !empty($request->min_date) && !empty($request->max_date) && strtotime($request->min_date) <= strtotime($request->max_date))
                {
                    $min_date = "$request->min_date 00:00:00";
                    $max_date = "$request->max_date 23:59:59";

                    $publications = $publications->whereBetween($request->date_field, array($min_date, $max_date));

                    session([   'pub_data_min_date' => $min_date,
                                'pub_data_max_date' => $max_date,
                                'pub_data_date_field' => $request->date_field]);
                }

                $publications = $publications->simplePaginate(5);

                session([   'publications' => $publications,
                            'publication_session_name' => 'publications']);
            }

            if ($request->ajax())
            {
                return view('publication.publications', ['publications' => session('publications'), 'actions' => true])->render();  
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

            foreach (session('user')->following()->get() as $f)
            {
                if ($f->id == $friend->id)
                {
                    $friend_publications = Publication::where('user_id', $friend->id);

                    if ($request->has('order-form') || $request->has('find-form'))
                    {
                        session([   'friend_data_field' => null, 
                                    'friend_data_direction' => null,
                                    'friend_data_min_date' => null,
                                    'friend_data_max_date' => null,
                                    'friend_data_pub_contains' => null,
                                    'friend_data_date_field' => null]);
                    }
                    else
                    {
                        $friend_publications = $friend_publications->orderBy('created_at', 'desc');
                    }

                    if (session('friend_data_field') !== null)
                    {
                        $friend_publications = $friend_publications->orderBy(session('friend_data_field'), session('friend_data_direction'));
                    }
                    else if ($request->has('field') && $request->has('direction'))
                    {
                        $friend_publications = $friend_publications->orderBy($request->field, $request->direction);

                        session([   'friend_data_field' => $request->field,
                                    'friend_data_direction' => $request->direction]);
                    }

                    if (session('friend_data_pub_contains') !== null)
                    {
                        $friend_publications = $friend_publications->where('text', 'like', '%' . session('friend_data_pub_contains') . '%');
                    }
                    else if ($request->has('pub_contains') && !empty($request->pub_contains))
                    {
                        $friend_publications = $friend_publications->where('text', 'like', '%' . $request->pub_contains . '%');
                        
                        session(['friend_data_pub_contains' => $request->pub_contains]);
                    }

                    if (session('friend_data_min_date') !== null)
                    {
                        $friend_publications = $friend_publications->whereBetween(session('friend_data_date_field'), array(session('friend_data_min_date'), session('friend_data_max_date')));
                    }
                    else if ($request->has('min_date') && $request->has('max_date') && $request->has('date_field') && !empty($request->min_date) && !empty($request->max_date) && strtotime($request->min_date) <= strtotime($request->max_date))
                    {
                        $min_date = "$request->min_date 00:00:00";
                        $max_date = "$request->max_date 23:59:59";

                        $friend_publications = $friend_publications->whereBetween($request->date_field, array($min_date, $max_date));

                        session([   'friend_data_min_date' => $min_date,
                                    'friend_data_max_date' => $max_date,
                                    'friend_data_date_field' => $request->date_field]);
                    }

                    $friend_publications = $friend_publications->simplePaginate(5);

                    session([   'friend' => $friend,
                                'friend_publications' => $friend_publications,
                                'publication_session_name' => 'friend_publications']);
    
                    if ($request->ajax())
                    {
                        return view('publication.publications', ['publications' => $friend_publications])->render();
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
        //session(['user' => null]);
        Session::flush();

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
        $users = User::where('id', '>=', '0');

        if ($request->has('order-form') || $request->has('find-form'))
        {
            session([   'list_user_field' => null, 
                        'list_user_direction' => null,
                        'list_user_min_date' => null,
                        'list_user_max_date' => null,
                        'list_user_email_contains' => null]);
        }

        if (session('list_user_field') !== null)
        {
            $users = $users->orderBy(session('list_user_field'), session('list_user_direction'));
        }
        else if ($request->has('field') && $request->has('direction'))
        {
            session([   'list_user_field' => $request->field,
                        'list_user_direction' => $request->direction]);

            $users = $users->orderBy($request->field, $request->direction);
        }

        if (session('list_user_min_date') !== null)
        {
            $users = $users->whereBetween('birthday', array(session('list_user_min_date'), session('list_user_max_date')));
        }
        else if ($request->has('min_age') && $request->has('max_age') && (!empty($request->min_age) || $request->min_age == '0') && (!empty($request->max_age) || $request->max_age == '0') && $request->min_age <= $request->max_age)
        {
            $today = strtotime(date("Y-m-d"));
            $current_year = substr(date("Y-m-d"), 0, 4);

            $min_date = ($current_year - $request->max_age).substr(date("Y-m-d"), 4, 10);
            $max_date = ($current_year - $request->min_age).substr(date("Y-m-d"), 4, 10);

            session([   'list_user_min_date' => $request->min_date,
                        'list_user_max_date' => $request->max_date]);

            $users = $users->whereBetween('birthday', array($min_date, $max_date));
        }

        if (session('list_user_email_contains') !== null)
        {
            $users = $users->where('email', 'like', '%' . session('list_user_email_contains') . '%');
        }
        else if ($request->has('email_contains') && !empty($request->email_contains))
        {
            session(['list_user_email_contains' => $request->email_contains]);

            $users = $users->where('email', 'like', '%' . $request->email_contains . '%');
        }

        $users = $users->simplePaginate(5);

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

    public function showSettings()
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

        if ($request->has('user_id'))
        {
            $user = User::find($request->user_id);
        }

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

        if (!$request->has('user_id') || $request->user_id == session('user')->id)
        {
            session(['user' => $user]);
        }

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
