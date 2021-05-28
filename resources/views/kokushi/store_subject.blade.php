<!-- resources/views/rooms/store_subject.blade.php -->
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
    <h3>国試過去問 管理</h3>
  </div>

    <h4>科目 登録</h4>

  <div class="card-body">
    <form action="{{ action('KokushiController@storeSubject') }}" method="POST">
      @csrf
      <p>
        <label for="subject_name">科目名：</label>
        <input typt="text" name="subject_name" id="subject_name" value="" size="30">
      </p>
      <p>
        <input type="submit" value="登録">
      </p>
    </form>

  </div>

</div>
<br>

  <div class="listArea">
    <div class="innerList">

      <!-- TOP  -->


    </div>
  </div>
@endsection
