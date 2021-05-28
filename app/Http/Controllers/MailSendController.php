<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailSendController extends Controller
{
    //
    public function send(){

        $data = [];

        Mail::send('emails.test', $data, function($message){
            $message->to('contact@lara-assist.jp', 'Test')
                        ->subject('件名：テストメール');
        });
    }
}
