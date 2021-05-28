<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content=" ～web技術を身近に～  千葉県旭市にてシステム開発からアプリ操作のインストラクションまで、皆さまがより身近にインターネットサービスを利用できるよう、全力でサポートいたします。スマートデバイス操作のインストラクション等もお気軽にご相談ください。私はIT技術の普及に貢献します。">

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
</head>
  
<body>
	<div style="vertical-align: middle; height: 70px; background-color:rgb(220, 220, 210);">
	  <h1 style="padding-top: 12px; text-align: center; background-color:rgb(220, 220, 210)">ララアシスト</h1>
	</div>

	<nav class="navbar navbar-expand-md navbar-light bg-thin_brown shadow-sm">
	    <div class="container">
        <div>
          <a href="{{ url('/') }}">Top</a>
        </div>
        <div>
          <a href="{{ url('about') }}">ご挨拶</a>
        </div>
        <div>
          <a href="{{ url('systems') }}">システム</a>
        </div>
        <div>
          <a href="{{ url('reservation') }}">リモート予約（調整中）</a>
        </div>
        <div>
          <a href="{{ url('memo') }}">技術情報</a>
        </div>
        <div>
          <a href="{{ url('inquiry') }}">お問合せ</a>
        </div>
        <div>
          <a href="{{ url('references') }}">参考サイト</a>
        </div>
	    </div>
	</nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @yield('footer')
    @yield('script')
  </body>
</html>
