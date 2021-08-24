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
	  <h2 style="text-align:center;">テキスト一覧</h2>
		<div class="text_outer">
			{{--
			<div><br></div>
			--}}
			<ul class="text_ul">

				<li class="text_list">
					<a href="/text/p5_js/1/1" class="text_a">
					<button>p5.js</button>
					{{--
						p5.jsについての概要が表示されていると良い。

						p5.jsは、
						--}}
					</a>
				</li>

				<li class="text_list">
					<a href="/text/html_basic" class="text_a">
						<button>html基礎</button>
					</a>
				</li>
				<li class="text_list">
					<a href="#" class="text_a">
						<button>css基礎</button>
					</a>
				</li>
				<li class="text_list">
					<a href="#" class="text_a">
						<button>JavaScript基礎</button>
					</a>
				</li>
				<li class="text_list">
					<a href="#" class="text_a">
						<button disabled="disabled">php基礎</button>
					</a>
				</li>				
				<li class="text_list">
					<a href="#" class="text_a">
						<button disabled="disabled">Laravel基礎</button>
					</a>
				</li>
				<li class="text_list">
					<a href="#" class="text_a">
						<button disabled="disabled">選択問題システムを作ろう</button>
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
