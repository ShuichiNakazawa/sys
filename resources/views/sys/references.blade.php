<!-- resources/views/sys/index.blade.php -->
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
      <h2 style="text-align:center;">参考サイト</h2>

	    <div class="card-header">
        学習支援
      </div>
      <div class="card-body bg_light">
        <a href="https://www.crammedia.com/">CramMedia</a>
        <br><br>

        <a href="https://ping-t.com/">Ping-t</a>
        <br><br><br>
      </div>
      <br>

      <div class="card-header">
        行政
      </div>
      <div class="card-body bg_light">
        <a href="https://www.mext.go.jp/a_menu/shotou/zyouhou/detail/1403162.htm">小学校プログラミング教育の手引</a>
        <br><br>

        <a href="https://www.meti.go.jp/policy/it_policy/jinzai/sugomori/index.html">巣ごもりDXステップ講座情報ナビ</a>
        <br><br>

        <a href="https://www.dnc.ac.jp/kyotsu/shiken_jouhou/r7ikou.html">独立行政法人　大学入試センター　令和７年度以降の試験</a>
        <br><br>

        <a href="https://www.meti.go.jp/policy/digital_transformation/index.html">経済産業省のデジタル・トランスフォーメーション</a>
        <br><br>

        <a href="https://www.ipa.go.jp/">IPA 独立行政法人 情報処理推進機構</a>
        <br><br>
      </div>

      <div class="card-header">
        未分類
      </div>
      <div class="card-body bg_light">
        <a href="https://nadesi.com/top/">日本語プログラミング言語「なでしこ」</a>
        <br><br>

        <a href="https://ja.softether.org/">SoftEther VPN プロジェクト</a>
        <br><br><br>
      </div>
    </div>

    @endsection

    @section('footer')
      <div class="container copyright">
        &copy;2020 - 2021 lara-assist.jp
      </div>
    @endsection
    </body>
</html>
