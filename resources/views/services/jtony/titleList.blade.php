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
        <img src = '../../icon/computer_work.png' alt="computer"><span style="font-size:32px;font-weight:bold;color:#30b279;">開催時期</span>を選択
      </div>
      <div style="display: block; width: 100%;">
      </div>

      <div class="titles_outer">
        @foreach($titles as $title)
        <div>
          <a href="{{ url( '/question_list/' . $subject_id . '/' . $title->title_id ) }}">
            <button>
              {{ $title->question_title }}
            </button>
          </a>
        </div>
        <div style="width: 100%;">
        </div>
        @endforeach
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
