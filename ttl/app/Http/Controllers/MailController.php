<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Session;

class MailController extends Controller
{
    public function sendContactEmail(Request $request){
        if($request['submitted'] == "Cancel")
        {
            return redirect('/');
        }

        if ($request->firstname!=NULL && $request->lastname!=NULL && 
            $request->email!=NULL && $request->subject!=NULL)
        {
            Mail::send('emails.sendEmail', $request->all(), function($message){
                $message->subject('Contact message');
                $message->to('timetolistentest@gmail.com');
            });
            return redirect('/contact')->with('sent', true);
        }


        return redirect('/contact')->with('fail', true);
    }
}
