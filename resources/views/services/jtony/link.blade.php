@extends('layouts.app_ipquestion')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')

<br><br><br>
<div class="width_adjust" style="margin: 0 auto;">
  <a href="https://lara-assist.jp">
    <img src="{{ asset('image/lara_assist.jpg') }}" width="40px" height="40px" alt="ララアシスト ロゴ">
    ララアシスト
  </a>
</div>
@endsection('content')
