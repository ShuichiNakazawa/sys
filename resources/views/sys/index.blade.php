<!-- resources/views/rooms/index.blade.php -->
@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')


<body>
	<div style="vertical-align: middle; height: 70px; background-color:rgb(220, 220, 210);">
	  <h1 style="padding-top: 12px; text-align: center; background-color:rgb(220, 220, 210)">ララアシスト</h1>
	</div>

	<nav class="navbar navbar-expand-md navbar-light bg-thin_brown shadow-sm">
	    <div class="container">
	      <a href="https://lara-assist.jp">Top</a>
	      <a href="{{ url('about') }}">ご挨拶</a>
	      <a href="{{ url('systems') }}">システム</a>
	      <a href="{{ url('reservation') }}">リモート予約（調整中）</a>
	      <a href="{{ url('memo') }}">技術情報</a>
	      <a href="{{ url('inquiry') }}">お問合せ（調整中）</a>
	      <a href="{{ url('references') }}">参考サイト</a>
	    </div>
	</nav>
	  <br>

	<div style="margin:0 auto; width: 50%">
	  <h2 style="text-align:center;">お知らせ</h2>
		<div class="news_outer">
			<table class="table">
				<tr>
					<th class="news_head news_date">
						日付
					</th>
					<th class="news_head">
						内容
					</th>
				</tr>
				<tr>
					<th>
						2021年5月17日
					</th>
					<th>
						サイト更新
					</th>
				</tr>
			</table>
		</div>
	</div>
	<br><br><br>
  @endsection

  @section('content')
  	<div class="container copyright">
      &copy;2020 - 2021 lara-assist.jp
    </div>
  </body>
  </html>
  @endsection

