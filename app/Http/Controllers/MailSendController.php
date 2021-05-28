<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail_Inquiry;


class MailSendController extends Controller
{
    //
    public function send(Request $request){

        // 送信者 取得
        $sender =   $request->customerName;
        dd($sender);

        $to =   [
            [
                'email' =>  'contact@lara-assist.jp',
                'name'  =>  $sender,
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
