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

	<div style="margin:0 auto; width: 60%;">
	  <h2 style="text-align:center;">1-2 webエディタ</h2>
		<div class="text_outer">
      <p>
        p5.jsのwebエディタ<br><br>

        Google Chromeなどのwebブラウザから、<a href="https://editor.p5js.org/">https://editor.p5js.org/</a> にアクセスします。<br>
        下の画像のように表示されていればOKです<br><br>
        
        <img src="{{ asset('/img/text/p5js/1-2_1.jpg') }}" width="70%" heigh="70%">
        <br><br><br>


        この画面について、エリアごとに解説します。
        <br><br>


        <img src="{{ asset('/img/text/p5js/1-2_2.jpg') }}" width="70%" heigh="70%">
        <br><br>

        実行ボタン・・・押すとコードが実行される<br><br>
        
        停止ボタン・・・押すとコードが停止される<br><br>
        
        
        コードを書くエリア・・・プログラム（コード、ソース）を書くエリア<br><br>
        
        コンソールエリア・・・コンピュータからのメッセージが表示されるエリア<br><br>
        
        プレビューエリア・・・プログラムの実行結果が表示されるエリア<br><br>
        <br>

        実際にプログラムを経験してみましょう。<br>
        下のコードをコピーして、コードを書くエリアにペーストして、実行ボタンを押してみてください。<br>

        <div style="border: solid 2px #aaa; border-radius: 10px; padding-left: 15px; width: 400px;">
          <pre>
            <code>
let size = 20;

function setup() {
  createCanvas(400, 400);
  background(220);
  fill(0);
}
              
function draw() {
                
  ellipse(mouseX, mouseY, size, size);
              
  if(mouseIsPressed){
    noStroke();
    fill(0);
                  
  } else {
    stroke(255);
    fill(255);
  }
}
            </code>
          </pre>
        </div>
        <br><br>
      </p>

      <a href="/text/p5_js/1/1">
        <button>
            前のチャプターへ
        </button>
      </a>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      <a href="/text/p5_js/1/3">
          <button disabled>
              次のチャプターへ
          </button>
      </a>


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
