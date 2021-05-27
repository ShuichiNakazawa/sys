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
    <h4 style="display: block; text-align: center;">登録情報変更</h4>

    <form action="{{ action('ReservationsController@updateUserInfo') }}" method="POST">
      @csrf
    <table class="table" style="margin:0 auto; width: 300px;">
      <tbody>
        <tr>
          <th class="ticket_th">
            お名前
          </th>
          <td class="ticket_td">
            <input type="text" name="name" value="{{ auth()->user()->name }}">
          </td>
        </tr>
        <tr>
          <th class="ticket_th">
            メールアドレス
          </th>
          <td class="ticket_td">
            <input type="text" name="email" value="{{ auth()->user()->email }}">
          </td>
        </tr>
        <tr>
          <th class="ticket_th">
            ご年齢
          </th>
          <td class="ticket_td">
            <input type="text" name="age" value="{{ auth()->user()->age }}">
          </td>
        </tr>
        <tr>
          <th class="ticket_th">
            住所
          </th>
          <td class="ticket_td">
            <input type="text" name="street_address" value="{{ auth()->user()->street_address }}">
          </td>
        </tr>

        <tr>
          <th class="ticket_th">
            職業
          </th>
          <td class="ticket_td">
            <input type="text" name="profession" value="{{ auth()->user()->profession }}">
          </td>
        </tr>

      </tbody>
    </table>

    <div style="margin:0 auto; width: 300px;">
        <button>変更確定</button>
    </div>
  </form>


  </div>
</div>
@endsection

@section('footer')
<div class="container copyright">
    ©2020 lara-assist.jp
</div>
@endsection