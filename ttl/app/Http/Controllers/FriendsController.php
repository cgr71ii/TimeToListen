<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class FriendsController extends Controller
{

    /*
    private function getFriends($id)
    {
        $users = array();

        if (User::find($id) == null )
        {
            return null;
        }

        $user1 = User::find($id)->following()->get();
        $user2 = User::find($id)->followers()->get();

        foreach ($user1 as $u)
        {
            array_push($users, $u);
        }

        foreach ($user2 as $u)
        {
            array_push($users, $u);
        }

        return $users;
    }
    */

    public function show(Request $request)
    {

        if (session('user') === null)
        {
            return redirect('/');
        }

        /*
        if(request()->has('empty'))
        {
            $friends=[];
        }
        else
        {
            $friends = $this->getFriends(session('user')->id);
        }
        */

        $friends = User::find(session('user')->id)->following();

        if ($request->has('order-form'))
        {
            session([   'friends_field' => null, 
                        'friends_direction' => null]);
        }
        else if (session('friends_field') === null || (session('friends_field') == 'created_at' && session('friends_direction') == 'desc'))
        {
            session([   'friends_field' => 'created_at',
                        'friends_direction' => 'desc']);
        }

        if (session('friends_field') !== null)
        {
            $friends = $friends->orderBy(session('friends_field'), session('friends_direction'));
        }
        else if ($request->has('field') && $request->has('direction'))
        {
            session([   'friends_field' => $request->field,
                        'friends_direction' => $request->direction]);

            $friends = $friends->orderBy($request->field, $request->direction);
        }

        $friends = $friends->simplePaginate(5);

        if ($request->ajax())
        {
            return view('friends.friends-pag', ['friends' => $friends])->render();
        }
        
        return view('friends.friends',compact('friends'));

    }

    /*
    public function viewFriend($email)
    {
        if (session('user') === null)
        {
            return redirect('/');
        }

        $friends = $this->getFriends(session('user')->id);

        foreach($friends as $friend)
        {
            if ($friend->email == $email)
            {    
                return view('friends.friendprofile',compact('email','friend'));
            }
        }

        return "This User Is Not Your Friend";
    }

    public function viewFriendSongs($email)
    {
        if (session('user') === null)
        {
            return redirect('/');
        }

        $friends = $this->getFriends(session('user')->id);

        foreach($friends as $friend)
        {
            if ($friend->email == $email)
            {    
                return view('friends.friendsongs',compact('email'));
            }
        }

        return "This User Is Not Your Friend";
    }
    */


    public function deleteFriend(Request $request, $email)
    {
        if (session('user') === null)
        {
            return redirect('/');
        }
        
        /*
        $friends = $this->getFriends(session('user')->id);

        foreach($friends as $friend)
        {
            if ($friend->email == $email)
            {
                return view('friends.deletefriend',compact('friend'));
            }
        }
        */

        $friends = User::find(session('user')->id)->following()->get();

        foreach($friends as $friend)
        {
            if ($friend->email == $email)
            {
                return view('friends.deletefriend',compact('friend'));
            }
        }

        return 'This User Is Not Your Friend';  
    }

    public function addFriend(Request $request)
    {
        /*
        $toAdd = DB::table('users')->where('email',$request->email)->get();
        $count = $toAdd->count();

        if($count<1)
        {
            return 'El Usuario No Existe';
        }
        
        $friends =  $this->getFriends(session('user')->id);

        foreach($friends as $friend)
        {
            if($friend->id == $toAdd[0]->id)
            {
                return 'El Usuario Ya Es Tu Amigo';
            }
            else if($toAdd[0]->id == session('user')->id)
            {
                return 'No puede introducir su email';
            }
        }

        session('user')->following()->attach($toAdd[0]->id);
        
        return redirect('/friends');
        */

        $friend = User::where('email', $request->email)->get();

        $count = $friend->count();

        if($count == 0)
        {
            return back()->with("The user $request->email does not exist.");
        }
        else if ($friend[0]->id == session('user')->id)
        {
            return back()->with('error_self_friend', true);
        }

        $my_friends = session('user')->following;

        foreach ($my_friends as $my_friend)
        {
            if ($my_friend->id == $friend[0]->id)
            {
                return back()->with("The user $request->email is your friend already.");
            }
        }

        session('user')->following()->attach($friend[0]->id);
        
        return back();

    }

    public function deleteF(Request $request)
    {
        $friend = $request->friend;
        if ($request->has('confirm')) {
            if ($request->confirm == 'Yes') {
                $user1 = DB::table('user_user')->where('user_id',session('user')->id)->where('user_friend_id',$friend)->get();
                $user2 = DB::table('user_user')->where('user_friend_id',session('user')->id)->where('user_id',$friend)->get();

                if($user1->count()>0)
                {
                    foreach($user1 as $user)
                    {
                        session('user')->following()->detach($friend);
                    }
                }
                if($user2->count()>0)
                {
                    foreach($user2 as $user)
                    {
                        $u=User::find($user->user_id);
                        $u->following()->detach(session('user'));
                    }
                }
            }
            else if ($request->confirm == 'No') {
                return redirect('/friends');
            } 
        }
        return redirect('/friends');
    }


}
