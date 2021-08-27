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
		<div class="memo_outer">
			<ul>

				<li>
					<a href="/memo/vue_kotutubo">
						Vue.js 基本
					</a>
				</li>

				<li>
					<a href="/memo/laravel_command_list">
						Laravel コマンドリスト
					</a>
				</li>

				<li>
					<a href="/memo/git_command_list">
						git コマンドリスト
					</a>
				</li>

				<li>
					<a href="/memo/html_tag_main_list">
						HTML主要タグリスト
					</a>
				</li>

				<li>
					<a href="/memo/display_setting_for_sns">
						SNSでの表示設定(html)
					</a>
				</li>
			</ul>
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
