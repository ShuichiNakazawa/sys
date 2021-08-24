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
	  <h2 style="text-align:center;">1-1 はじめに</h2>
		<div class="text_outer">
			{{--
			<div><br></div>
			--}}
            
            <p>
                みなさん、こんにちは。<br>
                このテキストではp5.jsを使って、プログラミングの基本を習得することを目的としています。<br><br>

                プログラミングを学習するためには、環境を整えることが必要です。<br>
                p5.jsでは、『<a href="https://editor.p5js.org"><span style="color: blue;">https://editor.p5js.org</span></a>』に登録をすることで、簡単にプログラミング環境を整えることができるので、初心者でも習得を始めやすいというメリットがあります。<br><br>

                また、p5.js自体がJavaScriptによって構成されているので、JavaScriptを学習するのにも非常に適しています。<br><br>

                始めは図形の描画を少しずつ覚えながら、簡単なゲームが作成できるようになる事をゴールにしています。<br><br>


                では、さっそくp5.jsに触れてみましょう！<br><br>
                <a href="/text/p5_js/1/2">
                    <button>
                        次のチャプターへ
                    </button>
                </a>
            </p>

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
