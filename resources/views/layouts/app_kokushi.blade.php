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

  <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>

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
  <div class="page_header position-fixed">
    <div class="z100">

      {{-- 修正開始

      <nav class="navbar navbar-expand-lg navbar-light bg_theme">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">

          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">

              <a class="nav-link_custom" href="{{ url('/') }}">Top</a>

            </li>
            <li class="nav-item">

              <a class="nav-link_custom" href="{{ url('about') }}">ご挨拶</a>
            </li>
            <li class="nav-link_custom">

              <a class="nav-link_custom" href="{{ url('systems') }}">システム</a>
            </li>
            <li>
              <a class="nav-link_custom" href="{{ url('reservation') }}">リモート予約</a>
            </li>
            <li>
              <a class="nav-link_custom" href="{{ url('memo') }}">技術情報</a>
            </li>
            <li>
              <a class="nav-link_custom" href="{{ url('text') }}">テキスト</a>
            </li>
            <li>

            </li>
            <li>
              <a class="nav-link_custom" href="{{ url('sample') }}">サンプル</a>
            </li>
            <li>
              <a class="nav-link_custom" href="{{ url('inquiry') }}">お問合せ</a>
            </li>
            <li>
              <a class="nav-link_custom" href="{{ url('references') }}">参考サイト</a>
            </li>

          </ul>

        </div>
      </nav>

      修正終了 --}}

      {{--
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
      --}}


    </div>
  </div>

  <div class="page_body">
    <main class="py-4 main_contents">
      {{--<br>--}}
      @yield('content')
    </main>
  </div>
  

  <div class="copyright">
    ©2020- lara-assist.jp
  </div>

  @yield('script')
</body>
</html>
