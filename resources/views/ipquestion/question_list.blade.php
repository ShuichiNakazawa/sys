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
        <img src = '../../icon/computer_work.png'><span style="font-size:32px;font-weight:bold;color:#30b279;">問題</span>を選択
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

        {{--
        <div class="card_outer">
          <div class="rectant" style="width:15px;height: 22px; background-color: green; margin-top: 15px;margin-left: 15px;">
          </div>
          <div class="" style="width: 160px; height: 22px; background-color: rgb(255,247,201); margin-top: 15px;">
            基本情報技術者
          </div>

          <div id="spacer">
          </div>

          <div style="margin-left: 10px; margin-top: 10px;">
            <a href="{{ url( "/1/list") }}">
              <img src="icon/list.jpg" alt="LIST" width="50px" height="50px">
            </a>
          </div>
          <div style="margin-left: 10px; margin-top: 10px;">
            <a href="{{ route('1.test') }}">
            <img src="icon/test.jpg" alt="TEST" width="50px" height="50px">
          </div>

          <div style="margin-left: 10px; margin-top: 10px;">
            <a href="{{ route('1.graph') }}">
              <img src="icon/graph.jpg" alt="GRAPH" width="50px" height="50px">
            </a>
          </div>

          <div style="width: 100%;">
            
          </div>
          <br>

          <div style="width: 20px;">
          </div>

          <div>
            <table>
              <tr>
                <th style="width: 80px;">
                  本日
                </th>
                <th style="width: 80px;">
                  累積
                </th>
              </tr>
              <tr>
                <td>
                  
                </td>
                <td>
                  
                </td>
              </tr>
            </table>
          </div>
        </div>
        <br>


        <div class="card_outer">
          <div class="rectant" style="width:15px;height: 22px; background-color: green; margin-top: 15px;margin-left: 15px;">
          </div>
          <div class="" style="width: 160px; height: 22px; background-color: rgb(255,247,201); margin-top: 15px;">
            応用情報技術者
          </div>

          <div style="margin-left: 10px; margin-top: 10px;">
            <img src="icon/list.jpg" alt="LIST" width="50px" height="50px">
          </div>
          <div style="margin-left: 10px; margin-top: 10px;">
            <img src="icon/test.jpg" alt="TEST" width="50px" height="50px">
          </div>
          <div style="margin-left: 10px; margin-top: 10px;">
            <img src="icon/graph.jpg" alt="GRAPH" width="50px" height="50px">
          </div>
          <div style="width: 100%;">
            
          </div>
          <br>

          <div style="width: 20px;">
          </div>
          <div style="width: 80px; height: 22px; text-align: left;">
            本日：
          </div>
          <div style="width: 80px; height: 22px; text-align: left;">
            累積：
          </div>
        </div>
        <br>


        <div class="card_outer">
          <div class="rectant" style="width:15px;height: 44px; background-color: green; margin-top: 15px;margin-left: 15px;">
          </div>
          <div class="" style="width: 160px; height: 44px; background-color: rgb(255,247,201); margin-top: 15px;">
            情報セキュリティ<br>
            マネジメント
          </div>

          <div style="margin-left: 10px; margin-top: 10px;">
            <img src="icon/list.jpg" alt="LIST" width="50px" height="50px">
          </div>
          <div style="margin-left: 10px; margin-top: 10px;">
            <img src="icon/test.jpg" alt="TEST" width="50px" height="50px">
          </div>
          <div style="margin-left: 10px; margin-top: 10px;">
            <img src="icon/graph.jpg" alt="GRAPH" width="50px" height="50px">
          </div>
          <div style="width: 100%;">
            
          </div>
          <br>

          <div style="width: 20px;">
          </div>
          <div style="width: 80px; height: 22px; text-align: left;">
            本日：
          </div>
          <div style="width: 80px; height: 22px; text-align: left;">
            累積：
          </div>
        </div>
        --}}
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
