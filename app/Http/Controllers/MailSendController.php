<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailSendController extends Controller
{
    //
    public function send(){

        $to =   [
            [
                'email' =>  'contact@lara-assist.jp',
                'name'  =>  'Test',
            ]
        ];

        Mail::to($to)->send(new SendTestMail());

        /*
        $data = [];

        Mail::send('emails.test', $data, function($message){
            $message->to('contact@lara-assist.jp', 'Test')
                        ->subject('件名：テストメール');
        });
         */
    }
}
