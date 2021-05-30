<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="robots" content="noindex"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1"/>

		<meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

		<script src="{{ asset('js/app.js') }}"></script>

		<script src="https://js.stripe.com/v3/"></script>
		<title>Stripe サンプルページ</title>
	</head>
	<body>

		<nav class="navbar navbar-expand-md bg-thin_brown shadow-sm"  style="vertical-align: middle; height: 70px; background-color:rgb(220, 220, 210);">
			{{--
			<div class="container">
					--}}
					<div class="collapse navbar-collapse col-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
							<div class="col-4" style="text-align: center;">
									<a class="navbar-brand" href="{{ url('/') }}" style="font-size: 2.25rem; margin: 0; color: #212529;">
											{{ config('app.name', 'Laravel') }}
									</a>
							</div>
					<div class="collapse navbar-collapse col-4">
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
									<span class="navbar-toggler-icon"></span>
							</button>

							<div class="collapse navbar-collapse" id="navbarSupportedContent">
									<!-- Left Side Of Navbar -->
									<ul class="navbar-nav mr-auto">

									</ul>

									<!-- Right Side Of Navbar -->
									<ul class="navbar-nav ml-auto">
											<!-- Authentication Links -->
											@guest
												<li class="nav-item">
														{{--
														<a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
														--}}
												</li>
												@if (Route::has('register'))
														<li class="nav-item">
																{{--
																<a class="nav-link" href="{{ route('register') }}">{{ __('新規ユーザー登録') }}</a>
																--}}
														</li>
												@endif
											@else
												<li class="nav-item dropdown">
														<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
																{{--
																{{ Auth::user()->name }} <span class="caret"></span>
																--}}
														</a>

														<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
																{{--
																<a class="dropdown-item"  href="{{ url('/confirm_reservation/' . Auth::user()->id ) }}">予約一覧確認</a>
																&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								
																<a class="dropdown-item"  href="{{ url('https://lara-assist.jp/cashier/') }}">チケット購入</a>
																&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								
																<a class="dropdown-item"  href="{{ url('/confirm_user_info/' . Auth::user()->id ) }}">登録情報確認</a>
																&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

																<a class="dropdown-item" href="{{ route('logout') }}"
																onclick="event.preventDefault();
																								document.getElementById('logout-form').submit();">
																		{{ __('ログアウト') }}
																</a>

																<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
																		@csrf
																</form>
																																	--}}
														</div>
												</li>
											@endguest
									</ul>
							</div>
					</div>
					{{--
			</div>
			--}}
	</nav>

		<nav class="navbar navbar-expand-md bg-thin_brown shadow-sm">

			<div class="container">
					<a href="https://lara-assist.jp">Top</a>
					<a href="https://lara-assist.jp/about.html">ご挨拶</a>
					<a href="https://lara-assist.jp/systems.html">システム</a>
					<a href="https://lara-assist.jp/reservation">リモート予約（調整中）</a>
					<a href="https://lara-assist.jp/memo.html">技術情報</a>
					<a href="/reservation/inquiry">お問合せ（調整中）</a>
					<a href="https://lara-assist.jp/references.html">参考サイト</a>
			</div>
		</nav>

		<div id="">

		</div>
		<br>
		<div>
			<h3 style="text-align: center; vertical-align: middle;">Stripe サンプルページ</h3>
		</div>
		<hr>
		<br>

			{{--
			<form action="{{ action('SampleController@beforeStripe') }}" method="POST">
			--}}


			<form action="{{ action('SampleController@beforeStripe') }}" method="POST">

			@csrf
			<div class="row justify-content-center fade-in-bottom" style="margin:0;">

				<div class="card_product">
					<br>
					<div style="text-align:center; height: 50px;">
						<h5>
							鰯鯵定食
						</h5>
					</div>
					<br>
						<div class="row justify-content-center">
							<a href="https://lara-assist.jp/sample/image/sardine_and_horse_mackerel_set_meal.JPG">
								<img src="https://lara-assist.jp/sample/image/sardine_and_horse_mackerel_set_meal2.JPG" style="width:160px; height:160px;" alt="鰯鯵定食">
							</a>
						</div>
					<div class="row justify-content-center">
						1,800円
					</div>
					<div class="row justify-content-center">
						数量
						<select name="quantity_item1" id="quantity_item1" class="selector">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<br>
						<input type="hidden" name="quantity_ticket15_hidden" id="quantity_ticket15_hidden">
					</div>
					<br>
				</div>


				<div class="card_product">
					<br>
					<div style="text-align:center; height: 50px;">
						<h5>
							海の幸定食
						</h5>
					</div>
					<br>
						<div class="row justify-content-center">
							<a href="https://lara-assist.jp/sample/image/seafood_set_meal.JPG">
								<img src="https://lara-assist.jp/sample/image/seafood_set_meal2.JPG" style="width: 160px; height: 160px;" alt="海の幸定食">
							</a>
						</div>
					<div class="row justify-content-center">
						2,500円
					</div>
					<div class="row justify-content-center">
						数量
						<select  name="quantity_item2" id="quantity_item2" class="selector">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
					</div>
					<br>
				</div>


				<div class="card_product">
					<br>
					<div style="text-align:center; height: 50px;">
						<h5>
							鯛めしおにぎりと鯛の潮汁
						</h5>
					</div>
					<br>
					<div class="row justify-content-center">
						<a href="https://lara-assist.jp/sample/image/sea_bream_rice_balls_and_sea_bream_sea_bream_soup.JPG">
							<img src="https://lara-assist.jp/sample/image/sea_bream_rice_balls_and_sea_bream_sea_bream_soup2.JPG" style="width:160px; height:160px;" alt="鯛めしおにぎりと鯛の潮汁">
						</a>
					</div>
					<div class="row justify-content-center">
						2,300円
					</div>
					<div class="row justify-content-center">
						数量
						<select name="quantity_item3" id="quantity_item3" class="selector">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<br>
						<input type="hidden" name="quantity_ticket15_hidden" id="quantity_ticket15_hidden">
					</div>
				</div>

				<div class="card_product">
					<br>
					<div style="text-align:center; height: 50px;">
						<h5>
							さる海老の素揚げ
						</h5>
					</div>
					<br>
						<div class="row justify-content-center">
							<a href="https://lara-assist.jp/sample/image/deep-fried_monkey_shrimp.JPG">
								<img src="https://lara-assist.jp/sample/image/deep-fried_monkey_shrimp2.JPG" style="width:160px; height:160px;" alt="さる海老の素揚げ">
							</a>
						</div>
					<div class="row justify-content-center">
						1,000円
					</div>
					<div class="row justify-content-center">
						数量
						<select name="quantity_item4" id="quantity_item4" class="selector">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<br>
						<input type="hidden" name="quantity_ticket15_hidden" id="quantity_ticket15_hidden">
					</div>
					<br>
				</div>


				<div class="card_product">
					<br>
					<div style="text-align:center; height: 50px;">
						<h5>
							サバ味噌煮
						</h5>
					</div>
					<br>

					<div class="row justify-content-center">
						<a href="https://lara-assist.jp/sample/image/boiled_mackerel_in_miso.JPG">
							<img src="https://lara-assist.jp/sample/image/boiled_mackerel_in_miso2.JPG" style="width:160px; height:160px;" alt="サバ味噌煮">
						</a>
					</div>
					<div class="row justify-content-center">
						1,500円
					</div>
					<div class="row justify-content-center">
						数量
						<select name="quantity_item5" id="quantity_item5" class="selector">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<br>
						<input type="hidden" name="quantity_ticket15_hidden" id="quantity_ticket15_hidden">
					</div>
					<br>
				</div>


				<div class="card_product">
					<br>
					<div style="text-align:center; height: 50px;">
						<h5>
							伊勢海老の味噌汁
						</h5>
					</div>
					<br>

					<div class="row justify-content-center">
						<a href="https://lara-assist.jp/sample/image/spiny_lobster_miso_soup.JPG">
							<img src="https://lara-assist.jp/sample/image/spiny_lobster_miso_soup2.JPG" style="width:160px; height:160px;" alt="伊勢海老の味噌汁">
						</a>
					</div>
					<div class="row justify-content-center">
						1,300円
					</div>
					<div class="row justify-content-center">
						数量
						<select name="quantity_item6" id="quantity_item6" class="selector">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<br>
						<input type="hidden" name="quantity_ticket15_hidden" id="quantity_ticket15_hidden">
					</div>
					<br>
				</div>
			</div>



			<br>
			<hr>
			<br>




			<div class="row justify-content-center fade-in-bottom" style="margin:0;">
				<div class="card_product">
					<br>
					<div style="text-align:center; height: 50px;">
						<h5>
							カルボナーラ
						</h5>
					</div>
					<br>

					<div class="row justify-content-center">
						<a href="https://lara-assist.jp/sample/image/carbonara.JPG">
							<img src="https://lara-assist.jp/sample/image/carbonara.JPG" style="width:160px; height:160px;" alt="カルボナーラ">
						</a>
					</div>
					<div class="row justify-content-center">
						1,100円
					</div>
					<div class="row justify-content-center">
						数量
						<select name="quantity_item7" id="quantity_item7" class="selector">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<br>
						<input type="hidden" name="quantity_ticket15_hidden" id="quantity_ticket15_hidden">
					</div>
					<br>
				</div>


				<div class="card_product">
					<br>
					<div style="text-align:center; height: 50px;">
						<h5>
							彩り野菜の酢漬け
						</h5>
					</div>
					<br>

					<div class="row justify-content-center">
						<a href="https://lara-assist.jp/sample/image/pickled_colorful_vegetables.JPG">
							<img src="https://lara-assist.jp/sample/image/pickled_colorful_vegetables2.JPG" style="width: 160px; height: 160px;" alt="彩り野菜の酢漬け">
						</a>
					</div>
					<div class="row justify-content-center">
						900円
					</div>
					<div class="row justify-content-center">
						数量
						<select  name="quantity_item8" id="quantity_item8" class="selector">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
					</div>
					<br>
				</div>


				<div class="card_product">
					<br>
					<div style="text-align:center; height: 50px;">
						<h5>
							カボチャの冷製スープ
						</h5>
					</div>
					<br>

					<div class="row justify-content-center">
						<a href="https://lara-assist.jp/sample/image/pumpkin_soup.JPG">
							<img src="https://lara-assist.jp/sample/image/pumpkin_soup2.JPG" style="width:160px; height:160px;" alt="カボチャの冷製スープ">
						</a>
					</div>
					<div class="row justify-content-center">
						600円
					</div>
					<div class="row justify-content-center">
						数量
						<select name="quantity_item9" id="quantity_item9" class="selector">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<br>
						<input type="hidden" name="quantity_ticket15_hidden" id="quantity_ticket15_hidden">
					</div>
				</div>


				<div class="card_product">
					<br>
					<div style="text-align:center; height: 50px;">
						<h5>
							ラムレーズンのスコーン
						</h5>
					</div>
					<br>

					<div class="row justify-content-center">
						<a href="https://lara-assist.jp/sample/image/lamb_raisin_scones.JPG">
							<img src="https://lara-assist.jp/sample/image/lamb_raisin_scones.JPG" style="width:160px; height:160px;" alt="ラムレーズンのスコーン">
						</a>
					</div>
					<div class="row justify-content-center">
						500円
					</div>
					<div class="row justify-content-center">
						数量
						<select name="quantity_item10" id="quantity_item10" class="selector">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<br>
						<input type="hidden" name="quantity_ticket15_hidden" id="quantity_ticket15_hidden">
					</div>
					<br>
				</div>


				<div class="card_product">
					<br>
					<div style="text-align:center; height: 50px;">
						<h5>
							自家製アンチョビ
						</h5>
					</div>
					<br>

					<div class="row justify-content-center">
						<a href="https://lara-assist.jp/sample/image/homemade_anchovies.JPG">
							<img src="https://lara-assist.jp/sample/image/homemade_anchovies2.JPG" style="width:160px; height:160px;" alt="自家製アンチョビ">
						</a>
					</div>
					<div class="row justify-content-center">
						4,500円
					</div>
					<div class="row justify-content-center">
						数量
						<select name="quantity_item11" id="quantity_item11" class="selector">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<br>
						<input type="hidden" name="quantity_ticket15_hidden" id="quantity_ticket15_hidden">
					</div>
					<br>
				</div>
				<br><br>
			</div>

			<br><hr><br>

			<div class="row justify-content-center fade-in-bottom" style="margin:0;">
				<div class="card_product">
					<br>
					<div style="text-align:center; height: 50px;">
						<h5>
							キムチチゲ
						</h5>
					</div>
					<br>

					<div class="row justify-content-center">
						<a href="https://lara-assist.jp/sample/image/kimchi_chigae.JPG">
							<img src="https://lara-assist.jp/sample/image/kimchi_chigae2.JPG" style="width:160px; height:160px;" alt="キムチチゲ">
						</a>
					</div>
					<div class="row justify-content-center">
						1,800円
					</div>
					<div class="row justify-content-center">
						数量
						<select name="quantity_item12" id="quantity_item12" class="selector">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<br>
						<input type="hidden" name="quantity_ticket15_hidden" id="quantity_ticket15_hidden">
					</div>
					<br>
				</div>


				<div class="card_product">
					<br>
					<div style="text-align:center; height: 50px;">
						<h5>
							鶏のから揚げ
						</h5>
					</div>
					<br>

					<div class="row justify-content-center">
						<a href="https://lara-assist.jp/sample/image/fried_chicken.JPG">
							<img src="https://lara-assist.jp/sample/image/fried_chicken2.JPG" style="width: 160px; height: 160px;" alt="鶏のから揚げ">
						</a>
					</div>
					<div class="row justify-content-center">
						900円
					</div>
					<div class="row justify-content-center">
						数量
						<select  name="quantity_item13" id="quantity_item13" class="selector">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
					</div>
					<br>
				</div>


				<div class="card_product">
					<br>
					<div style="text-align:center; height: 50px;">
						<h5>
							鶏むね肉のチャーシュー風
						</h5>
					</div>
					<br>

					<div class="row justify-content-center">
						<a href="https://lara-assist.jp/sample/image/chicken_breast_char_siu_style.JPG">
							<img src="https://lara-assist.jp/sample/image/chicken_breast_char_siu_style2.JPG" style="width:160px; height:160px;" alt="鶏むね肉のチャーシュー風">
						</a>
					</div>
					<div class="row justify-content-center">
						800円
					</div>
					<div class="row justify-content-center">
						数量
						<select name="quantity_item14" id="quantity_item14" class="selector">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<br>
						<input type="hidden" name="quantity_ticket15_hidden" id="quantity_ticket15_hidden">
					</div>
				</div>


				<div class="card_product">
					<br>
					<div style="text-align:center; height: 50px;">
						<h5>
							味噌チャーシュー麺
						</h5>
					</div>
					<br>

					<div class="row justify-content-center">
						<a href="https://lara-assist.jp/sample/image/miso_char_siu_noodles.JPG">
							<img src="https://lara-assist.jp/sample/image/miso_char_siu_noodles2.JPG" style="width:160px; height:160px;" alt="味噌チャーシュー麺">
						</a>
					</div>
					<div class="row justify-content-center">
						1,100円
					</div>
					<div class="row justify-content-center">
						数量
						<select name="quantity_item15" id="quantity_item15" class="selector">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
						<br>
						<input type="hidden" name="quantity_ticket15_hidden" id="quantity_ticket15_hidden">
					</div>
					<br>
				</div>


			</div>


			<br>
			<hr>
			<div id="totalPrice" class="row justify-content-center">
				合計金額：
			</div>
			<hr>
			<div class="row justify-content-center">
				<input type="submit" id="to_purchase" value="購入画面へ" disabled="disabled">
			</div>
		</form>
		<br><br><br>
		<div class="container copyright">
			©2020 lara-assist.jp
		</div>

		<script type="module">
			window.addEventListener('DOMContentLoaded', function(){

				$('.selector').change(function(){

/*
				$('#quantity_15 quantity_15_10sheets quantity_55 quantity_55_10sheets').change(function(){
*/
/*
				$('#quantity_15').change(function(){
*/
					console.log('セレクトボックス変更判定');

					var quantity_item1								=			Number($('#quantity_item1 option:selected').val());
					var quantity_item2								=			Number($('#quantity_item2 option:selected').val());
					var quantity_item3								=			Number($('#quantity_item3 option:selected').val());
					var quantity_item4								=			Number($('#quantity_item4 option:selected').val());
					var quantity_item5								=			Number($('#quantity_item5 option:selected').val());
					var quantity_item6								=			Number($('#quantity_item6 option:selected').val());
					var quantity_item7								=			Number($('#quantity_item7 option:selected').val());
					var quantity_item8								=			Number($('#quantity_item8 option:selected').val());
					var quantity_item9								=			Number($('#quantity_item9 option:selected').val());
					var quantity_item10								=			Number($('#quantity_item10 option:selected').val());
					var quantity_item11								=			Number($('#quantity_item11 option:selected').val());
					var quantity_item12								=			Number($('#quantity_item12 option:selected').val());
					var quantity_item13								=			Number($('#quantity_item13 option:selected').val());
					var quantity_item14								=			Number($('#quantity_item14 option:selected').val());
					var quantity_item15								=			Number($('#quantity_item15 option:selected').val());

					console.log('item1 数量：' + String(quantity_item1));
					console.log('item2 数量：' + String(quantity_item2));
					console.log('item3 数量：' + String(quantity_item3));
					console.log('item4 数量：' + String(quantity_item4));
					console.log('item5 数量：' + String(quantity_item5));
					console.log('item6 数量：' + String(quantity_item6));
					console.log('item7 数量：' + String(quantity_item7));
					console.log('item8 数量：' + String(quantity_item8));
					console.log('item9 数量：' + String(quantity_item9));
					console.log('item10 数量：' + String(quantity_item10));
					console.log('item11 数量：' + String(quantity_item11));
					console.log('item12 数量：' + String(quantity_item12));
					console.log('item13 数量：' + String(quantity_item13));
					console.log('item14 数量：' + String(quantity_item14));
					console.log('item15 数量：' + String(quantity_item15));


					var total_price	=
										1800   			* 			Number(quantity_item1)
									+	2500  			* 			Number(quantity_item2)
									+	2300  			* 			Number(quantity_item3)
									+	1000	 			* 			Number(quantity_item4)
									+	1500	 			* 			Number(quantity_item5)
									+	1300	 			* 			Number(quantity_item6)
									+	1100	 			* 			Number(quantity_item7)
									+	900	 				* 			Number(quantity_item8)
									+	600	 				* 			Number(quantity_item9)
									+	500	 				* 			Number(quantity_item10)

									+	4500	 			* 			Number(quantity_item11)
									+	1800	 			* 			Number(quantity_item12)
									+	900		 			* 			Number(quantity_item13)
									+	800		 			* 			Number(quantity_item14)
									+	1100	 			* 			Number(quantity_item15);

					var total_price_with_comma	=			total_price;

					// 「購入画面へ」ボタン 無効化
					$('#to_purchase').prop("disabled", false);

					// 商品未選択判定
					if ( total_price == 0){

						// 「購入画面へ」ボタン 無効化
						$('#to_purchase').prop("disabled", true);

					// 桁区切り 付加
					} else if(999 < total_price){

						var str_total_price	=			String(total_price);

						// 下３桁と上の桁に分ける
						var total_lower			=			str_total_price.slice( -3 ) ;;
						var total_upper			=			(total_price - Number(total_lower)) / 1000;

						total_price_with_comma	= String(total_upper) + ',' + String(total_lower);
					}

					// 合計金額 編集
					$('#totalPrice').text('合計金額：' + String(total_price_with_comma) + '円');

				})

			});

		</script>
	</body>
</html>