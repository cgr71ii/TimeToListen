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

        if (session('user') === null)
        {
            return redirect('/');
        }

        if(request()->has('empty'))
        {
            $friends=[];
            $groups=[];
        }
        else
        {
            $friends = $this->getFriends(session('user')->id);

            $groups = DB::table('group_user')->where('user_id',session('user')->id)->join('groups',function($join){
                $join->on('id','group_id');
            })->get();
            
            
        }
        
        return view('groups.groups',compact('friends','groups'));

    }

    public function createGroup(Request $request)
    {
        if($request->friend_list == null || $request->newgroupname==null)
        {
            return 'ERROR. Campos vacios';
        }

        //Comprueba que el usuario no tiene un grupo con el mmismo nombre
        $g = Group::where('name',$request->newgroupname)->first();
        if($g!=null)
        {
            $count = DB::table('group_user')->where('user_id',session('user')->id)->where('group_id',$g->id)->count();

        }
        else
        {
            $count = 0;
        }
        
        if($count>0)
        {
            return 'Ya existe el grupo';
        }

        if (in_array("allfriends", $request->friend_list))
        {
            $friends = $this->getFriends(session('user')->id);

            $group = new Group([
                'creator_id' => session('user')->id,
                'name' => $request->newgroupname
            ]);

            $group->save();

            $group = Group::where('name',$request->newgroupname)->FirstOrFail();

            foreach($friends as $friend)
            {
                $user = User::where('id', $friend->id)->FirstOrFail();
                $user->group_user()->attach($group->id);
            }
        }
        else
        {
            $friends = $request->friend_list; 

            $group = new Group([
                'creator_id' => session('user')->id,
                'name' => $request->newgroupname
            ]);

            $group->save();

            $group = Group::where('name',$request->newgroupname)->FirstOrFail();

            foreach($friends as $friend_id)
            {
                $user = User::where('id', $friend_id)->FirstOrFail();
                $user->group_user()->attach($group->id);
            }
        }

        
        
        session('user')->group_user()->attach($group->id);

        return redirect('/groups');
    }

    public function addFriend(Request $request)
    {

        $group = Group::where('id',$request->group_id)->First();


        if (in_array("allfriends", $request->friend_list))
        {
            $friends = $this->getFriends(session('user')->id);

            foreach($friends as $friend)
            {
                $user = User::where('id', $friend->id)->FirstOrFail();

                $count = DB::table('group_user')->where('user_id',$friend->id)->where('group_id',$request->group_id)->count();
                
                if($count<1)
                {
                    $user->group_user()->attach($group->id);
                }
            }
        }
        else
        {
            $friends = $request->friend_list;

            foreach($friends as $friend_id)
            {
                $user = User::where('id', $friend_id)->FirstOrFail();
                
                $count = DB::table('group_user')->where('user_id',$friend_id)->where('group_id',$request->group_id)->count();
                if($count<1)
                {
                    $user->group_user()->attach($group->id);
                }
            }
        }
        
        return redirect('groups/'.$group->id);
    }

    public function groupPublications($id)
    {
        if(Group::where('id',$id)->where('creator_id',session('user')->id)->count()>0)
        {
            $changeP=true; 
        }
        else
        {
            $changeP=false; 
        }

        if (session('user') === null)
        {
            return redirect('/');
        }

        $group = Group::find($id);

        if($group == null )
        {
            return 'The Group Does Not Exist';
        }

        $members = DB::table('group_user')->where('group_id',$id)->join('users',function($join){
            $join->on('id','user_id');
        })->get();

        foreach($members as $member)
        {
            if($member->id == session('user')->id)
            {
                $publications = DB::table('publications')->where('group_id',$id)->join('users',function($join){
                    $join->on('publications.user_id','users.id');
                })->get();
        
                $friends = $this->getFriends(session('user')->id);    

                return view('groups.groupPublications',compact('group','friends','members','publications','changeP'));
            }
        }

        return redirect('/groups',compact('changeP'));
        
    }

    public function exit($id)
    {
        $toDelete = DB::table('group_user')->where('user_id',session('user')->id)->where('group_id',$id)->first();
        $user = User::where('id',session('user')->id)->FirstOrFail();
        if($toDelete==null)
        {
            return redirect('/groups');
        }
        $user->group_user()->detach($toDelete->group_id);

        $count = DB::table('group_user')->where('group_id',$id)->count();
        //si no hay personas en un grupo se elimina
        if($count<1 || Group::find($id)->creator_id==session('user')->id)
        {
            $group = Group::find($id);
            $group->delete();
        }

        return redirect('/groups');
    }

    public function showChangeName($id) 
    {
        $count = Group::where('id',$id)->where('creator_id',session('user')->id)->count();

        if($count<1)
        {
            
            return redirect('groups/'.$id);
        }        

        return view('groups.groupNameModification',compact('id'));
    }

    public function changeName(Request $request)
    {
        if( $request->newgroupname!=null)
        {
            $group = Group::find($request->id);
            if($group!=null)
            {
                $group->fill(['name' => $request->newgroupname])->save();
            }
        }
        return redirect('groups/'.$request->id);
        
    }

}
