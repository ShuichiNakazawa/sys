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
  <div class="card-body">
    <h3 class="header_center">国試過去問</h3>
  </div>

  @php
    $count = 0;
  @endphp
  @foreach ($fields as $field)
    <div class="card-body">
      <h4 class="header_center">{{ $field->field_name }}</h4>

      <div class="row justify-content-center">

        {{--
          ここに、foreachを使って、テーブルに登録されている科目名（分野ごと）のリストを表示させる
        --}}
        @foreach($subjects[$count] as $subject)
          <div class="btn_subject">
            <a href="{{  url('/' . $subject) }}">
              <button>{{ $subject }}</button>
            </a>
          </div>
        @endforeach

        @php
          $count++;
        @endphp
        {{--
          ここまで
          --}}
      </div>
    </div>
  @endforeach
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
