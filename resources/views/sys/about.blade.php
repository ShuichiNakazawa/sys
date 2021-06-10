<!-- resources/views/sys/about.blade.php -->
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
	<h2 style="text-align:center;">ご挨拶</h2>
	<br><br>

	<p>現代生活の様々な面で、スマートフォンやパソコンを利用する機会が増えています。
	<br>
	「操作の仕方がわからない」、「なかなか覚えられない」をサポートします。
	<br><br>

	コロナの影響で、リモートワーク環境の導入が求められています。
	<br>
	「画面共有ソフト（zoon等）の使い方を覚えたい」、「VPSを導入したい」といったご要望にご対応いたします。
	<br><br>

	IT技術の基礎となる分野の学習をサポートします。
	<br><br>

	コンピュータを身近に扱えるよう、全力で支援いたします。
	<br><br><br>

	<h3 style="text-align:center;">事業概要</h3>

	<address>
		<div class="business_content_outer">
		<table class="table table-striped task-table">
		<tbody>
			<tr>
			<th>
						屋号
			</th>
			<td>
						ララアシスト
			</td>
			</tr>
			<tr>
			<th>
						代表
			</th>
			<td>
						中澤　修一
			</td>
			</tr>
			<tr>
			<th>
						<span>事業</span><span>形態</span>
			</th>
			<td>
						個人事業主・個人フリーランス
			</td>
			</tr>
			<tr>
			<th>
						住所
			</th>
			<td>
						千葉県旭市　※自宅兼事務所の為、省略
			</td>
			</tr>
			<tr>
			<th>
						<span>営業</span><span>時間</span>
			</th>
			<td>
						平日：      10：00～21：00<br>
						土曜・祝日：10：00～19：00
			</td>
			</tr>
			<tr>
			<th>
						休日
			</th>
			<td>
						日曜　※スケジュールにより変更する場合有り
			</td>
			</tr>
			<tr>
			<th>
						<span>事業</span><span>内容</span>
			</th>
			<td>

						Web技術のインストラクション
						<br>

						既存アプリケーションの導入・支援
						<br>

						コンピュータ・スマートデバイスの操作補助
						<br>

						Webシステムのレンタル
						<br>

						システム開発
						<br>

						教材販売
						<br>

			</td>
			<tr>
			<th>
						<span>メール</span><span>アドレス</span>
			</th>
			<td>
						contact@lara-assist.jp
			</td>
			</tr>
		</tbody>
		</table>
		</div>
		<br><br>
	
		<div>
			<h4>地図</h4>
		</div>
		<div>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d680.9733139258117!2d140.65829103715964!3d35.71949802513037!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6022e105dfee34a7%3A0x46db52cf6972cca5!2z44Op44Op44Ki44K344K544OI!5e0!3m2!1sja!2sjp!4v1623056627725!5m2!1sja!2sjp" width="480" height="360" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
		</div>
	</address>
	@endsection
	
  @section('footer')
  	<div class="container copyright">
      &copy;2020 - 2021 lara-assist.jp
    </div>
  @endsection

  </body>
</html>

