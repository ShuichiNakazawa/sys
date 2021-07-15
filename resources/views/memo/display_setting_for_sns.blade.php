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
	  <h2 style="text-align:center;">SNSでの表示設定（html）</h2>
		<div class="text_outer">
			<div id = "main">
	
				<pre>
					<code>
						&lt;head&gt;
							～略～
							&lt;meta property="og:title" content="ページのタイトル"&gt;
							&lt;meta property="og:site_name" content="サイト名"&gt;
							&lt;meta property="og:description" cotent="ページの説明文"&gt;
							&lt;meta property="og:type" content="ページの種類"&gt;
							&lt;meta property="og:url" content="ページのURL"&gt;
							&lt;meta property="og:image" content="サムネイル画像のURL"&gt;
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
