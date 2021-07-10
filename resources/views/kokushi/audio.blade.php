<!-- resources/views/rooms/audio.blade.php -->
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
    <h3>国試過去問</h3>
  </div>
  看護師
  <div class="card-body">
    <div class="card-body">
      <figure>
        <figcaption>令和２年 午前</figcaption>
        <audio controls src="{{ asset('audio/ns/r2_bn.mp3') }}" controlslist="nodownload" oncontextmenu="return false;">
          <code>audio</code>
        </audio>
      </figure>
    </div>

    <div class="card-body">
      <figure>
        <figcaption>令和２年 午後</figcaption>
        <audio controls src="{{ asset('audio/ns/r2_an.mp3') }}" controlslist="nodownload" oncontextmenu="return false;">
          <code>audio</code>
        </audio>
      </figure>
    </div>

    <div class="card-body">
      <figure>
        <figcaption>平成３１年 午前</figcaption>
        <audio controls src="{{ asset('audio/ns/h31_bn.mp3') }}" controlslist="nodownload" oncontextmenu="return false;">
          <code>audio</code>
        </audio>
      </figure>
    </div>

    <div class="card-body">
      <figure>
        <figcaption>平成３１年 午後</figcaption>
        <audio controls src="{{ asset('audio/ns/h31_an.mp3') }}" controlslist="nodownload" oncontextmenu="return false;">
          <code>audio</code>
        </audio>
      </figure>
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
