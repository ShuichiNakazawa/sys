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

        <div style="margin:0 auto; width: 70%">
          <h2 style="text-align:center;">システム</h2>
          <br><br>

          <a href="kokushi">国試 過去問</a>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

          <input type="submit" onClick="javascript:window.open('kokushi/', 'kokushi', 'fullscreen=yes')" value="国試バー非表示">
          <br><br>

          問題集管理システム
          <br><br>

          <a href="sample">Stripe クレジットカード決済サンプルページ</a>
          <br><br>

          <a href="work_manager">作業予定表</a>
          <br><br>

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
