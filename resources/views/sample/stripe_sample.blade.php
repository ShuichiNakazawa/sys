<!-- resources/views/sys/index.blade.php -->
@extends('layouts.app')

@section('content')

	@if(session('message'))
	<div class="alert alert-success">
		{{ session('message') }}
	</div>
	@endif

	@include('common.errors')
	<div>
		<h3 style="text-align: center; vertical-align: middle;">Stripe サンプルページ</h3>
	</div>
	<hr>

	<div id="totalPrice" class="row justify-content-center">
		合計金額：0円
	</div>
	<hr>

	@if(session('flash_message'))
		<div class="alert alert-success">
			{{ session('flash_message') }}
		</div>
	@endif
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
						<a href="https://lara-assist.jp/image/sardine_and_horse_mackerel_set_meal.JPG">
							<img src="https://lara-assist.jp/image/sardine_and_horse_mackerel_set_meal2.JPG" style="width:160px; height:160px;" alt="鰯鯵定食">
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
						<a href="https://lara-assist.jp/image/seafood_set_meal.JPG">
							<img src="https://lara-assist.jp/image/seafood_set_meal2.JPG" style="width: 160px; height: 160px;" alt="海の幸定食">
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
					<a href="https://lara-assist.jp/image/sea_bream_rice_balls_and_sea_bream_sea_bream_soup.JPG">
						<img src="https://lara-assist.jp/image/sea_bream_rice_balls_and_sea_bream_sea_bream_soup2.JPG" style="width:160px; height:160px;" alt="鯛めしおにぎりと鯛の潮汁">
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
						<a href="https://lara-assist.jp/image/deep-fried_monkey_shrimp.JPG">
							<img src="https://lara-assist.jp/image/deep-fried_monkey_shrimp2.JPG" style="width:160px; height:160px;" alt="さる海老の素揚げ">
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
					<a href="https://lara-assist.jp/image/boiled_mackerel_in_miso.JPG">
						<img src="https://lara-assist.jp/image/boiled_mackerel_in_miso2.JPG" style="width:160px; height:160px;" alt="サバ味噌煮">
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
					<a href="https://lara-assist.jp/image/spiny_lobster_miso_soup.JPG">
						<img src="https://lara-assist.jp/image/spiny_lobster_miso_soup2.JPG" style="width:160px; height:160px;" alt="伊勢海老の味噌汁">
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
					<a href="https://lara-assist.jp/image/carbonara.JPG">
						<img src="https://lara-assist.jp/image/carbonara.JPG" style="width:160px; height:160px;" alt="カルボナーラ">
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
					<a href="https://lara-assist.jp/image/pickled_colorful_vegetables.JPG">
						<img src="https://lara-assist.jp/image/pickled_colorful_vegetables2.JPG" style="width: 160px; height: 160px;" alt="彩り野菜の酢漬け">
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
					<a href="https://lara-assist.jp/image/pumpkin_soup.JPG">
						<img src="https://lara-assist.jp/image/pumpkin_soup2.JPG" style="width:160px; height:160px;" alt="カボチャの冷製スープ">
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
					<a href="https://lara-assist.jp/image/lamb_raisin_scones.JPG">
						<img src="https://lara-assist.jp/image/lamb_raisin_scones.JPG" style="width:160px; height:160px;" alt="ラムレーズンのスコーン">
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
					<a href="https://lara-assist.jp/image/homemade_anchovies.JPG">
						<img src="https://lara-assist.jp/image/homemade_anchovies2.JPG" style="width:160px; height:160px;" alt="自家製アンチョビ">
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
					<a href="https://lara-assist.jp/image/kimchi_chigae.JPG">
						<img src="https://lara-assist.jp/image/kimchi_chigae2.JPG" style="width:160px; height:160px;" alt="キムチチゲ">
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
					<a href="https://lara-assist.jp/image/fried_chicken.JPG">
						<img src="https://lara-assist.jp/image/fried_chicken2.JPG" style="width: 160px; height: 160px;" alt="鶏のから揚げ">
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
					<a href="https://lara-assist.jp/image/chicken_breast_char_siu_style.JPG">
						<img src="https://lara-assist.jp/image/chicken_breast_char_siu_style2.JPG" style="width:160px; height:160px;" alt="鶏むね肉のチャーシュー風">
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
					<a href="https://lara-assist.jp/image/miso_char_siu_noodles.JPG">
						<img src="https://lara-assist.jp/image/miso_char_siu_noodles2.JPG" style="width:160px; height:160px;" alt="味噌チャーシュー麺">
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
		<div class="row justify-content-center">
			<input type="submit" id="to_purchase" value="購入画面へ" disabled="disabled">
		</div>
	</form>
	<br>
@endsection

@section('footer')
	<div class="container copyright">
    &copy;2020 - 2021 lara-assist.jp
  </div>
@endsection

@section('script')

	<script type="module">
		window.addEventListener('DOMContentLoaded', function(){

			$('.selector').change(function(){
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
@endsection

  </body>
</html>
