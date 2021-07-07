<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>

  <link href="https://fonts.googleapis.com/earlyaccess/mplus1p.css" rel="stylesheet"  type="text/css">

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,700" rel="stylesheet" type="text/css">

  <link href="style2.css" rel="stylesheet" type="text/css">

  <title>chapter2 サンプル</title>

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

.post-series img {
	max-width: 30px;
}

.shop img {
	max-width: 100px;
}


/* グリッド */
.post {
	--side: 20px;
	display: grid;
	grid-template-columns: var(--side) 1fr 50px 1fr var(--side);
	grid-template-rows: auto 30px auto 40px auto 30px auto;
}

/* ヘッダー */
.post-head {
	grid-column: 2 / -2;
	grid-row: 1;

	/* ヘッダーのグリッド */
	display: grid;
	grid-template-columns: 75px 1fr 140px;
	grid-template-rows: 45px repeat(3, auto);
	grid-column-gap: 24px;
	grid-row-gap: 12px;
}


/* ヘッダー: タイトル */
.post-title {
	grid-column: 2;
	grid-row: 3;
	font-family: 'Mplus 1p', sans-serif;
	font-size: 35px;
	font-weight: 900;
	line-height: 1.2;
}

/* ヘッダー: リード文 */
.post-lead {
	grid-column: 2;
	grid-row: 4;
	font-size: 13px;
	line-height: 1.8;
}

/* ヘッダー: シリーズ名 */
.post-series {
	grid-column: 1;
	grid-row: 1 / 4;
	margin-bottom: -12px;
	background-color: #000;
	color: #fff;
	font-size: 14px;
	font-family: 'Source Sans Pro', sans-serif;
	font-weight: 700;
	text-align: center;
	display: grid;
	justify-items: center;
	align-items: center;
	align-content: center;
	grid-row-gap: 8px;
}

/* ヘッダー: 日付 */
.post-date {
	grid-column: 3;
	grid-row: 1;
	align-self: end;
	padding: 3px 0;
	background-color: #222;
	color: #fff;
	font-family: 'Source Sans Pro', sans-serif;
	font-size: 14px;
	text-align: center;
}


/* ヘッダー： メニューの基本設定 */
.post-head ol,
.post-head ul {
	display: grid;
	grid-auto-flow: column;
	justify-content: start;
	margin: 0;
	padding: 0;
	list-style: none;
}

.post-head a,
.post-head a {
	color: #000;
	text-decoration: none;
}

/* ヘッダー: パンくずリスト */
.post-bread {
	grid-column: 2;
	grid-row: 1;
	align-self: end;
	font-size: 10px;
	line-height: 2;
}

.post-bread li:not(:last-child)::after {
	margin: 0 5px;
	content: '>';
	color: #aaa;
}

/* ヘッダー: カテゴリー */
.post-category {
	grid-column: 2;
	grid-row: 2;
}

.post-category ul {
	grid-column-gap: 5px;
}

.post-category a {
	display: block;
	padding: 3px 10px;
	border-radius: 5px;
	background-color: #ccc;
	font-size: 10px;
}

/* ヘッダー: SNSメニュー */
.post-sns {
	grid-column: 3;
	grid-row: 3;
}

.post-sns ul {
	justify-content: space-between;
}

.post-sns a {
	font-size: 14px;
	color: #fff;
	text-align: center;
	border-radius: 5px;
	display: block;
	width: 40px;
	line-height: 35px;
}
.post-sns li:nth-child(1) a
	 {background-color: #55acee;}
.post-sns li:nth-child(2) a
	 {background-color: #3b5998;}
.post-sns li:nth-child(3) a
	 {background-color: #dd4b39;}

/* ヘッダー： 区切り線 */
.post-head::before	{
	grid-column: 1 / -1;
	grid-row: 1;
	align-self: end;
	content: '';
	border-top: solid 4px #222;
	height: 2px;
	border-bottom: solid 2px #222;
	margin: 0 calc(var(--side) * -1) -4px;
}

/* ヘッダー： 装飾画像 */
.post-head::after	{
	grid-column: 3;
	grid-row: 4;
	justify-self: center;
	align-self: center;
	width: 80%;
	content: url('img/gourmet.svg');
}


/* セクション（共通） */
.sec h2 {
	font-family: 'Mplus 1p', sans-serif;
	font-size: 21px;
	font-weight: 700;
	line-height: 1.2;
}

.sec .spot {
	font-family: 'Source Sans Pro', sans-serif;
	font-size: 16px;
	font-weight: 700;
	text-align: center;
	border: solid 1px #aaa;
	border-radius: 50%;
	box-sizing: border-box;
	display: block;
	width: 3.75em;
	height: 3.75em;
	line-height: 3.75em;
}

.sec .num {
	font-family: 'Source Sans Pro', sans-serif;
	font-size: 78px;
	font-weight: 300;
	line-height: 1;
}

.sec p {
	font-size: 14px;
	text-align: justify;
	text-justify: inter-ideograph;
}


/* セクション01 */
.sec01 {
	grid-column: 2 / -2;
	grid-row: 3;

	/* セクション01のグリッド */
	display: grid;
	grid-template-columns: 50% 1fr;
	grid-template-rows: auto 1fr auto;
	grid-column-gap: 25px;
	grid-row-gap: 15px;
}

/* セクション01: 小見出し */
.sec01 h2 {
	grid-column: 2;
	grid-row: 1;
	margin-left: -70px;
	z-index: 1;

	/* 小見出しのグリッド */
	display: grid;
	grid-template-columns: auto auto 1fr;
	grid-template-rows: auto auto;
	grid-row-gap: 10px;
	align-items: end;
}

.sec01 h2::after {
	grid-column: 1 / -1;
	content: '';
	display: block;
	border: solid 4px gold;
}

.sec01 .spot {
	margin-top: -8px;
	align-self: start;
}

.sec01 .num {
	margin-bottom: -5px;
	margin-right: 5px;
}


/* セクション01: 画像 */
.sec01 figure {
	grid-column: 1;
	grid-row: 1 / -1;
}

.sec01 figure img {
	height: 100%;
	object-fit: cover;
}

/* セクション01: 文章 */
.sec01 p {
	grid-column: 2;
	grid-row: 2;
}

/* セクション01: ショップ情報 */
.sec01 .shop {
	grid-column: 2;
	grid-row: 3;
}


/* セクション02 */
.sec02 {
	grid-column: 2;
	grid-row: 5;

	/* セクション02のグリッド */
	display: grid;
	grid-template-columns: 4fr 5fr;
	grid-template-rows: auto 1fr auto auto;
	grid-column-gap: 15px;
	grid-row-gap: 15px;
}


/* セクション02: 小見出し */
.sec02 h2 {
	grid-column: 1 / -1;
	grid-row: 1;

	/* 小見出しのグリッド */
	display: grid;
	grid-template-columns: auto auto auto 1fr;
	grid-template-rows: auto;
	align-items: end;
}

.sec02 h2::after {
	grid-column: 3;
	grid-row: 1;
	align-self: stretch;
	margin-bottom: -45px;
	margin-right: 5px;
	z-index: 1;
	content: '';
	display: block;
	border: solid 4px gold;
}

.sec02 .spot {
	margin-left: -20px;
	margin-right: -10px;
	margin-bottom: -20px;
	z-index: 1;
}

.sec02 .num {
	margin-bottom: -5px;
	margin-right: 5px;
}


/* セクション02: 画像01 */
.sec02 .fig01 {
	grid-column: 1;
	grid-row: 2 / 4;
	margin-bottom: 40px;
}

.sec02 .fig01 img {
	height: 100%;
	object-fit: cover;
}


/* セクション02: 画像02 */
.sec02 .fig02 {
	grid-column: 2;
	grid-row: 3;
	margin-left: -40px;
}

/* セクション02: 文章 */
.sec02 p {
	grid-column: 2;
	grid-row: 2;
}

/* セクション02: ショップ情報 */
.sec02 .shop {
	grid-column: 1 / -1;
	grid-row: 4;
}


/* セクション03 */
.sec03 {
	grid-column: 4;
	grid-row: 5;

	/* セクション03のグリッド */
	display: grid;
	grid-template-columns: 1fr;
	grid-template-rows: auto auto 1fr auto;
	grid-row-gap: 15px;
}

/* セクション03: 小見出し */
.sec03 h2 {
	grid-column: 1;
	grid-row: 2;

	/* 小見出しのグリッド */
	display: grid;
	grid-template-columns: auto auto 1fr auto;
	grid-template-rows: auto auto;
	grid-row-gap: 10px;
	align-items: end;
}

.sec03 h2::before {
	grid-column: 4;
	grid-row: 1;
	align-self: stretch;
	margin-bottom: -10px;
	margin-top: -60px;
	z-index: 1;
	transform: rotate(-22deg);
	transform-origin: right bottom;
	content: '';
	display: block;
	border: solid 4px gold;
}

.sec03 h2::after {
	grid-column: 1 / -1;
	content: '';
	display: block;
	border: solid 4px gold;
}

.sec03 .spot {
	margin-left: -15px;
}

.sec03 .num {
	margin-bottom: -5px;
	margin-right: 5px;
}

/* セクション03: 画像 */
.sec03 figure {
	grid-column: 1;
	grid-row: 1;
}

/* セクション03: 文章 */
.sec03 p {
	grid-column: 1;
	grid-row: 3;
}

/* セクション03: ショップ情報 */
.sec03 .shop {
	grid-column: 1;
	grid-row: 4;
}


/* ショップ情報 */
.shop {
	display: grid;
	grid-template-columns: 100px 1fr;
	grid-template-rows: auto auto;
	grid-column-gap: 10px;
	grid-row-gap: 5px;
	border: solid 1px #222;
}


.shop img {
	grid-column: 1;
	grid-row: 1 / -1;
}

.shop h3 {
	grid-column: 2;
	grid-row: 1;
	font-size: 12px;
	align-self: end;
}
.shop p {
	grid-column: 2;
	grid-row: 2;
	font-size: 10px;
	line-height: 1.5;
}

.shop span {
	padding: 0 5px;
	border-radius: 10px;
	background-color: #ddd;
}


/* セクションを区切る点線 */
.post::before	{
	grid-column: 2 / -2;
	grid-row: 4;
	align-self: center;
	content: '';
	border-top: dotted 6px #ddd;
}

.post::after	{
	grid-column: 3;
	grid-row: 5;
	justify-self: center;
	content: '';
	border-left: dotted 6px #ddd;
}


/* フッター */
.post-foot {
	grid-column: 1 / -1;
	grid-row: -2;
	padding: 30px 0;
	background-color: #222;
	color: #fff;
	font-family: 'Source Sans Pro', sans-serif;
	font-size: 14px;
	font-weight: 700;
	text-align: center;
}


/* ##### 画面の横幅1000ピクセル以上 ##### */
@media (min-width: 1000px) {
	.post {
		--side: calc( (100vw - 960px) / 2 );
	}

	.post-title {
		font-size: 40px;
	}

	.sec h2 {
		font-size: 24px;
	}
}



/* ##### 画面の横幅767ピクセル以下 ##### */
@media (max-width: 767px) {
	/* グリッド */
	.post {
		--side: 20px;
		grid-template-columns:
		 var(--side) 1fr var(--side);
		grid-template-rows:
		 auto 40px auto 50px auto 50px auto 40px auto;
	}

	/* ヘッダー */
	.post-head {
		grid-column: 1 / 3;
		grid-row: 1;

		/* ヘッダーのグリッド */
		grid-template-columns: var(--side) 1fr 100px;
		grid-column-gap: 12px;
	}

	/* ヘッダー: シリーズ名 */
	.post-series {
		display: block;
		writing-mode: vertical-rl;
		width: var(--side); /* Safari 10.x用 */
	}

	.post-series img {
		width: 12px;
		height: 12px;
		vertical-align: baseline;
	}


	/* ヘッダー: タイトル */
	.post-title {
		grid-column: 2 / -1;
		grid-row: 2;
	}

	/* ヘッダー: カテゴリー */
	.post-category {
		grid-column: 2;
		grid-row: 3;
	}

	/* ヘッダー: リード文 */
	.post-lead {
		grid-column: 2 / -1;
		grid-row: 4;
	}

	/* ヘッダー: SNSメニュー */
	.post-sns a {
		width: 30px;
		line-height: 30px;
	}

	/* ヘッダー： 装飾画像 */
	.post-head::after {
		content: none;
	}


	/* セクション: 小見出し */
	.sec h2 {
		margin: 0;
		font-size: 20px;
	}

	.sec .spot {
		margin: 0 0 0 calc( (var(--side) + 5px) * -1 );
		font-size: 12px;
		align-self: end;
	}

	.sec .num {
		font-size: 60px;
	}

	/* セクション01 */
	.sec01 {
		grid-column: 2;
		grid-row: 3;

		/* セクション01のグリッド */
		grid-template-columns: 1fr;
		grid-template-rows: repeat(4, auto);
		grid-row-gap: 15px;
	}

	.sec01.sec > * {
		grid-column: auto;
		grid-row: auto;
	}

	.sec01 h2::after {
		margin: 0 calc( var(--side) * -1 );
	}

	/* セクション02 */
	.sec02 {
		grid-column: 2;
		grid-row: 5;
	}

	/* セクション03 */
	.sec03 {
		grid-column: 2;
		grid-row: 7;
	}

	.sec03.sec > * {
		grid-column: auto;
		grid-row: auto;
	}

	.sec03 h2::before {
		content: none;
	}

	/* フッター */
	.post-foot {
		grid-column: 1 / -1;
		grid-row: -2 / -1;
	}


	/* セクションを区切る点線 */
	.post::before	{
		grid-column: 2;
		grid-row: 4;
	}

	.post::after	{
		grid-column: 2;
		grid-row: 6;
		justify-self: stretch;
		align-self: center;
		border-top: dotted 6px #ddd;
	}

}

    -->
  </style>

</head>
<body>
  <article class="post">
    <header class="post-head">

      <h1 class="post-title">
        おすすめ行楽グルメスポット
      </h1>

      <p class="post-lead">これからの季節にオススメなグルメスポットの情報をお届けします。みんなでわいわい楽しむも良し、一人でのんびり楽しみに行くも良しなスポットが目白押し。営業時間が短いお店や、人気メニューはすぐになくなっちゃうお店もありますので、要チェックです。</p>

      <div class="post-series">
        <img src="../../../img2/food.svg" alt="">
        FOOD SERIES
      </div>

      <time class="post-date" datetime="2020-12-01">
        2020/12/01
      </time>

      <aside class="post-bread">
        <ol>
          <li><a href="#">トップ</a></li>
          <li><a href="#">グルメ</a></li>
          <li><a href="#">関東エリア</a></li>
        </ol>
      </aside>

      <aside class="post-category">
        <ul>
          <li><a href="#">グループ</a></li>
          <li><a href="#">おひとり様</a></li>
        </ul>
      </aside>

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
    </header>

    <section class="sec sec01">
      <h2>
        <span class="spot">SPOT</span>
        <span class="num">1.</span>
        新鮮採れたて野菜がおいしい<br>ハンバーガー
      </h2>

      <figure><img src="../../../img2/food-burger.jpg" alt="">
      </figure>

      <p>肉汁たっぷりなお肉と新鮮な野菜を一緒に楽しむなら、ここのハンバーガーが一押しです。トマトにレタス、キュウリ、玉ねぎ、アボガド、ピクルスなどなど、いろいろな野菜が用意されていて、好きなものを組合せてオリジナルのバーガーを作ることもできます。</p>

      <div class="shop">
        <h3>FLESHカフェ　恵比寿中央店</h3>
        <img src="../../../img2/shop01.jpg" alt="">
        <p>〒123-4567<br>
          東京都渋谷区恵比寿12-3中央ビル<br>
          03-0000-0000<br>
          <span>OPEN</span> 11:00-22:00[月曜定休]</p>
      </div>
    </section>

    <section class="sec sec02">
      <h2>
        <span class="spot">SPOT</span>
        <span class="num">2.</span>
        甘い香りの<br>オレンジピールクッキー
      </h2>

      <figure class="fig01">
        <img src="../../../img2/food-orange.jpg" alt="">
      </figure>
      <figure class="fig02">
        <img src="../../../img2/food-cookie.jpg" alt="">
      </figure>

      <p>オレンジピールのちょっとほろ苦い甘さに誘われて、やめられなくなるクッキーです。オレンジピールだけを楽しむのもあり。甘いものが苦手な人にもおすすめできます。</p>

      <div class="shop">
        <h3>クッキー専門店 オレンジ</h3>
        <img src="../../../img2/shop02.jpg" alt="">
        <p>〒123-4567<br>
          東京都渋谷区恵比寿12-3中央ビル<br>
          03-0000-0000<br>
        <span>OPEN</span> 11:00-22:00[月曜定休]</p>
      </div>
    </section>

    <section class="sec sec03">
      <h2>
        <span class="spot">SPOT</span>
        <span class="num">3.</span>
        ふわふわ<br>チョコカップケーキ
      </h2>
      <figure><img src="../../../img2/food-cake.jpg" alt = "">
      </figure>

      <p>お餅のようなもっちりさと、ふわふわの柔らかさが楽しめるカップケーキです。カリッと食感のチョコチップがアクセントになっています。</p>

      <div class="shop">
        <h3>ショコラティエ</h3>
        <img src="../../../img2/shop03.jpg" alt="">
        <p>〒123-4567<br>
          東京都渋谷区恵比寿12-3中央ビル<br>
          03-0000-0000<br>
        <span>OPEN</span> 11:00-22:00[月曜定休]</p>
      </div>
    </section>

    <footer class="post-foot">
      <p>FOOD SERIES</p>
    </footer>

  </article>
</body>
</html>