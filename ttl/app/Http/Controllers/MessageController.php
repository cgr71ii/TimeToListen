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
    public function send(){
        $users = array();
        if (session('user') === null){
            return redirect('/');
        }
        $id = session('user')->id;
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

        $friends = array();
        foreach ($users as $aux){
            $friend_u = User::find($aux->id);
            array_push($friends, $friend_u);
        }
        
        session(['friends' => $friends]);
        
        return view('message.messages-send');

    }
    public function create(Request $request){

        if (session('user') === null){
            return redirect('/');
        }
        
        $data = request()->all();
        $title = $data['title'];
        $body = $data['body'];
        $users = $data['receptors'];

        $message = new Message([
            'user_id' => session('user')->id,
            'title' => $title,
            'text' => $body,
            'read' => false,
            'date' => date('Y-m-d h:i:s', time())
        ]);
        echo $message->id;
        $message->save();

      /*  foreach($users as $receptor){
            if($receptor === 'all'){

            } else {

            }
        }*/
    }

    public function delete(Request $request){
        if (session('user') === null){
            return redirect('/');
        }

        if($request->has('message_id')){
            /*$message_user = Message_user::where('user_id',session('user')->id)
                                    ->where('message_id',$request->message_id)->first();*/
            $message_user = DB::table('message_user')->where('user_id',session('user')->id)
                                      ->where('message_id',$request->message_id)->first();
            
            if($message_user !== null){
                DB::table('message_user')->where('user_id',session('user')->id)
                ->where('message_id',$request->message_id)->delete();
            }
        }
        return back();
    }

    public function list(Request $request){
        if (session('user') === null){
            return redirect('/');
        }
        /* 
            Obtener mensajes recibidos
            select * from messages where id IN (
                select message_id from message_user where user_id = 2);
        */

        $messages = DB::table('messages')
                    ->join('message_user', function ($join) {
                        $join->on('messages.id', '=', 'message_user.message_id')
                             ->where('message_user.user_id', '=', session('user')->id);
                    })->select('messages.*')->get();

        foreach($messages as $message){
            $user = User::where('id',$message->user_id)->first();
            $name = $user->name;
            $lastname = $user->lastname;
            $email = $user->email;

            $message->user_id = $name . ' ' . $lastname . ' (' . $email . ')';
        }
        
        session(['messages' => $messages]);

        return view('message.messages-received');
    }
}
