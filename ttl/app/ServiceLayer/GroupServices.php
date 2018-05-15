<?php

namespace App\ServiceLayer;

use Illuminate\Support\Facades\DB;

use App\User;
use App\Group;
use App\Publication;


class GroupServices {
    public static function createGroup($request){
        $rollback = false;
        DB::beginTransaction();

        if($request->friend_list == null || $request->newgroupname == null)
        {
            $rollback = true;
        }

        $g = Group::where('name',$request->newgroupname);

        if ($g->count() != 0)
        {
            $rollback = true;
        }

        $g = $g->first();

        if($g != null)
        {
            $count = DB::table('group_user')->where('user_id',session('user')->id)->where('group_id',$g->id)->count();
        }
        else
        {
            $count = 0;
        }
        
        if($count != 0)
        {
            $rollback = true;
        }

        if (in_array("allfriends", $request->friend_list))
        {
            $friends = session('user')->following()->get();

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
        
        if($rollback){
            DB::rollBack();
        } else {
            session('user')->group_user()->attach($group->id);

            $update_user = User::find(session('user')->id);
        
            session(['user' => $update_user]);

        }
            DB::commit();

    }
}
