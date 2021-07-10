<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>商品一覧</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="main.css">
    <style>
body {
  background: #000;
  color: #fff;
}

.container {
  width: 960px;
  margin: 0 auto;
}

.pageTitle {
  font-weight: normal;
  border-bottom: 2px solid;
}

.search {
  display: flex;
  justify-content: space-between;
}

.search .target {
  display: inline-block;
}

.search .target label {
  margin-right: 15px;
}

.search .sort {
  display: inline-block;
}

.list {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

.list::after{
  content: "";
  display: block;
  width: 250px;
}

.item {
  flex: 0 1 250px;
  margin-bottom: 30px;
}

.item .image {
  position: relative;
  text-align: center;
}

.item .image img {
  width: 100%;
  height: auto;
}

.item .status {
  position: absolute;
  border-radius: 50%;
  width: 4em;
  height: 4em;
  font-size: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #bf0000;
  color: #fff;
}

.item .detail {
  text-align: center;
}

.item .price {
  display: inline-block;
}

.item .price span {
  font-size: 180%;
}

.item .shipping-fee {
  display: inline-block;
  background: #f7cd12;
  color: #000;
}

.item .shipping-fee.none {
  background: #bf0000;
  color: #fff;
}
    </style>

  </head>
  <body>
    <div id="app">
      <div class="container">
        <h1 class="pageTitle">商品一覧</h1>
        <!-- 検索欄-->
        <div class="search">
          <div class="result">
            検索結果 <span class="count">6件</span>
          </div>
          <div class="condition">
            <div class="target">
              <label><input type="checkbox">セール対象</label>
              <label><input type="checkbox">送料無料</label>
            </div>
            <div class="sort">
              <label for="sort">並び変え</label>
              <select id="sort" class="sorting">
                <option vlaue="1">標準</option>
                <option value="2">価格が安い順</option>
              </select>
            </div>
          </div>
        </div>
        <!--商品一覧-->
        <div class="list">
          <div class="item">
            <figure class="image">
              <div class="status">SALE</div>
              <img src="/vue_images/01.jpg" alt="">
              <figcaption>Michael<br>スマホケース</figcaption>
            </figure>
            <div class="detail">
              <div class="price"><span>1,580</span>円（税込）</div>
              <div class="shipping-fee none">送料無料</div>
            </div>
          </div>
          <div class="item">
            <figure class="image">
              <div class="status">SALE</div>
              <img src="/vue_images/02.jpg" alt="">
              <figcaption>Raphael<br>スマホケース</figcaption>
            </figure>
            <div class="detail">
              <div class="price"><span>1,580</span>円（税込）</div>
              <div class="shipping-fee none">送料無料</div>
            </div>
          </div>
          <div class="item">
            <figure class="image">
              <div class="status">SALE</div>
              <img src="/vue_images/03.jpg" alt="">
              <figcaption>Gabriel<br>スマホケース</figcaption>
            </figure>
            <div class="detail">
              <div class="price"><span>1,580</span>円（税込）</div>
              <div class="shipping-fee">+送料240円</div>
            </div>
          </div>
          <div class="item">
            <figure class="image">
              <div class="status">SALE</div>
              <img src="/vue_images/04.jpg" alt="">
              <figcaption>Uriel<br>スマホケース</figcaption>
            </figure>
            <div class="detail">
              <div class="price"><span>980</span>円（税込）</div>
              <div class="shipping-fee none">送料無料</div>
            </div>
          </div>
          <div class="item">
            <figure class="image">
              <img src="/vue_images/05.jpg" alt="">
              <figcaption>Ariel<br>スマホケース</figcaption>
            </figure>
            <div class="detail">
              <div class="price"><span>980</span>円（税込）</div>
              <div class="shipping-fee none">送料無料</div>
            </div>
          </div>
          <div class="item">
            <figure class="image">
              <img src="/vue_images/06.jpg" alt="">
              <figcaption>Azrael<br>スマホケース</figcaption>
            </figure>
            <div class="detail">
              <div class="price2"><span>1,580</span>円（税込）</div>
              <div class="shipping-fee none">送料無料</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="main.js"></script>
  </body>
</html>