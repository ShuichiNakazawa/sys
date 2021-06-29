<!-- resources/views/sys/systems.blade.php -->
@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif
  
@include('common.errors')
        <br>

        <div style="margin:0 auto; width: 50%">
          <h2 class="txt_center">【書籍引用】Laravel入門</h2>
          <br><br>

          <a href="oneweek">１週間で基礎から学ぶLaravel入門（minatomi）</a>
          <br><br><br>

          <a href="quick_learning">速習 Laravel6 速習シリーズ（山田祥寛）</a>
          <br><br><br>

          <a href="move_and_learn">動かして学ぶ！Laravel開発入門（山崎大助）</a>
          <br><br><br>

          <a href="ec_sample">LaravelでStripeを使った決済処理付き簡易ファッションECサイトを作ろう！(Techpitブックス)</a>
          <br><br><br>

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
