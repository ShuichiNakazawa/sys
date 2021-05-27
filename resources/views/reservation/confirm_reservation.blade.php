<!-- resources/views/rooms/index.blade.php -->
@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')

<div class="card-body ">
  <div>
    <h4 style="display: block; text-align: center;">予約一覧確認</h4>

    {{--
    <div class="reservation_list_outer">
    --}}
    <div>
      <table class="table" style="margin:0 auto; width: 300px;">
        <tbody>
          {{--
          <tr>
            <th colspan="3">
              名前：{{ auth()->user()->name }}
            </th>
          </tr>
          --}}

          <tr>
            <th class="reservation_th">日付</th>
            <th class="reservation_th">開始時間</th>
            <th class="reservation_th">終了時間</th>
          </tr>
          @foreach($reservations as $reservation)
            <tr>
              <td class="reservation_td">
                {{ $reservation->year . '年' . $reservation->month . '月' . $reservation->day . '日'}}
              </td>
              <td class="reservation_td">
                {{ $reservation->timezone . '時' . $reservation->minute . '分' }}
              </td>
              <td class="reservation_td">
                {{ $reservation->timezone . '時' . $reservation->minute . '分'  }}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('footer')
<div class="container copyright">
    ©2020 lara-assist.jp
</div>
@endsection