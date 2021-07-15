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
					<th class="news_head news_date txt_center" style="width: 150px;">
						日付
					</th>
					<th class="news_head txt_center">
						内容
					</th>
				</tr>
				<tr>
					<td style="vertical-align: middle;">
						2021年7月15日
					</td>
					<td>
						国師過去問で正解時に、音声を再生させられるようになりました。
					</td>
				</tr>

				<tr>
					<td style="vertical-align: middle;">
						2021年6月17日
					</td>
					<td>
						サイト更新
					</td>
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

