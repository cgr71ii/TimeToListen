<?php

namespace App\ServiceLayer;

use Illuminate\Support\Facades\DB;

use App\User;
use App\Group;
use App\Publication;

use Auth;


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
            $count = DB::table('group_user')->where('user_id',Auth::user()->id)->where('group_id',$g->id)->count();
        }
        else
        {
            $count = 0;
        }
        
        if($count != 0)
        {
            $rollback = true;
        }

        if (Group::where('name', $request->newgroupname)->count() != 0)
        {
            $rollback = true;
        }
        else
        {
            if (in_array("allfriends", $request->friend_list))
            {
                $friends = Auth::user()->following()->get();

                $group = new Group([
                    'creator_id' => Auth::user()->id,
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
                    'creator_id' => Auth::user()->id,
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
        }

        
        
        if($rollback){
            DB::rollBack();
        } else {
            Auth::user()->group_user()->attach($group->id);

            $update_user = User::find(Auth::user()->id);
        
            session(['user' => $update_user]);

        }
        DB::commit();

        return !$rollback;
    }

    public static function exitGroup($request){
        $rollback = false;
        DB::beginTransaction();

        if (Auth::user() === null)
        {
            $rollback = true;
        }

        if ($request->has('group_id'))
        {
            //$group = Group::find($request->group_id);
            $group = Group::where('id', $request->group_id);

            $count = $group->get()->count();
            
            if ($count == 1)
            {
                if ($group->get()[0]->creator_id == Auth::user()->id)
                {
                    $group->delete();
                }
                else
                {
                    Auth::user()->group_user()->detach($request->group_id);
                }

                
            } else {
                $rollback = true;
            }
        } else {
            $rollback = true;
        }

        if($rollback){
            DB::rollBack();
        }
        
        DB::commit();
           
        $groups = Auth::user()->group_user();

    }


}
