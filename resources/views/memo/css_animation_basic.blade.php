<!-- resources/views/sys/css_animation_basic.blade.php -->
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
	  <h2 style="text-align:center;">CSSアニメーション基本</h2>
		<div class="text_outer">
			<div id = "main">
	
				<pre>
					<code>
						&lt;head&gt;
							～略～

						&lt;/head&gt;
					</code>
				</pre>
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
