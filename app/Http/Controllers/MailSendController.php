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

        // きっかけ エンコード
        switch($request->trigger){
            case 0 :
                $trigger    =   "インターネット検索";
                break;
            case 1 :
                $trigger    =   "ご紹介";
                break;
            case 2 :
                $trrigger   =   "チラシ・広告";
                break;
            case 3 :
                $trrigger   =   "クラウドソーシング";
                break;
            case 4 :
                $trrigger   =   "SNS";
                break;
            case 5 :
                $trrigger   =   "その他";
                break;
        }

        // 問い合わせ種類 エンコード
        switch($request->inquiryType){
            case 0 :
                $inquiryType    =   "制作のご依頼";
                break;
            case 1 :
                $inquiryType    =   "制作の見積り";
                break;
            case 2 :
                $inquiryType    =   "Webスクールへの質問";
                break;
            case 3 :
                $inquiryType    =   "その他";
                break;
        }

        $content    =   
            '会社名・屋号：　'    . $request->companyName . "\n"
            . '顧客名：　'         . $request->customerName . "\n"
            . 'お名前ふりがな：　'  . $request->furigana_customerName . "\n"
            . '電話番号：　'       . $request->tel . "\n"
            . 'メールアドレス：　'   . $request->mailAddress . "\n"
            . 'webサイトURL：　'    . $request->sightUrl . "\n"
            . 'きっかけ：　'        . $trigger . "\n"
            . '問合せ種類：　'      . $inquiryType . "\n"
            . '問合せ内容：　'      . $request->inquiryContent . "\n";

        // コントローラ使用
        Mail::to($to)->send(new SendMail_inquiry($content));

    }
}
