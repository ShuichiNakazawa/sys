<!-- resources/views/rooms/store_subject.blade.php -->
@extends('layouts.app_ipquestion')

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

    <h4>科目グループ 登録</h4>

  <div class="card-body">
    <form action="{{ action('IpqManagementController@storeSubjectGroup') }}" method="POST">
      @csrf
      <p>
        <label for="subject_group_name">科目グループ名：</label>
        <input typt="text" name="subject_group_name" id="subject_group_name" value="" size="30">
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
