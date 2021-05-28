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
        //dd($sender);

        $to =   [
            [
                'email' =>  'contact@lara-assist.jp',
                'name'  =>  $sender,
            ]
        ];

        $content    =   
            '会社名・屋号：'    . $request->companyName . "\n"
            . '顧客名'         . $request->customerName . "\n"
            . 'お名前ふりがな'  . $request->furigana_customerName . "\n"
            . '電話番号'       . $request->tel . "\n"
            . 'メールアドレス'   . $request->mailAddress . "\n"
            . 'webサイトURL'    . $request->sightUrl . "\n"
            . 'きっかけ'        . $request->trigger . "\n"
            . '問合せ種類'      . $request->inquiryType . "\n"
            . '問合せ内容'      . $request->inquiryContent . "\n";

        // コントローラ使用
        Mail::to($to)->send(new SendMail_inquiry($content));

    }
}
