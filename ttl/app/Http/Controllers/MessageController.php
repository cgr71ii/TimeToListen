<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Message;
use App\Message_user;
use App\User;


class MessageController extends Controller
{
    public function index(){
        return view('message.messages');

    }
    public function create(Request $request){
        if (session('user') === null){
            return redirect('/');
        }
        if(empty($request->receptor)){
            return redirect('/message')->with('createfailemptyfield', true);
        }
        if($request->has('message')){
            
            $count = User::where('email', $request->receiver)->count();
            if($count == 1){
                $user = User::where('email', $request->receiver)->first();
            
                $message_user = new Message_user([
                    'user_id' => $user->id
                ]);
                $message = new Message([
                    'user_id' => session('user')->id,
                    'title' => $request->title,
                    'text' => $request->text,
                    'read' => false,
                    'date' => date('Y-m-d h:i:s', time())
                ]);

                $message_user->save();
                $message->save();
             }

            return redirect('/message');
        }
    }

    public function destroy(Request $request){
        if (session('user') === null){
            return redirect('/');
        }
        if($request->has('message_id')){

            $message_user = Message::where('message_id',$request->message_id)
                                   ->where('user_id',session('user')->id)->first();

            if($message_user !== null){
                $message_user->delete();
            }
        }
        return redirect('/message');
    }

    public function received(Request $request){
        if (session('user') === null){
            return redirect('/');
        }
        /* 
            Obtener mensajes recibidos
            select * from messages where id IN (
                select message_id from message_user where user_id = 2);
        */
        
        /*$messages = Message::whereIn('id', function($query){
            $query->select('message_id')
            ->from('message_user')
            ->where('user_id', '=', session('user')->id)->get();
        })->toSql();*/

        $messages = DB::table('messages')
                    ->join('message_user', function ($join) {
                        $join->on('messages.id', '=', 'message_user.message_id')
                             ->where('message_user.user_id', '=', session('user')->id);
                    })->get();
        
        session(['messages' => $messages]);

        return view('message.messages-received');

    }
}
