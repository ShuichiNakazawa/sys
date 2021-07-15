<!-- resources/views/rooms/index.blade.php -->
@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')

<div class="width_adjustment_900">
  <div class="card-body">
    <h3 class="header_center">国試過去問</h3>
  </div>

  @php
    $count = 0;
  @endphp
  @foreach ($subject_groups as $subject_group)
    <div class="subject_outer">
      <div class="card-header">
        <h4 class="header_center ">{{ $subject_group->subject_group_name }}</h4>
      </div>

      {{--
      <div class="card-body row justify-content-center">
      --}}
      <div class="card-body justify-content-center">
        {{--
          ここに、foreachを使って、テーブルに登録されている科目名（分野ごと）のリストを表示させる
        --}}

        @foreach($subjects[$count] as $id => $subject)
          <div class="btn_subject">
            {{--
            <a href="{{  url('/kokushi/' . $id) }}">
            --}}
              <form action="{{ url('/kokushi/' . $id) }}">
                @csrf
                <button>{{ $subject }}</button>
                <input type="hidden" name="subject_id" value="{{ $id }}">
                <input type="hidden" name="subject_id" value="{{ $id }}">
              </form>
            {{--
            </a>
            --}}
          </div>
          <br><br>
        @endforeach

        @php
          $count++;
        @endphp
        {{--
          ここまで
          --}}
      </div>
    </div>
    <br>
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
