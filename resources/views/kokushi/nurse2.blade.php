<!-- resources/views/rooms/index2.blade.php -->
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
    <h3>看護師国試</h3>
  </div>
  <div class="card-body">
    <div class="card-body">
      <button>ランダム１０問に挑戦（調整中）</button>
    </div>

    <div class="card-body">
      <a href="{{ url('/nurse/audio/1')  }}">
        <button>問題文の朗読を聞いてみる</button>
      </a>
    </div>

    <div class="card-body">
      <h4>過去問に挑戦</h4>
	{{-- アクションの引数：科目ID　　　タイトルIDもしくはタイトル名を渡す必要がある --}}
      <form action="{{ action('KokushiController@startPractice') }}" method="post">
	@csrf
	  <input type="radio" name="testType" value="1" checked="checked">一問一答&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="testType" value="2">試験形式
	  <div class="card-body">
      
	    @foreach ($titles as $title)
{{--
	      <a href="{{ url('/nurse/practice/1/' . $title->title_id . '/1') }}">
--}}
	        <input type="submit" name="questions_title" value="{{ $title->questions_title }}">

	        <br>
	      </a>
	  @endforeach
	  <input type="hidden" name="subject_id" value="1">
    <input type="hidden" name="selected_answer" value="99">
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
