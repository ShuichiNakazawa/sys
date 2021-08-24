<!-- resources/views/rooms/index.blade.php -->
@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@if(session('error_message'))
<div class="alert alert-danger">
  {{ session('error_message') }}
</div>
@endif

@include('common.errors')
<div class="card-body">
  <div class="main_field">
    <h3 style="text-align: center;">お問合せ</h3>
    <br>

    <p>　Webシステムの制作・お見積りやご相談、リモートスクールへのご質問などお気軽にお問合せください。
      お問合せ内容を確認のうえ、３営業日以内にこちらからご連絡をさせていただきます。<br>
      　メールによるご連絡をご希望の場合には<a href="mailto:shuichi-nakazawa@lara-assist.jp"><span style="color:blue;">shuichi-nakazawa@lara-assist.jp</span></a>宛てに送信をお願いいたします。
    </p>
  
      <form action="{{ action('MailSendController@send') }}" method="POST" style="margin:0 atuo;">
        @csrf
        <div class="contuctForm">
          <table style="margin:0 auto;">
            <tr>
              <th>
                会社名・屋号名
              </th>
              <td>
                <input type = "text" id = "companyName" name = "companyName">
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <th>
                お名前
                <br>【必須】
              </th>
              <td>
                <input type = "text" id="customerName" name="customerName">
              </td>
            </tr>
            <tr>
              <td>
                &nbsp;
              </td>
            </tr>
            <tr>
              <th>
                お名前ふりがな<br>【必須】
              </th>
              <td>
                <input type = "text" id = "furigana_customerName" name="furigana_customerName">
              </td>
            </tr>

            <tr>
              <td>
                &nbsp;
              </td>
            </tr>

            <tr>
              <th>
                お電話番号
                <br>【必須】
              </th>
              <td>
                <input type="text" id="tel" name="tel">
              </td>
            </tr>

            <tr>
              <td>
                &nbsp;
              </td>
            </tr>

            <tr>
              <th>
                メールアドレス<br>【必須】
              </th>
              <td>
                <input type = "text" id="mailAddress" name="mailAddress" placeholder = "example@example.com">
              </td>
            </tr>

            <tr>
              <td>
                &nbsp;
              </td>
            </tr>

            <tr>
              <th>
                WebサイトURL
              </th>
              <td>
                <input type = "text" id = "sightUrl" name="sightUrl" placeholder="https://appli-support.jp">
              </td>
            </tr>

            <tr>
              <td>
                &nbsp;
              </td>
            </tr>

            <tr>
              <th>
                当サイトを知った
                <br>きっかけ【必須】
              </th>
              <td>
                <select id = "trigger" name="trigger">
                  <option value = "0">インターネット検索</option>
                  <option value = "1">ご紹介</option>
                  <option value = "2">チラシ・広告</option>
                  <option value = "3">クラウドソーシングサイト</option>
                  <option value = "4">SNS</option>
                  <option value = "5">その他</option>
                </select>
              </td>
            </tr>

            <tr>
              <td>
                &nbsp;
              </td>
            </tr>

            <tr>
              <th>
                お問合せ種類<br>【必須】
              </th>
              <td>
                <select id="inquiryType" name="inquiryType">
                  <option value = "0">制作のご依頼</option>
                  <option value = "1">制作のお見積り</option>
                  <option value = "2">Webスクールへのご質問</option>
                  <option value = "3">その他</option>
                </select>
              </td>
            </tr>
            
            <tr>
              <td>
                &nbsp;
              </td>
            </tr>

            <tr>
              <th>
                お問合せ内容<br>【必須】
              </th>
              <td>
                <textarea id="inquiryContent" name="inquiryContent"></textarea>
                
              </td>
            </tr>

            <tr>
              <td>
                &nbsp;
              </td>
            </tr>

            <tr>
              <th>
                <button id = "confirmInquiry" name="confirmInquiry">送信</button>
              </th>
              <td>
                &nbsp;
              </td>
            </tr>
          </div>
        </table>
      </form>
  </div>
</div>

@endsection

@section('footer')
<div class="container copyright">
    ©2020 lara-assist.jp
</div>
@endsection