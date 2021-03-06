<!-- resources/views/rooms/index.blade.php -->
@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@if(session('error_message'))
<div class="alert alert-danger">
  {{ session('error_message') }}
</div>
@endif

@include('common.errors')

<table class="table" style="width: 367px; margin: 0 auto;">
  <tr>
    <th>
      保有チケット
    </th>
    <th style="border: solid 2px #999; text-align:center;">
      55分
    </th>
    <td class="ticket_td" style="border: solid 2px #999; text-align:center;">
      {{ $ticket->ticket1hour }}枚
    </td>
    <th style="border: solid 2px #999; text-align:center;">
      15分
    </th>
    <td class="ticket_td" style="border: solid 2px #999; text-align:center;">
      {{ $ticket->ticket15min + $ticket->ticket15min_trial }}枚
    </td>
    {{--
    <td>経過日数：{{ $numOfDaysElapsed }}</td><td>：当月の日数：{{ $numOfThisWeekDays }}</td>
    --}}
  </tr>
  <tr>
    <th>時間単位</th>
    <td style="text-align:center;"><input type="radio" name="min" id="min15" value="1" style="display:none;"><label for="min15" style="border-radius: 6px;">15分</label></td>
    <td style="text-align:center;"><input type="radio" name="min" id="min55" value="2" style="display:none;" checked="checked"><label for="min55" style="border-radius: 6px;">55分</label></td>
  </tr>
</table>


<div class="card-body ">
  <div class="" style="margin:0 auto; text-align: center;">

  </div>

  <div class="weekly_outer">

    <table class="table task-table">
      <thead>
        <tr>
        {{--
        <div style="display: inline;">
        --}}
        <td colspan="2">
          @if ( $flag_lastWeek == 1 ) {{-- 指定年月日と週初日を比較 --}}
            <form action="{{ url('/reservation') }}">
              <button>前週へ</button>
              <input type="hidden" name="selected_ymd" value="{{ $last_week_ymd }}">
              <input type="hidden" name="min" value="{{ $disp }}">
            </form>
          @else
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          @endif
        </td>
          {{--
        </div>
        <div style="display: inline; text-align: center; font-size: 20px">
          --}}
          <td colspan="5" style="font-size: 20px;">
          {{ $selected_year }}年{{ $selected_month }}月 第{{ $numOfWeek }}週
          </td>
          {{--
        </div>
        <div style="display: inline;">
          --}}
          <td colspan="2">
            @if($flag_nextWeek == 1)
              <form action="{{ url('/reservation') }}">
                <button>翌週へ</button>
                <input type="hidden" name="selected_ymd" value="{{ $next_week_ymd }}">
                <input type="hidden" name="min" value="{{ $disp }}">
              </form>
            @else
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            @endif
          </td>
          {{--
          </div>
          --}}
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>曜日</td>
          <td class="cell_sunday cell_week">日</td>
          <td class="cell_week">月</td>
          <td class="cell_week">火</td>
          <td class="cell_week">水</td>
          <td class="cell_week">木</td>
          <td class="cell_week">金</td>
          <td class="cell_saturday cell_week">土</td>
        </tr>

        <tr>
          <td>日付</td>

          @php
            $j = 0
          @endphp
          @foreach($days as $day)
            <td  class="cell_day">{{ $day }}</td>
          @endforeach
        </tr>

        @foreach($hours as $hour)
          <tr>
            @if($hour != 0)
              <td class="cell_hour">{{ $hour }}時</td>

                  {{-- 日付と時間帯に応じた予約可能数をテーブルから取得して設定したい --}}

                  @for ($i = 0; $i < 7; $i++)
                    @if ($i >= $numOfDaysElapsed      // 過去の日付ではない、かつ今週の表示数、かつ前月日数より小さい
                     &&  $i < $numOfThisWeekDays
                     &&  $i >= $numOfLastMonthDays)

                      {{-- ユーザが予約済かどうかを判定する必要がある。どう判定する？
                        年月日・時間帯が一致、分が一致。２０分単位を１データとして保存する事で、一致させられるように実装する？ --}}
                        @php
                          $falg_reserved = 0;
                          $numOfHit      = 0;
                        @endphp

                        @foreach($user_reservations as $user_reservation)
                          @if(    $selected_year     ==  $user_reservation->year
                              &&  $selected_month    ==  $user_reservation->month
                              &&  $days[$i]          ==  $user_reservation->day
                              &&  $hour              ==  $user_reservation->timezone)
                              {{--
                              &&  $minute   ==  $user_reservation->minute)
                              --}}
                            {{-- ユーザが予約済の場合 --}}
                            @php
                              $falg_reserved = 1;
                              $numOfHit++;
                            @endphp
                          @endif
                        @endforeach

                        {{-- 時間・分・日付の順に並んでいる。年月も含めて一致判定 --}}

                        @if (
                              ($selected_year              ==      $now_year
                          &&  $selected_month              ==      $now_month
                          &&  $days[$i]           ==      $now_day
                          )

                          &&  (
                                (integer)$hour      <       (integer)$now_hour
                            ||  (
                                  (integer)$hour     ==      (integer)$now_hour
                            )
                          )
                        )

                          {{-- 現在時刻を過ぎた予約は非表示にする --}}
                          <td class="past_date">　</td>

                          {{--
                          <td class="past_date">現在：{{ $now_day }}日{{ $now_hour }}時{{ $now_minute }}分、　データ：{{ $days[$i] }}日{{ $hour }}時{{ $minute }}分</td>
                          --}}

                        @elseif ($falg_reserved == 1)

                          {{-- 予約有 --}}

                          {{-- ヒット件数によって表示を変える。（例）３件ヒットなら１時間の予約なので◎、１，２件ヒットなら部分予約で〇。 --}}
                          @switch ($numOfHit)
                            @case(1)
                              <td class="reserved_date">
                                <a href="#{{ 'cancel_' . $selected_year . '_' . $selected_month . '_' . $days[$i] . '_' . $hour }}" style="text-decoration:none;">
                                  <div  class="reserved">
                                    〇
                                  </div>
                                </a>
                              </td>
                              @break
                            @case(2)
                              <td class="reserved_date">
                                <a href="#{{ 'cancel_' . $selected_year . '_' . $selected_month . '_' . $days[$i] . '_' . $hour }}" style="text-decoration:none;">
                                  <div  class="reserved">
                                    〇
                                  </div>
                                </a>
                              </td>
                              @break
                            @case(3)
                              <td class="reserved_date">
                                <a href="#{{ 'cancel_' . $selected_year . '_' . $selected_month . '_' . $days[$i] . '_' . $hour }}" style="text-decoration:none;">
                                  <div  class="reserved">
                                    ◎
                                  </div>
                                </a>
                              </td>
                              @break
                          @endswitch
                        @else
                          {{-- 予約無 --}}

                          @switch ($reservations[$j]->number_available - $reservations[$j]->number_accepted)
                            @case(0)
                              <td class="upcomming_date">
                                <div  class="reservation_impossible">
                                  ×
                                </div>
                              </td>
                              @break
                            @default
                              <td class="upcomming_date">
                                {{--
                                <div  class="reservation_possible">
                                  --}}
                                  <form action="{{ url('/reservation_hour/' . $selected_year . '/' . $selected_month . '/' . $days[$i] . '/' . $hour) }}" method="POST">
                                    @csrf

                                    <div class="reservation_possible">
                                      <button class="btn-reserve">予約</button>
                                    </div>
                                  </form>
                                {{--
                                </div>
                                --}}
                              </td>
                          @endswitch
                        @endif

                    @else
                      <td class="past_date">　</td>
                    @endif

                    @php
                      $j++;
                    @endphp
                  @endfor

                  {{--
                  @foreach ($reservations as $reservation)
                    <td>{{ $reservation->number_available }}</td>
                    @if ($loop->count == 7)
                      @break
                    @endif
                  @endforeach
                  --}}
                  {{--
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  --}}
                  </tr>
            @else
              <td colspan="9" style="text-align:center;">休憩時間</td>
            @endif
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

@section('footer')

@endsection

@section('script')
  <script type="module">
    window.addEventListener('DOMContentLoaded', function(){

      $('input[name="min"]').change(function(){

        // 時間単位 取得
        var min = $('input[name="min"]:checked').val();

        // 画面遷移
        //window.location.href  = "?min=" + min;
        window.location.href  = "?min=" + min + "&selected_ymd={{ $selected_ymd }}";
      })
    });
  </script>
@endsection