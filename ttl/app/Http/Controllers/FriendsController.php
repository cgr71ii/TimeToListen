<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class FriendsController extends Controller
{
    private function getFriends($id)
    {
        $users = array();

        if (User::find($id) == null )
        {
            return null;
        }

        $user1 = User::find($id)->users()->get();
        $user2 = User::find($id)->userFriends()->get();

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

    public function indexFriends(Request $request)
    {

        if (session('user') === null)
        {
            return redirect('/');
        }

        if(request()->has('empty'))
        {
            $friends=[];
        }
        else
        {
            $friends = $this->getFriends(session('user')->id);
        }
        

        return view('friends.friends',compact('friends'));

    }

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


    public function deleteFriend($email)
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
                return view('friends.deletefriend',compact('friend'));
            }
        }

        return 'This User Is Not Your Friend';  
    }

    public function addFriend(Request $request)
    {
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

        session('user')->users()->attach($toAdd[0]->id);
        
        return redirect('/friends');
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
                        session('user')->users()->detach($friend);
                    }
                }
                if($user2->count()>0)
                {
                    foreach($user2 as $user)
                    {
                        $u=User::find($user->user_id);
                        $u->users()->detach(session('user'));
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
