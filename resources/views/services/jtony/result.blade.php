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
      <div id = "" style="display: block;">
        <img src = '{{ asset("/icon/computer_work.png") }}' alt="computer"><span style="font-size:32px;font-weight:bold;color:#30b279;">結果一覧</span>
      </div>
      <div style="display: block; width: 100%;">
      </div>

      <div style="font-size: 25px;">
        正答率：{{ $correct_percent }}％
      </div>

      <div class="questions_outer">
        <div>
          <table>
            <tr>
              <th>
                問題<br>番号
              </th>
              <th>
                問題文
              </th>

              <th style="width: 70px;">
                判定
              </th>
            </tr>
          
          @php
            $index = 0;
            //dd($ongoing_scores);

          @endphp


          @foreach($question_sentences as $question)
            <tr>
              <td>
                {{ $question->question_number }}
              </td>
              <td style="text-align: left;">
                {{ mb_substr($question->question_sentence, 0, 30) }}
              </td>
              <td>
                @if ($ongoing_scores[$index]->judgement  == 1)
                  〇
                @elseif($ongoing_scores[$index]->judgement == 0)
                  ×
                @else
                  △
                @endif
              </td>
              <td>
                {{-- ユーザごとに付箋テーブルを作成し、メモ追記を実装する。該当する科目・タイトル・番号のレコードが存在した時に〇を表示させる。 --}}

              </td>
              <td>
                <a href="{{ url( '/result/question/' . $subject_id . '/' . $title_id . '/' . $question->question_number . '/' . $user_id . '/' . $test_score_id) }}">
                  <button>
                    参照
                  </button>
                </a>
              </td>
            </tr>
            @php
              $index++;
            @endphp
          @endforeach
        </table>
      </div>
      </div>

      </div>
      <br>
  </div>

</div>
@endsection('content')
