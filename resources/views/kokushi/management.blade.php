<!-- resources/views/rooms/management.blade.php -->
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
    <h3>国試 管理画面トップ</h3>
  </div>
  <div class="card-body">
    <div class="card-body">
      <h4>科目</h4>
      <a href="{{ url('/management/store_subject') }}">
        <button>登録</button>
      </a>

      <a href="{{  url('/management/subject_list') }}">
        <button>一覧表示</button>
      </a>
    </div>
    <div class="card-body">
      <h4>問題タイトル</h4>
      <a href="{{ url('/management/store_title') }}">
        <button>登録</button>
      </a>
      <a href="{{ url('/management/title_list/0') }}">
        <button>一覧表示</button>
      </a>
    </div>
    <div class="card-body">
      <h4>分野</h4>
      <button>登録</button>
      <button>一覧表示</button>
    </div>
  </div>

  <div class="card-body">
    <div class="card-body">
      <h4>問題文</h4>
      <a href="{{ url('/management/store_q_sentence') }}">
        <button>登録</button>
      </a>
      <a href="{{  url('/management/qsentence_list') }}">
        <button>一覧表示</button>
      </a>
    </div>
    <div class="card-body">
      <h4>解説文</h4>
      <button>登録</button>
      <button>一覧表示</button>
    </div>
  </div>

  <form action="{{ action('KokushiController@merge') }}" method="post">
    @csrf
      <input type="submit" name="migration_table" value="t_choices データ移行">
  </form>

  <form action="{{ action('KokushiController@merge') }}" method="post">
    @csrf
      <input type="submit" name="migration_table" value="t_answers データ移行">
  </form>

</div>
<br>

  <div class="listArea">
    <div class="innerList">

      <!-- TOP  -->


    </div>
  </div>
@endsection
