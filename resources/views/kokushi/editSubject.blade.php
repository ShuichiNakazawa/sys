<!-- resources/views/rooms/editSubject.blade.php -->
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
    <h3>科目 編集</h3>
  </div>
  <div class="card-body">
    <div class="card-body">
      <h4>科目</h4>
      <form action="{{ action('KokushiManagementController@updateSubject') }}" method="POST">
      @csrf
        <table class="table table-striped task-table">
          <thead>
            <th></th>
          </thead>

          <tbody>
            <tr>
              <th>科目ID</th>
              <th>科目名</th>
            </tr>
            <tr>
              <td class="table-text">
                <div><input type="text" name="subject_id" value="{{ $subject->id }}" size="1"></div>
              </td>

              <td class="table-text">
                <div><input type="text" name="subject_name" value="{{ $subject->subject_name }}" size="30"></div>
              </td>
            </tr>
          </tbody>
        </table>
        <input type="hidden" name="old_subject_id" value="{{ $subject->id }}">
        <input type="submit" value="修正">
{{--
        <input type="hidden" name="subject_name" value="{{ $subject->subject_name }}">
--}}
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
