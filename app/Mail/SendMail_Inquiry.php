<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail_Inquiry extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content){
        $this->content =   $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //textをview、viewをtextに変える事で、html・テキストメールの設定を変えられる
        return $this->text('emails.text_inquiry')                           // 使用するviewsテンプレート
                        ->from('no-reply@lara-assist.jp', 'ララアシスト')    // 送信者情報
                        ->subject('お問合せ')                                // 件名
                        ->with(['content'   =>  $this->content]);           // メール本文
    }
}
