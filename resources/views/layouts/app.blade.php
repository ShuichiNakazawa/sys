
{{--
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'title') }}</title>

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

</head>
--}}


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content=" ～web技術を身近に～  千葉県旭市にてシステム開発からアプリ操作のインストラクションまで、皆さまがより身近にインターネットサービスを利用できるよう、全力でサポートいたします。スマートデバイス操作のインストラクション等もお気軽にご相談ください。私はIT技術の普及に貢献します。">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link href="https://lara-assist.jp/index.css" rel="stylesheet">
  <title>ララアシスト ～Web技術を身近に～ 千葉県旭市 システム開発 プログラミングスクール ララアシスト</title>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-YGNQ69DFKK"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-YGNQ69DFKK');
  </script>
</head>

{{--
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
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
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
--}}


<body>
	<div style="vertical-align: middle; height: 70px; background-color:rgb(220, 220, 210);">
	  <h1 style="padding-top: 12px; text-align: center; background-color:rgb(220, 220, 210)">ララアシスト</h1>
	</div>

	<nav class="navbar navbar-expand-md navbar-light bg-thin_brown shadow-sm">
	    <div class="container">
	      <a href="https://lara-assist.jp">Top</a>
	      <a href="{{ url('about') }}">ご挨拶</a>
	      <a href="{{ url('systems') }}">システム</a>
	      <a href="{{ url('reservation') }}">リモート予約（調整中）</a>
	      <a href="{{ url('memo') }}">技術情報</a>
	      <a href="{{ url('inquiry') }}">お問合せ（調整中）</a>
	      <a href="{{ url('references') }}">参考サイト</a>
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

