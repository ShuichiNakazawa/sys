<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>サンプル</title>
<meta name="viewport" content="width=device-width">

<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>

<link href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Montserrat:400,900" rel="stylesheet">


<style type="text/css">
  <!--

body {
	margin: 0;
	font-family: 'メイリオ', 'Hiragino Kaku Gothic Pro', sans-serif;
}


/* 基本 */

.post * {
	margin: 0;
}

.post img {
	width: 100%;
	height: auto;
	vertical-align: bottom;
}


/* グリッド */
.post {
	display: grid;
	grid-template-columns: repeat(5, 1fr);
	grid-template-rows: repeat(12, 1fr);
	grid-column-gap: 40px;
	padding: 0 30px;
	font-family: 'Noto Sans Japanese', sans-serif;
	font-size: 16px;
}


/* タイトル */
.post-title {
	grid-column: 1 / 5;
	grid-row: 1 / 3;
	align-self: center;
	z-index: 10;
	font-size: 2.8125em;
	font-weight: 900;
	line-height: 1.2;
}

/* サブタイトル */
.post-sub {
	grid-column: 1 / -1;
	grid-row: 2;
	color: #ddd;
	font-family: 'Montserrat', sans-serif;
	font-size: 3.375em;
	font-weight: 900;
	letter-spacing: 0.14em;
	line-height: 1;
}

/* 日付 */
.post-date {
	grid-column: 5;
	grid-row: 2;
	justify-self: end;
	font-family: 'Montserrat', sans-serif;
	font-size: 0.875em;
}

/* リード文 */
.post-lead {
	grid-column: 1 / 3;
	grid-row: 3 / 5;
	font-size: 0.9375em;
	font-weight: 700;
	line-height: 1.8;
}

/* 文章01 */
.post-text01 {
	grid-column: 1 / 3;
	grid-row: 5 / 9;
	font-size: 0.75em;
	font-weight: 200;
	line-height: 2;
	text-align: justify;
	text-justify: inter-ideograph;
}

/* 画像01 */
.post-fig01 {
	grid-column: 3 / 6;
	grid-row: 3 / 7;
	margin-right: -30px;
}

.post-fig01 img {
	height: 100%;
	object-fit: cover;
}

/* キャッチコピー */
.post-catch {
	grid-column: 3 / 6;
	grid-row: 7;
	justify-self: center;
	align-self: center;
	margin-left: 30px;
	font-size: 1.25em;
	line-height: 1.5;
	text-align: center;
	quotes: '“' '”';
	display: grid;
	grid-auto-flow: column;
	grid-column-gap: 5px;
}

.post-catch::before {
	content: open-quote;
}

.post-catch::after {
	content: close-quote;
}

.post-catch::before,
.post-catch::after {
	color: #aaa;
	font-size: 2em;
	font-weight: 900;
}


/* 文章02 */
.post-text02 {
	grid-column: 3 / 5;
	grid-row: 8 / 13;
	font-size: 0.75em;
	font-weight: 200;
	line-height: 2;
	text-align: justify;
	text-justify: inter-ideograph;
}

/* 画像02 */
.post-fig02 {
	grid-column: 1 / 3;
	grid-row: 9 / 13;
	align-self: center;
}

.post-fig02 figcaption {
	font-size: 0.625em;
	font-weight: 500;
}

/* SNSメニュー */
.post-sns {
	grid-column: 5;
	grid-row: 8 / 13;
	justify-self: end;
	align-self: center;
}

.post-sns ul {
	margin: 0;
	padding: 0;
	list-style: none;
	display: grid;
	grid-row-gap: 10px;
}

.post-sns a {
	font-size: 1.5em;
	color: #aaa;
	text-decoration: none;
	text-align: center;
	border: solid 1px #aaa;
	border-radius: 50%;
	display: block;
	width: 2em;
	height: 2em;
	line-height: 2em;
}



/* マーク画像 */
.post::after {
	grid-column: 2 / 4;
	grid-row: 4 / 6;
	justify-self: center;
	align-self: center;
	width: 9.375em;
	height: 9.375em;
	content: url(img/anchor.svg);
	opacity: 0.15;
}


/* ##### 画面の横幅1000ピクセル以上 ##### */
@media (min-width: 1000px) {

	.post {
		width: 1000px;
		box-sizing: border-box;
		margin: auto;
		font-size: 20px;
	}

}


/* ##### 画面の横幅769～999ピクセル ##### */
@media (min-width: 769px) and (max-width: 999px) {
	.post {
		font-size: calc(16px + 4 * (100vw - 768px) / 232);
	}
}


/* ##### 画面の横幅767ピクセル以下 ##### */
@media (max-width: 767px) {

	.post {
		grid-template-columns: none;
		grid-template-rows: none;
		grid-row-gap: 20px;
		padding: 20px;
		font-size: 14.4px;
	}

	.post > *,
	.post::after {
		grid-column: auto;
		grid-row: auto;
	}


	/* タイトル */
	.post-title {
		grid-column: 1;
		grid-row: 1;
		word-break: keep-all;
	}

	/* マーク画像 */
	.post::after {
		grid-column: 1;
		grid-row: 1;
		justify-self: end;
		margin-bottom: -20px;
	}

	/* サブタイトル */
	.post-sub {
		grid-column: 1;
		grid-row: 2;
		font-size: 24px;
	}

	/* 日付 */
	.post-date {
		grid-column: 1;
		grid-row: 2;
		align-self: end;
	}

	/* リード文 */
	.post-lead {
		font-size: 16px;
	}

	/* 画像01 */
	.post-fig01 {
		margin-left: -20px;
		margin-right: -20px;
	}

	/* キャッチコピー */
	.post-catch {
		margin-left: 0;
		margin-top: -35px;
		justify-self: end;
		background: rgba(255,255,255,0.6);
		box-shadow: 0 0 10px 10px rgba(255,255,255,0.6);
		border-radius: 10px;
	}

	/* 文章01 & 文章02 */
	.post-text01,
	.post-text02 {
		font-size: 15px;
	}

	/* SNSメニュー */
	.post-sns {
		justify-self: center;
	}

	.post-sns ul {
		grid-auto-flow: column;
		grid-column-gap: 20px;
	}

}
  -->
  </style>
</head>
<body>

<article class="post">

	<h1 class="post-title">夏の海の<wbr>アクティビティ</h1>
	<p class="post-sub">SUMMER ACTIVITY</p>
	<time class="post-date" datetime="2020-08-01">
		<span class="far fa-clock"></span> 2020/08/01
	</time>

	<p class="post-lead">おでかけ妄想シリーズ。今回は「夏の海のアクティビティ」というお題をいただきましたので、南国気分でお届けします。</p>

	<figure class="post-fig01">
		<img src="../../../img/ocean.jpg" alt="">
	</figure>

	<p class="post-catch">
	青色に広がる海を眺めて<br>
	のんびりまったりな幸せを満喫
	</p>

	<div class="post-text01">
	<p>キラキラと光る青い海、ゆらゆらと浮かぶ小さな舟、どこまでも歩いていける白い砂浜。朝早く目覚めて波打ち際をちゃぷちゃぷ歩いていると、カラッとした空気にサラッとした風が気持ちよく感じます。ここはとある南の小さな島です。</p>

	<p>海が広いのか、滞在者が少ないのか、人の姿もそれほど目につきません。満員電車のように人で溢れたどこかの海水浴場とは大違いです。海と砂浜と青い空を独り占めにして、のんびり景色を眺めたり、なんとなく波と戯れてみたり、木陰でお昼寝してみたり、読書して過ごしてみたり… なんて誰もが夢描いたことがありそうな南国リゾート的な時間の使い方もできてしまうところなのです。</p>
	</div>

	<figure class="post-fig02">
		<img src="../../../img/tree.jpg" alt="">
		<figcaption>サラサラの風に吹かれながら<br>
		木陰でお昼寝するのも気持ちいいです。</figcaption>
	</figure>

	<div class="post-text02">
	<p>とはいえ、日頃から時間に追われる生活をしていると、いきなり「自由にのんびり過ごしていいよ～」と言われてもどうしたものか戸惑ってしまうもの。そんなときには、そこでしかできない「何か」に挑戦してみるのもおすすめです。</p>
	<p>リゾート地であれば、大なり小なり多彩なマリンアクティビティが楽しめます。シュノーケリング、アクアウォーク、パラセーリング、ジェットスキー、バナナボート、シーカヤック etc. 本格的なものから、泳ぐのが苦手な人でも楽しめるものまで、さまざまなプランが用意されていますので、検索するだけでも楽しいです。そして、検索結果で夢を大きくしていくのは自由です。</p>
	<p>夢を大きくしすぎて日常に戻るのが嫌になったら、またここに遊びにきてください。きれいな写真を用意してお待ちしています。</p>
	</div>

	<aside class="post-sns">
	<ul>
	<li><a href="#">
		<span class="fab fa-twitter" title="Twitter"></span>
	</a></li>
	<li><a href="#">
		<span class="fab fa-facebook-f" title="Facebook"></span>
	</a></li>
	<li><a href="#">
		<span class="fab fa-google-plus-g" title="Google+"></span>
	</a></li>
	</ul>
	</aside>

</article>


<script>
var ua = window.navigator.userAgent.toLowerCase();

if(ua.indexOf('safari') != -1 && ua.indexOf('version/10') != -1) {

var imgs = document.querySelectorAll('.post-fig01 img');

var imgs = Array.prototype.slice.call(imgs,0);

imgs.forEach(function(value, index, array) {
	var imgurl = value.src;
	var fig = value.parentNode;
	fig.style.backgroundImage = 'url(' + imgurl + ')';
	fig.style.backgroundSize = 'cover';
	fig.style.backgroundPosition = 'center';
	fig.style.minHeight = '250px';
	value.style.display = 'none';
});

}
</script>

</body>
</html>
