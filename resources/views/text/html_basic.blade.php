<!-- resources/views/sys/memo.blade.php -->
@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif
	
@include('common.errors')
	  <br>

	<div style="margin:0 auto; width: 80%">
	  <h2 class="txt_center">HTML基礎</h2>
		<div class="text_outer">
      <h3 class="txt_center">概要</h3>
      <p>HTML基礎では、<br>
        <ul>
          <li>
            HTMLの役割
          </li>
          <li>
            HTMLタグの記述方法
          </li>
        </ul>
        について学びます。</p>
        <h3 class="txt_center">
          HTMLの役割
        </h3>
        <p>
          みなさんは普段ホームページ（Webサイト）を利用したことがあると思います。ホームページは、文章、画像、音声、入力フォームやボタンなどで構成されています。<br>
          これらの<strong>部品を配置する指示</strong>がHTMLです。まずはこの１点を覚えておきましょう。
        </p>
        <br><br>

        <h3 class="txt_center">HTMLの作り方</h3>
        <p>
          早速ですが、HTMLの作成に取り掛かります。ここではWindows付属アプリの【メモ帳】を使って説明します。テキストを編集するソフトであれば、他のソフトを使っても問題ありません。
        </p>
        <br>

        <h4>
          HTMLファイルの作成
        </h4>

        <p>
          【操作】[Windowsスタートボタン]　→　[Windows アクセサリ]　→　[メモ帳]
          <br><br>

          メモ帳が開いたら、最初にファイルを保存しておきます。
          <br>

          【操作】[ファイル(F)]　→　[名前を付けて保存(A)]
          <br><br>

          ウィンドウが開きます。ファイル名には「index.html」を入力し、その下の「ファイルの種類」を「すべてのファイル(*.*)」に変更して、「保存」ボタンを押します。<br>
          ※ファイルを保存する場所は、ご自身がわかりやすいフォルダとしてください。<br>
          <br>
          これでHTMLファイルが作成できました。
        </p>
        <br><br>

        <h3 class="txt_center">HTMLの記述</h3>
        メモ帳は新規作成したばかりで、まっさらな状態です。さっそくここへ、下のように文字を打ち込んでいきましょう。<br>
        ※半角英数字で入力します。
        <br><br>

        <pre>
          <code>
            &lt;html&gt;
            &lt;body&gt;
              はじめてのhtml
            &lt;/body&gt;
            &lt;/html&gt;
          </code>
        </pre>

        打ち込みが終わったら、ファイルを保存します。
        <br><br>

        【操作】[ファイル]　→　[上書き保存]
        <br>

        ※【ショートカットキー】[Ctrl]キーを押しながら[s]キーを押すことでも、[ファイルの上書き保存]をすることが出来ます。
        <br><br>

        <p>
          これで初歩的なHTMLファイルが完成しました。さっそくWebブラウザで見てみましょう。
          <br><br>

          【操作】[作成したファイルをフォルダ上で右クリック]　→　[プログラムから開く]　→　[Google Chrome]
          <br><br>

          Webブラウザ(Google Chrome)上で、「はじめてのhtml」という文字が表示されているのを確認できたと思います。
          <br><br>





		</div>
	</div>
	<br><br><br>
	@endsection

  @section('footer')
  	<div class="container copyright">
      &copy;2020 - 2021 lara-assist.jp
    </div>
  @endsection
	</body>
</html>
