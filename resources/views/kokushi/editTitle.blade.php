<!-- resources/views/rooms/editTitle.blade.php -->
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
    <h3>問題タイトル名 編集</h3>
  </div>
  <div class="card-body">
    <div class="card-body">
      <h4>問題タイトル一覧</h4>
      <form action="{{ action('KokushiManagementController@updateTitle') }}" method="POST">
    	@csrf
        <table class="table table-striped task-table">
          <thead>
            <th></th>
          </thead>

          <tbody>
            <tr>
              <th>問題タイトルID</th>
              <th>問題タイトル名</th>
            </tr>
            <tr>
              <td class="table-text">
                <div><input type="text" name="title_id" value="{{ $title->title_id }}" size="4"></div>
              </td>
              <td class="table-text">
                <div><input type="text" name="questions_title" value="{{ $title->questions_title }}" size="30"></div>
              </td>
            </tr>
          </tbody>
        </table>

        <input type="hidden" name="id" value="{{ $title->id }}">
        <input type="hidden" name="subject_id" value="{{ $subject->id }}">
        <input type="submit" value="修正">
      </form>
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
