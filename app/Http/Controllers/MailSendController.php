<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail_Inquiry;


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

        // コントローラ使用
        Mail::to($to)->send(new SendMail_inquiry());
        

        /*
        $data = [];

        Mail::send('emails.test', $data, function($message){
            $message->to('contact@lara-assist.jp', 'Test')
                        ->subject('件名：テストメール');
        });
         */
    }
}
