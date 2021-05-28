<!-- resources/views/rooms/nurse_history.blade.php -->
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
    <h3>{{ $subject_kanji_name }}国試</h3>
  </div>
  {{--
  {{ Breadcrumbs::render('kokushi.nurse') }}
  --}}
  <div class="card-body">
      <button>科目TOPへ戻る（普通のリンクに変更）</button>
      <br><br>
      <h4>挑戦履歴</h4>
      <table class="table table-striped task-table">
        <tr>
          <th>
            タイトル
          </th>
          <th>
            試験挑戦回数
          </th>
          <th>
            正答率
          </th>
          <th>
            個別・累積回答数
          </th>
          <th>
            正答率
          </th>
        </tr>
      @foreach ($titles as $title)
        <tr>
          <td>
  	        {{ $title->questions_title }}
          </td>
          <td>
            {{-- 試験挑戦回数  実施状況テーブルから取得 --}}
          </td>
          <td>
            {{-- 正答率  --}}
          </td>
          <td>
            {{-- 個別・累積回答数 --}}
          </td>
          <td>
            {{-- 正答率 --}}
          </td>
        </tr>

	      </a>
      @endforeach
    </table>

	  <input type="hidden" name="subject_id" value="1">
    <input type="hidden" name="selected_answer" value="99">
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
