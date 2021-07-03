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
	<div style="margin:0 auto; width: 60%;">
	  <h2 style="text-align:center;">html主要タグ一覧</h2>
		<div class="text_outer">
			<div id = "main">
	
				<h4>htmlタグ</h4>
				<table style="border-collapse: collapse; border:solid 1px #888;" class="table">
					<tr>
						<th style="background-color: aquamarine;" class="txt_center"></th>
						<th style = "background-color: #000077; color: #fff; text-align: center;"></th>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>
				</table>
				<br><br>
			</div>
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
