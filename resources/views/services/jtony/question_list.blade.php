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
        <img src = '../../icon/computer_work.png' alt="computer"><span style="font-size:32px;font-weight:bold;color:#30b279;">問題</span>を選択
      </div>
      <div style="display: block; width: 100%;">
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
      </div>
      </div>

      </div>
      <br>
  </div>

</div>
@endsection('content')
