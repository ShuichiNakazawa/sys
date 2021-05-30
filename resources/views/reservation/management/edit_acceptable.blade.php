<!-- resources/views/rooms/edit_acceptable.blade.php -->

{{-- データセット --}}
{{--
  ・表示対象の年配列                  $array_years
  ・選択対象の年                      $year
  ・表示対象の月配列                  $array_months
  ・選択対象の月                      $month

  ・選択された年月が何日まで存在するか  $last_day
  ・予約可能数の選択範囲　０～４
  ・時間帯の配列
  
  
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
  <h4>受付人数 編集</h4>
  <br>

  <div>
    <form action="{{ action('ReservationsController@showAcceptable') }}">  {{-- 年月をパラメータに含ませる --}}
      @csrf

      表示年月&nbsp;&nbsp;&nbsp;

      <select name="year">
        @foreach($p_array_years as $year)
          @if ($p_year == $year)
            <option value="{{ $year }}" selected="selected">{{ $year }}</option>
          @else
            <option value="{{ $year }}">{{ $year }}</option>
          @endif
        @endforeach
      </select>年
      &nbsp;&nbsp;&nbsp;

      <select name="month">
        @foreach($p_array_months as $month)
          @if ($p_month == $month)
            <option valu="{{ $month }}" selected="selected">{{ $month }}</option>
          @else
            <option valu="{{ $month }}">{{ $month }}</option>
          @endif
        @endforeach
      </select>月
      &nbsp;&nbsp;&nbsp;

      <input type="hidden" name="transition_source_page" value="1">
      <input type="submit" value="読込">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      一括編集
      <select id="numOfAcceptable">
        @foreach($p_acceptables as $acceptable)
          <option value="{{ $acceptable }}">{{ $acceptable }}</option>
        @endforeach
      </select>枠
      &nbsp;&nbsp;&nbsp;

      <span class="btn-primary" style="border-radius:2px;padding-top:1px;padding-bottom:1px;padding-left:6px;padding-right:6px; cursor:pointer;" id="set_number">設定</span>

      </form>
    </div>

    <form action="{{ action('ReservationsController@storeAcceptable') }}" method="POST">
      @csrf

  <div class="edit_acceptable_outer">
    <table class="table task-table">
      <thead>

      </thead>
      <tbody>
        <tr>
          <td>日付</td>
          <td>曜日</td>
          <td>休日</td>
          <td>10時</td>
          <td>11時</td>

          <td></td>

          <td>13時</td>
          <td>14時</td>
          <td>15時</td>
          <td>16時</td>
          <td>17時</td>
          <td>18時</td>

          <td></td>

          <td>20時</td>
          <td>21時</td>

        </tr>

        @foreach($p_array_days as $day)
          <tr>
            <td>
              {{ $day }}日
            </td>
            @if($p_array_dayOfWeek[((integer)$day - 1)] == '土')
              <td class="cell_saturday">
                {{ $p_array_dayOfWeek[((integer)$day - 1)] }}
              </td>
            @elseif($p_array_dayOfWeek[((integer)$day - 1)] == '日')
              <td class="cell_sunday">
                {{ $p_array_dayOfWeek[((integer)$day - 1)] }}
              </td>
            @else
              <td class="cell_day">
                {{ $p_array_dayOfWeek[((integer)$day - 1)] }}
              </td>
            @endif
            </td>
            <td>
              祝日区分
            </td>

            @foreach ($p_array_timezones as $timezone)
              @if($timezone != 0)
                <td>
                  <select name="{{ 'd' . $day . 'h' . $timezone }}" id="{{ 'd' . $day . 'h' . $timezone }}">
                    @foreach($p_acceptables as $acceptable)
                      <option value="{{ $acceptable }}">{{ $acceptable }}</option>
                    @endforeach
                  </select>
                </td>
              @else
                <td></td>
              @endif
            @endforeach

          </tr>
        @endforeach
      </form>
      </tbody>
    </table>
  </div>
  {{-- 表示年月を変更し、読込ボタンを押下しなかった場合に、入力値とズレが生じる。JavaScriptでイベントリスナーで処理する必要がある --}}
  <input type="hidden" name="r_year" value="{{ $p_year }}">
  <input type="hidden" name="r_month" value="{{ $p_month }}">
  <input type="submit" value="登録・更新">

</div>


@endsection

@section('script')
  <script type="module">
    $(function(){

      // 設定ボタン 押下時処理
      $('#set_number').click(function(){

        // 一括編集数 取得
        var numOfReservation  = $('#numOfAcceptable option:selected').val();

        // ループ 日付
        for(var index_day = 1; index_day < 32; index_day++){

          var array_timezone = [10, 11, 13, 14, 15, 16, 17, 18, 20, 21];

          // ループ 時間帯
          for(var index_timezone = 0; index_timezone < 10; index_timezone++){

            // ID名 編集
            var id_select = '#d' + index_day + 'h' + array_timezone[index_timezone];

            // 予約数 設定
            $(id_select).val(numOfReservation);
          }
        }

      })


    })
  </script>
@endsection