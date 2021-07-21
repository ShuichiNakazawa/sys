<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
	<meta name="description" content="IPQUESTION 情報処理技術者試験 過去問題 IPQuestion 基本情報 情報セキュリティマネジメント 応用情報 ネットワークスペシャリスト ">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

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
  <meta name="google-site-verification" content="6_UAMzGIHZfkgeMm5TQ3Cx-7veJyCXyptJE3p9xhvCE" />

  <script async src="https://www.googletagmanager.com/gtag/js?id=G-8ZJ865L2L4"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
  
    gtag('config', 'G-8ZJ865L2L4');
  </script>
  
<body>



  <div class="page_header position-fixed">
    <div class="z100">
      <div id = "full">
        <div id = "title_img">
          <p id = "p_title">
          
            <img src = "{{ asset('image/logo.png') }}" alt = "IPQuestion" title = "ipquestion"></img>
            <img src = "{{ asset('image/title_mini.png') }}" alt = "情報処理技術者試験 過去問" title = "情報処理技術者試験 過去問"></img>
          </p>
        </div>
      </div>
      <nav class="navbar navbar-expand-lg navbar-light bg_theme">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          {{--
          <a class="navbar-brand" href="#">Hidden brand</a>
          --}}
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0 w-100 nav-justified">
            <li class="nav-item">
              {{--
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              --}}
              {{--
              <a class="nav-link_custom" href="{{ url('/') }}"><img src="icon/home.png" width="20px" height="20px" alt="TOP">TOP</a>
              --}}
              <a class="" href="{{ url('/') }}"><img src="{{ asset('icon/home.png') }}" width="20px" height="20px" alt="TOP">TOP</a>
            </li>
            <li class="nav-item">
              {{--
              <a class="nav-link" href="#">Link</a>
              --}}
              <a class="" href="{{ url('login') }}"><img src="{{ asset('icon/login.png') }}" width="20px" height="20px" alt="login">ログイン</a>
            </li>
            {{--
            <li class="nav-link_custom">
              --}}
              <li class="nav-item">
              {{--
              <a class="nav-link disabled" href="#">Disabled</a>
              --}}
              <a class="" href="{{ url('about') }}"><img src="{{ asset('icon/destination.png') }}" width="20px" height="20px" alt="about">サイト方針</a>
            </li>
            <li class="nav-item">
              {{--
              
              --}}
              <a class="nav-item" href="{{ url('news') }}">お問い合わせ</a>
            </li>
            <li class="nav-item">
              {{--
              <a class="nav-link_custom" href="{{ url('link') }}"><img src="{{ asset('icon/link.png') }}" width="20px" height="20px" alt="link">リンク</a>
              --}}
              <a class="" href="{{ url('link') }}"><img src="{{ asset('icon/link.png') }}" width="20px" height="20px" alt="link">リンク</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>

  <div class="page_body">
    <main class="py-4 main_contents">
      <br><br><br>
      @yield('content')
    </main>
  </div>

  <div class="copyright">
    <br>
    ©2020- ipquestion.jp
  </div>

  @yield('script')
</body>
</html>
