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
          <h2 class="txt_center">システム</h2>
          <br><br>

          <form action="{{ url('systems') }}" method="POST">
            @csrf
            <button>国試過去問</button>
          </form>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

          <input type="submit" onClick="javascript:window.open('kokushi/', 'kokushi', 'fullscreen=yes')" value="国試バー非表示">
          <br><br>

          問題集管理システム
          <br><br>

          <a href="stripe_sample">Stripe クレジットカード決済サンプルページ</a>
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
