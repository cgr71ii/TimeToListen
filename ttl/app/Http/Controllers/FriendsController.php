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


        if(request()->has('empty'))
        {
            $friends=[];
        }
        else
        {
            $friends = $this->getFriends("1");
        }
        

        return view('friends.friends',compact('friends'));

    }

    public function viewFriend($email)
    {
        $count = User::where('email',$email)->count();

        if($count<1){ 
            return 'This User Dont Exist';
        }

        return view('friends.friendprofile',compact('email'));
    }

    public function viewFriendSongs($email)
    {
        $count = User::where('email',$email)->count();

        if($count<1){ 
            return 'This User Dont Exist';
        }

        return view('friends.friendsongs',compact('email'));
    }

    public function deleteFriend($email)
    {
        $friends = $this->getFriends("1");

        $u = User::where('email',$email)->first();

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
        


        return "A implementar";
    }

    public function deleteF(Request $request)
    {
        $friend = $request->friend;
        if ($request->has('confirm')) {
            if ($request->confirm == 'Yes') {
                $user1 = DB::table('user_user')->where('user_id','1')->where('user_friend_id',$friend);
                $user2 = DB::table('user_user')->where('user_friend_id','1')->where('user_id',$friend);

                if($user1->count()>0)
                {
                    foreach($user1 as $user)
                    {
                        return "Escribir la linea de eliminacion en el codigo";
                    }
                }
                if($user2->count()>0)
                {
                    foreach($user2 as $user)
                    {
                        return "Escribir la linea de eliminacion en el codigo";
                    }
                }
            }
            else if ($request->confirm == 'No') {
                return "Operation Cancelled";
            } 
        }
        return redirect('/friends');
    }


}
