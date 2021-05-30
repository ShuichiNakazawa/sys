<!-- resources/views/rooms/index.blade.php -->
@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')

<div class="card-body">
  <h4>予約システム 管理メニュー</h4>

  <a href="{{ url('/management/regist_holiday') }}">
    祝日登録
  </a>
  <br>

  <form action="{{ action('ReservationsController@showAcceptable') }}">
    @csrf

    <input type="submit" value="予約可能数 設定">
    <input type="hidden" name="transition_source_page" value="0">
  </form>

  <br>

  生徒登録
  <br>

  予約修正
  <br>
</div>


@endsection
