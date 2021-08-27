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
    <h3 class="header_center">医療系国試過去問</h3>
  </div>

  @php
    $count = 0;
  @endphp
  @foreach ($subject_groups as $subject_group)
    @if((int)$subject_group->id == 1)
      <div class="subject_outer">
        {{--
        <div class="card-header">
          <h4 class="header_center ">{{ $subject_group->subject_group_name }}</h4>
        </div>
        --}}

        {{--
        <div class="card-body row justify-content-center">
        --}}
        <div class="card-body justify-content-center row" style="background: lightyellow;">
          {{--
            ここに、foreachを使って、テーブルに登録されている科目名（分野ごと）のリストを表示させる
          --}}

          @foreach($subjects[$count] as $id => $subject)
            
            @if($id != 9)
              {{--
              <div class="btn_subject" style="width: 200px; height: 200px; margin: 20px; border: solid 2px #999; border-radius: 10px; background: white; text-align: center;">
                --}}
                <div class="btn_subject" style="width: 200px; height: 230px; margin: 20px; text-align: center; font-size: 20px;">

                {{--
                <a href="{{  url('/kokushi/' . $id) }}">
                --}}
                  <form action="{{ url('/kokushi/' . $id) }}">
                    @csrf

                    <button style="background: white; border-radius: 15px; width: 180px; height: 200px;">

                    <img src="{{ "images/medical/" . $subject_short_names[($id - 1)] . ".png" }}" alt="job_image" width="auto" height="150px">
                    <br>
                    {{ $subject }}
                    {{--
                    <button>{{ $subject }}</button>
                    --}}

                    <input type="hidden" name="subject_id" value="{{ $id }}">
                    <input type="hidden" name="subject_id" value="{{ $id }}">

                  </button>

                  </form>
                {{--
                </a>
                --}}
              </div>
              <br><br>
            @endif
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
    @endif
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
