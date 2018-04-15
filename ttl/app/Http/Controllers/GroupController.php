<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Group;
use DB;

class GroupController extends Controller
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


    public function show(Request $request)
    {


        if(request()->has('empty'))
        {
            $friends=[];
            $groups=[];
        }
        else
        {
            $friends = $this->getFriends("1");

            $groups = DB::table('group_user')->where('user_id','1')->join('groups',function($join){
                $join->on('id','group_id');
            })->get();
            
            
        }
        
        return view('groups.groups',compact('friends','groups'));

    }

    public function createGroup(Request $request)
    {
        return 'Test';
    }

    public function groupPublications($id)
    {
        if(Group::find($id) == null )
        {
            return 'The Group Does Not Exist';
        }

        $group = Group::find($id)->first();
        $friends = $this->getFriends("1");

        $members = DB::table('group_user')->where('group_id',$id)->join('users',function($join){
            $join->on('id','user_id');
        })->get();

        $publications = DB::table('publications')->where('group_id',$id)->join('users',function($join){
            $join->on('publications.user_id','users.id');
        })->get();

        return view('groups.groupPublications',compact('group','friends','members','publications'));
    }

}
