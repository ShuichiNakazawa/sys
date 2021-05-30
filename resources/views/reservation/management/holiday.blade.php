<!-- resources/views/rooms/holiday.blade.php -->
@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')

<div class="card-body">
  <h4>予約システム 管理メニュー 祝日登録</h4>

  <div class="card-body">
    <form action="" method="POST">
      @csrf

      年月日
      <select>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
        <option value="2024">2024</option>
        <option value="2025">2025</option>
      </select>年
      &nbsp;&nbsp;&nbsp;

      <select>
        <option valu="1">1</option>
        <option valu="2">2</option>
        <option valu="3">3</option>
        <option valu="4">4</option>
        <option valu="5">5</option>
        <option valu="6">6</option>
        <option valu="7">7</option>
        <option valu="8">8</option>
        <option valu="9">9</option>
        <option valu="10">10</option>
        <option valu="11">11</option>
        <option valu="12">12</option>
      </select>月
      &nbsp;&nbsp;&nbsp;

      <select>
        <option value = "01">1</option>
        <option value = "02">2</option>
        <option value = "03">3</option>
        <option value = "04">4</option>
        <option value = "05">5</option>
        <option value = "06">6</option>
        <option value = "07">7</option>
        <option value = "08">8</option>
        <option value = "09">9</option>
        <option value = "10">10</option>
        <option value = "11">11</option>
        <option value = "12">12</option>
        <option value = "13">13</option>
        <option value = "14">14</option>
        <option value = "15">15</option>
        <option value = "16">16</option>
        <option value = "17">17</option>
        <option value = "18">18</option>
        <option value = "19">19</option>
        <option value = "20">20</option>
        <option value = "21">21</option>
        <option value = "22">22</option>
        <option value = "23">23</option>
        <option value = "24">24</option>
        <option value = "25">25</option>
        <option value = "26">26</option>
        <option value = "27">27</option>
        <option value = "28">28</option>
        <option value = "29">29</option>
        <option value = "30">30</option>
        <option value = "31">31</option>
      </select>日
      <br><br>

      休日区分
      <input type="radio" name="holiday_type" id="radio_public_holiday" value="0">
      <label for="radio_public_holiday" class="btn">祝日</label>
      &nbsp;&nbsp;&nbsp;

      <input type="radio" name="holiday_type" id="radio_holiday" value="1">
      <label for="radio_holiday" class="btn">休日</label>
      <br><br>

      祝休日名称
      <input type="text" name="hoilday_name">
      <br><br>
      <input type="submit" value="登録">
    </form>
  </div>
</div>


@endsection
