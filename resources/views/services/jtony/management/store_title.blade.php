<!-- resources/views/rooms/store_title.blade.php -->
@extends('layouts.app_ipquestion')

@section('content')

<br><br>

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

  <h4>問題タイトル 登録</h4>

  <div class="card-body">
    <form action="{{ action('IpqManagementController@storeTitle') }}" method="POST">
      @csrf

      科目名：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <select name="subject_id">
        <option value="0"> </option>
        @foreach ($subjects as $subject)
          <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
        @endforeach
      </select>
      <br><br>

      <p>
        <label for="title_id">タイトルID：</label>
        <input typt="text" name="title_id" id="title_id" value="" size="30">
      </p>

      <p>
        <label for="title_name">タイトル名：</label>
        <input typt="text" name="title_name" id="title_name" value="" size="30">
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
