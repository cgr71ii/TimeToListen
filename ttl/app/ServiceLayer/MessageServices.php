<?php

namespace App\ServiceLayer;

use Illuminate\Support\Facades\DB;

use App\Message;

class MessageServices {
    public static function sendMessage($request){
        $rollback = false;
        DB::beginTransaction();
        $response = "";

        if (session('user') === null){
            $rollback = true;
            $response = "userFail";
        }

        if($request->has('receptors') && count($request->receptors) >= 1 && $request->has('title') && $request->has('body') && !empty($request->title) && !empty($request->body))
        {
            $message = new Message([
                'user_id' => session('user')->id,
                'title' => $request->title,
                'text' => $request->body,
                'read' => false,
                'date' => date('Y-m-d h:i:s', time())
            ]);
            
            $message->save();

            if (in_array('all_friends', $request->receptors))
            {
                $receptors = session('user')->following()->get();


                foreach($receptors as $receptor)
                {
                    DB::table('message_user')->insert(
                        array('message_id' => $message->id, 
                                'user_id' => $receptor->id)
                    );
                }
            }
            else
            {
                $receptors = $request->receptors;

                foreach($receptors as $receptor)
                {
                    DB::table('message_user')->insert(
                        array('message_id' => $message->id, 
                                'user_id' => $receptor)
                    );                
                }
            }
        } else {
            $response = "sendfail";
        }
        if($rollback){
            DB::rollBack();
        }
        
        DB::commit();     
        return $response;   
    }
}