<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content=" ～web技術を身近に～  千葉県旭市 パソコンスクール プログラミング アプリ操作のインストラクションなど、皆さまがより身近にインターネットサービスを利用できるよう全力でサポートいたします。スマートデバイス操作のインストラクション等もお気軽にご相談ください。IT技術の普及に貢献します。">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'title') }}</title>

  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-QX9TMYGCGN"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-QX9TMYGCGN');
  </script>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-YGNQ69DFKK"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-YGNQ69DFKK');
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.6.0/p5.js"></script>

</head>
  
<body>
  <div class="page_header position-fixed">
    <div>
      <h1 class="page_header_h1">ララアシスト</h1>
    </div>

    <div class="z100">
      <nav class="navbar navbar-expand-md navbar-light bg-thin_brown shadow-sm position-fixed fixed">
          <div class="container position-fixed bg-thin_brown">

            <div>
              <a href="{{ url('/') }}">Top</a>
            </div>
            <div>
              <a href="{{ url('about') }}">ご挨拶</a>
            </div>
            <div>
              <a href="{{ url('systems') }}">システム</a>
            </div>
            <div class="z100">
              <a href="{{ url('reservation') }}">リモート予約</a>
            </div>
            <div class="z100">
              <a href="{{ url('memo') }}">技術情報</a>
            </div>
            <div class="z100">
              <a href="{{ url('text') }}">テキスト</a>
            </div>

            <div class="z100">
              <a href="{{ url('blog') }}">雑記</a>
            </div>
            <div class="z100">
              <a href="{{ url('sample') }}">サンプル</a>
            </div>

            <div class="z100">
              <a href="{{ url('inquiry') }}">お問合せ</a>
            </div>
            <div class="z100">
              <a href="{{ url('references') }}">参考サイト</a>
            </div>
          </div>
      </nav>
    </div>
  </div>

  <div class="page_body">
    <main class="py-4 main_contents">
      <br><br><br><br><br>
      @yield('content')
    </main>
  </div>
  

  <div class="copyright">
    <br>
    ©2020 lara-assist.jp
  </div>

  @yield('script')
</body>
</html>
