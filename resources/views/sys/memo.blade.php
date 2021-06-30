<!-- resources/views/sys/memo.blade.php -->
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
	  <h2 style="text-align:center;">技術情報</h2>
		<div class="news_outer">
			<br>
			<a href="#">
				Laravelコマンドリスト
			</a>
			<br><br>

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
