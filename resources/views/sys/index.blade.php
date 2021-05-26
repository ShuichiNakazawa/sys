<!-- resources/views/sys/index.blade.php -->
@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif
  
@include('common.errors')


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

  @section('footer')
  	<div class="container copyright">
      &copy;2020 - 2021 lara-assist.jp
    </div>
  @endsection
  </body>
</html>

