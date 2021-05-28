<!-- resources/views/rooms/midwife.blade.php -->
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
    <h3>助産師国試</h3>
  </div>
  {{--
  {{ Breadcrumbs::render('kokushi.midwife') }}
  --}}
  <div class="card-body">
    <div class="card-body">
      <button class="btn-dark">ランダム１０問に挑戦（調整中）</button>
      <a href="{{ url('/midwife/audio/2')  }}">
        <button class="btn-dark" disabled="disabled">問題文の朗読を聞いてみる</button>
      </a>
      
      <form action="{{ url('/midwife/history') }}">
        @csrf
        @if ($logind == 1)
              <input type="submit" class="btn-dark" value="挑戦履歴を見る">
              <input type="hidden" name="subject_id" value="2">
        @else
          <input type="submit" class="btn-dark" value="挑戦履歴を見る（ログインユーザ専用）" disabled="disabled">
        @endif
      </form>
    </div>

    <h4>過去問に挑戦</h4>
	  {{-- アクションの引数：科目ID　　　タイトルIDもしくはタイトル名を渡す必要がある --}}
    <form action="{{ action('KokushiController@startPractice') }}" method="post">
      @csrf
      <input type="radio" name="testType" value="1" checked="checked">一問一答&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="testType" value="2">試験形式
	    <div class="card-body">
        <table class="table table-striped task-table">
          <tr>
            <th>
              タイトル
            </th>
            <th>
              挑戦者数（今日）
            </th>
            <th>
              ランキング
            </th>
            <th>
            
            </th>
            <th>
            
            </th>
          </tr>
          @foreach ($titles as $title)
            <tr>
              <td>
  	            <input type="submit" name="questions_title" value="{{ $title->questions_title }}">
              </td>
              <td>
                {{-- 試験挑戦数（試験情報テーブルから取得） --}}
              </td>
              <td>
                {{-- 正答率 --}}
              </td>
              <td>
                {{-- 個別・累積解答数 --}}
              </td>
              <td>
                {{-- 正答率 --}}
              </td>
            </tr>
          @endforeach
        </table>
        <input type="hidden" name="subject_id" value="3">
        <input type="hidden" name="selected_answer" value="99">
      </div>
    </form>
  </div>
</div>
<br>

<div class="listArea">
  <div class="innerList">
      <!-- TOP  -->
  </div>
</div>
@endsection
