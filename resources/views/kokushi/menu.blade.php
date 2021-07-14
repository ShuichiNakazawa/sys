<!-- resources/views/kokushi/menu.blade.php -->
{{--
  datasources
  $titles  問題タイトルテーブル

--}}
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
    <h3 class="header_center">{{ $subject_name }}過去問</h3>
  </div>
  {{--
  {{ Breadcrumbs::render('kokushi.nurse') }}
  --}}
  <div class="card-body">
    <div class="row justify-content-center">
      <div class="btn_subject">
        <button class="btn-dark">ランダム１０問に挑戦（調整中）</button>
      </div>
      <div class="btn_subject">
        <a href="{{ url('/kokushi/audio/' . $subject_id)  }}">
          <button>問題文の朗読を聞いてみる</button>
        </a>
      </div>
      <div class="btn_subject">
        <form action="{{ url('/nurse/history') }}">
          @csrf
          @if ($logind == 1)
                <input type="submit" class="btn-dark" value="挑戦履歴を見る">
                <input type="hidden" name="subject_id" value="{{ $subject_id }}">
          @else
            <input type="submit" class="btn-dark" value="挑戦履歴を見る（ログインユーザ専用）" disabled="disabled">
          @endif
        </form>
      </div>
    </div>
    <br><br>

    <h4 class="header_center">過去問に挑戦</h4>
	{{-- アクションの引数：科目ID　　　タイトルIDもしくはタイトル名を渡す必要がある --}}

    <form action="{{ action('KokushiQuestionController@setQuestion', $subject_id) }}" method="post">

      {{--
    <form>
      --}}
	    @csrf
      <div>

          

      <group class="inline-radio">
        <div>
          <label>
            テスト形式
          </label>
        </div>
        <div>
          <input type="radio" name="testType" id="question_one_answer" value="1" checked="checked">
          <label for="question_one_answer" style="font-size: 20px;"><b>一問一答</b></label>
        </div>

        <div>
          <input type="radio" name="testType" id="test_format" value="2">
          <label for="test_format" style="font-size: 20px;"><b>試験形式</b></label>
        </div>
      </group>
      <br>

      {{--
      <div class="row justify-content-center">
        --}}
      <div>
        
        <group class="inline-radio">
          <div>
            <label>
              正解時音声
            </label>
          </div>
          <div>
            <input type="radio" name="soundType" id="silent" value="1" checked="checked">
            <label for="silent" style="font-size: 20px;"><b>無音</b></label>
          </div>

          <div>
            <input type="radio" name="soundType" id="itako" value="2">
            <label for="itako" style="font-size: 20px;"><b>東北イタコ様</b></label>
          </div>

          <div>
            <input type="radio" name="soundType" id="chime" value="3">
            <label for="chime" style="font-size: 20px;"><b>チャイム</b></label>
          </div>
        </group>
      </div>

      

      <div class="card-body">
      <table class="table table-striped task-table">
        <tr>
          <th class="t_header">
            タイトル
          </th>
          <th class="t_header">
            挑戦者数（今日）
          </th>
          <th class="t_header">
            ランキング
          </th>
          <th class="t_header">
            
          </th>
          <th class="t_header">
            
          </th>
        </tr>
        @foreach ($titles as $title)
          <tr>
            <td class="t_data">
              {{--
              <input type="submit" name="question_title" value="{{ $title->question_title }}">
              --}}

              <a href="/kokushi/set_question/{{ $title->subject_name_id . "/" . $title->title_id }}">
                <button class="btn btn-light" name="title_id" value="{{$title->title_id}}">
                  {{ $title->question_title }}
                </button>
              </a>
            </td>
            <td class="t_data">
              {{-- 試験挑戦数（試験情報テーブルから取得） --}}
            </td>
            <td class="t_data">
              {{-- 正答率 --}}
            </td>
            <td class="t_data">
              {{-- 個別・累積解答数 --}}

            </td>
            <td class="t_data">
              {{-- 正答率 --}}
            </td>
          </tr>
        @endforeach
      </table>

      <input type="hidden" name="subject_id" value="{{ $subject_id }}">
      <input type="hidden" name="selected_answer" value="99">

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
