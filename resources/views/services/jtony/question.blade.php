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
        <img src = "{{ asset('icon/computer_work.png') }}" alt="computer"><span style="font-size:32px;font-weight:bold;color:#30b279;">問題に挑戦</span>
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
        <p>問{{ $question_number }}</p>
        <br><br>

          {{-- 問題文 --}}
          <p>{{ $question_sentence[0]->question_sentence }}</p>
          <br><br>

          {{-- 図・表 --}}
          @if($question_sentence[0]->flag_graph_exists == 1)
            <div style="width: 100%">
            </div>

            図が入る
            <br>
            {{ $question_sentence[0]->image_filename }}

          @endif
          <div style="width: 100%">
          </div>

          <br>          

          {{-- 選択肢文 --}}
          @foreach($choice_sentences as $choice_sentence)
            <div class="choice_centence_area">
              <button>
                {{ $array_choices[$choice_sentence->choice_id] }}
              </button>
              {{ $choice_sentence->choice_sentence }}  
            </div>
            <div style="width: 100%">
            </div>
            <br><br>
          @endforeach


          {{--
          <table>
            <tr>
              <th>
                問題<br>番号
              </th>
              <th>
                問題文
              </th>
              <th>
                画像
              </th>
              <th style="width: 35px;">
                付箋
              </th>
              <th style="width: 70px;">
                操作
              </th>
            </tr>
            
          @foreach($questions as $question)
            <tr>
              <td>
                {{ $question->question_number }}
              </td>
              <td style="text-align: left;">
                {{ mb_substr($question->question_sentence, 0, 30) }}
              </td>
              <td>
                @if($question->flag_graph_exists == 1)
                  〇
                @else
                  -
                @endif
              </td>
              <td>
                {{-- ユーザごとに付箋テーブルを作成し、メモ追記を実装する。該当する科目・タイトル・番号のレコードが存在した時に〇を表示させる。 --}}
            {{--
              </td>
              <td>
                <a href="{{ url( '/question/' . $subject_id . '/' . $title_id . '/' . $question->question_number) }}">
                  <button>
                    参照
                  </button>
                </a>
              </td>
            </tr>
          @endforeach
        </table>

        --}}
      </div>
      </div>

      </div>
      <br>
  </div>

</div>
@endsection('content')

{{--
<div id = "layer1"></div>

      <!-- ポップアップ -->
      <div id="year_season_list">
        <div id = "year_season_list_in"></div>
      </div>

<br>
<br>

<br><br><br>
</div>
--}}
