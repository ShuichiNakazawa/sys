@extends('layouts.app_ipquestion')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')

<br><br><br>
<div class="width_adjust" style="margin: 0 auto;">
  <br><br>
    <div class="container">     
      <div class = "title_outer" style="display: block;">
        <img src = "{{ asset('icon/computer_work.png') }}"><span style="font-size:32px;font-weight:bold;color:#30b279;">問題に挑戦</span>
      </div>
      <div style="display: block; width: 100%;">
      </div>

      <div class="questions_outer">
        <div>
          {{-- 科目  タイトル --}}
          <h4>{{ $subject_name }}</h4>

          {{ $question_title }}
        </div>

        <div style="width: 100%">
        </div>

          {{-- 正誤履歴 --}}

          {{-- 問題番号 --}}
        <p>問{{ $question_sentence->question_number }}</p>
        <div style="width: 100%">
        </div>

          {{-- 問題文 --}}
          <p>{{ $question_sentence->question_sentence }}</p>
          <br><br>

          {{-- 図・表 --}}
          @if($question_sentence->flag_graph_exists == 1)
            <div style="width: 100%">
            </div>

            図が入る
            <br>
            {{ $question_sentence->image_filename }}

          @endif
          <div style="width: 100%">
          </div>

          <br>          

          {{-- 選択肢文 --}}
          @foreach($choice_sentences as $choice_sentence)
            <div class="choice_centence_area" style="display: flex; align-items: center;">
              {{-- 上下中央に配置されるスタイルを適用 --}}
              <div style="align-items: center;">
                <button>
                  {{ $array_choices[$choice_sentence->choice_id] }}
                </button>
              </div>
              <div style="margin-left: 10px;">
                {{ $choice_sentence->choice_sentence }}  
              </div>
            </div>
            <div style="width: 100%">
            </div>
            <br><br>
          @endforeach
        </div>
        <br>
        <div>
          @if($question_number != 1)
            <button>
              前の問題へ
            </button>
          @else
            
          @endif

          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

          @if($question_number != $last_question_number)
            <a href="{{ url('/test/' . $subject_id . '/' . $title_id . '/' . ($question_number + 1)) }}">
              <button>
                次の問題へ
              </button>
            </a>
          @else
            <button>
              テスト終了
            </button>
          @endif
        </div>
      </div>

      </div>
      <br>
  </div>

</div>
@endsection('content')

