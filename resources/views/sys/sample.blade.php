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
          <h2 class="txt_center">サンプル</h2>
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
