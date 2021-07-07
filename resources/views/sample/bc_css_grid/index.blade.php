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
          <h2 class="txt_center">【書籍引用】CSSグリッドレイアウト</h2>
          <br><br>

          <a href="{{ route('sample.bc_css_grid.magazine_style') }}">雑誌風レイアウト</a>
          <br><br><br>

          <a href="{{ route('sample.bc_css_grid.flyer_style') }}">フライヤー風レイアウト</a>
          <br><br><br>

          <a href="{{ route('sample.bc_css_grid.picture_contents') }}">画像をメインにしたレイアウト（左右対称）</a>
          <br><br><br>

          <a href="{{ route('sample.bc_css_grid.picture_contents_asymmetry') }}">画像をメインにしたレイアウト（左右非対称）</a>
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
