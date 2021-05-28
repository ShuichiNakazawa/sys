<!-- resources/views/rooms/clt.blade.php -->
{{--
  datasources
  $titles  問題タイトルテーブル

--}}
@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')

<div class="card-body">
  <div class="card-body">
    <h3>臨床検査技師国試</h3>
  </div>
{{--
  {{ Breadcrumbs::render('admin.user.edit', $user) }}
--}}
  <div class="card-body">

    <button class="btn-dark">ランダム１０問に挑戦（調整中）</button>

    <button class="btn-dark">問題文の朗読を聞いてみる（調整中）</button>
    <form action="{{ url('/clt/history') }}">
      @csrf
      @if ($logind == 1)
        <input type="submit" class="btn-dark" value="挑戦履歴を見る">
        <input type="hidden" name="subject_id" value="4">
      @else
        <input type="submit" class="btn-dark" value="挑戦履歴を見る（ログインユーザ専用）" disabled="disabled">
      @endif
    </form>

    <div class="card-body">
      <h4>試験形式に挑戦</h4>
      <div class="card-body">
	<form action="{{ action('KokushiController@startPractice') }}" method="POST">
	  @csrf
	  <input type="radio" name="testType" value="1" checked="checked">一問一答&nbsp;&nbsp;&nbsp&nbsp;<input type="radio" name="testType" value="2">試験形式
	  <div class="card-body">
	    @foreach ($titles as $title)
	      <input type="submit" name="questions_title" value="{{ $title->questions_title }}">
	      <br>
	    @endforeach
	    <input type="hidden" name="subject_id" value="4">
      <input type="hidden" name="selected_answer" value="99">
	  </div>
	</form>
      </div>
    </div>
  </div>

</div>
<br>

  <div class="listArea">
    <div class="innerList">

      <!-- TOP  -->


    </div>
  </div>
@endsection
