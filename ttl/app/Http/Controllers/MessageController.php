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

    public function show(Request $request)
    {
        if (session('user') === null)
        {
            return redirect('/');
        }

        $id = session('user')->id;

        $friends = User::find(session('user')->id)->following()->get();

        $messages_sent_count = User::find($id)->message()->count();

        $messages_recv_count = User::find($id)->message_user()->where('message_user.user_id', $id)->count();

        return view('message.messages')->with('friends', $friends)->with('messages_sent_count', $messages_sent_count)->with('messages_recv_count', $messages_recv_count);
    }

    public function listSentMessages(Request $request)
    {
        $id = session('user')->id;

        $messages_sent = User::find($id)->message();

        if ($request->has('order-form'))
        {
            session([   'message_sent_field' => null, 
                        'message_sent_direction' => null]);
        }

        if (session('message_sent_field') !== null)
        {
            $messages_sent = $messages_sent->orderBy(session('message_sent_field'), session('message_sent_direction'));
        }
        else if ($request->has('field') && $request->has('direction'))
        {
            session([   'message_sent_field' => $request->field,
                        'message_sent_direction' => $request->direction]);

            $messages_sent = $messages_sent->orderBy($request->field, $request->direction);
        }

        $messages_sent = $messages_sent->simplePaginate(5);

        if ($request->ajax())
        {
            return view('message.messages-sent-pag', ['messages_sent' => $messages_sent])->render();
        }

        return view('message.messages-sent', ['messages_sent' => $messages_sent]);
    }

    public function listReceivedMessages(Request $request)
    {
        $id = session('user')->id;

        $messages_received = User::find($id)->message_user()->where('message_user.user_id', $id);

        if ($request->has('order-form'))
        {
            session([   'message_received_field' => null, 
                        'message_received_direction' => null]);
        }

        if (session('message_received_field') !== null)
        {
            $messages_received = $messages_received->orderBy(session('message_received_field'), session('message_received_direction'));
        }
        else if ($request->has('field') && $request->has('direction'))
        {
            session([   'message_received_field' => $request->field,
                        'message_received_direction' => $request->direction]);

            $messages_received = $messages_received->orderBy($request->field, $request->direction);
        }

        $messages_received = $messages_received->simplePaginate(5);

        if ($request->ajax())
        {
            return view('message.messages-received-pag', ['messages_received' => $messages_received])->render();
        }

        return view('message.messages-received', ['messages_received' => $messages_received]);
    }

    public function send(){
        $users = array();
        if (session('user') === null){
            return redirect('/');
        }
        $id = session('user')->id;
        $user1 = User::find($id)->following()->get();
        //$user2 = User::find($id)->userFriends()->get();
        $user2 = [];
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

    public function listMessages(Request $request)
    {
        $messages = Message::where('id', '>=', '0');

        if ($request->has('order-form'))
        {
            session([   'messages_field' => null, 
                        'messages_direction' => null]);
        }

        if (session('messages_field') !== null)
        {
            $messages = $messages->orderBy(session('messages_field'), session('messages_direction'));
        }
        else if ($request->has('field') && $request->has('direction'))
        {
            session([   'messages_field' => $request->field,
                        'messages_direction' => $request->direction]);

            $messages = $messages->orderBy($request->field, $request->direction);
        }

        $messages = $messages->simplePaginate(5);

        if ($request->ajax())
        {
            return view('lists.pag.messages', ['messages' => $messages])->render();
        }

        return view('lists.list-messages', ['messages' => $messages]);
    }

    public function create(Request $request){

        if (session('user') === null){
            return redirect('/');
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
        }
        
        return back();
    }

    public function delete(Request $request){
        if (session('user') === null)
        {
            return redirect('/');
        }

        /*
        if($request->has('message_id')){
            $message_user = DB::table('message_user')->where('user_id',session('user')->id)
                                      ->where('message_id',$request->message_id)->first();
            
            if($message_user !== null){
                DB::table('message_user')->where('user_id',session('user')->id)
                ->where('message_id',$request->message_id)->delete();
            }
        }
        */

        if ($request->has('message_id'))
        {
            $message = Message::find($request->message_id);

            $message->delete();
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
