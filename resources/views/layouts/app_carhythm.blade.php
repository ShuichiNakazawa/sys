<!DOCTYPE html>
  <html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        
        <meta name="csrf-token" content="7gSWlPLE96Lce3ZIIOF4SIBvXvVju1BklA9uz95l">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">

        <title>CARHYTHM</title>
        <meta name="description" content="ポイント還元型エギング釣果情報サイトです。エギング釣果を投稿するとポイントが貯まり、貯まったポイントを様々な商品と交換できるサイトです。ここでしか手に入らないアイテムもあるので、ぜひゲットしてみて下さい。株式会社釣研が運営しています。">
        <meta name="keywords" content="エギングスタジアム,エギング,エギ,イカ釣り,釣果,釣果投稿">
        
        <link rel="shortcut icon" href="/favicon.ico">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png" />

        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        
        
        <!-- <link rel="stylesheet" href="/css/bootstrap.min.css?id=88d5cfd3c98d263b4a1a"> -->
        <!-- <link rel="stylesheet" href="/css/font-awesome.min.css?id=88d5cfd3c98d263ffa1a"> -->
        <link rel="stylesheet" href="/css/aos.css?id=88d5cfd3c98d263aoa1a">
        <link rel="stylesheet" href="/css/owl.carousel.min.css?id=88d5cfd3c98d263owa1a">
        <link rel="stylesheet" href="/css/owl.theme.default.min.css?id=88d5cfd3c98d263owt4a1">
        <link rel="stylesheet" href="/css/app.css?id=88d5cfd3c98d263f4a1a" >
        <link rel="stylesheet" href="/css/toastr.css?id=88d5cfd3c98d263toa1a">

        
        
        <link rel="stylesheet" href="/css/style.css?id=88d5cfd3c98d263sta1a">
        <link rel="stylesheet" href="/css/bp_style.css?id=88d5cfd3c98d263toa1a">
        <script src="/js/jquery.min.js?id=c9dbc53eb32d9bejq3d0"></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css" />
        <link rel="stylesheet" href="/css/bp_top.css">
    


    </head>
    <body>
      <div class="row">
        <div>
          <img src="{{ asset('/images/carhythm/company_logo.jpg') }}" width="150" height="150" alt="company_logo">
        </div>
        <div>
          <h1>CARHYTHM</h1>
        </div>
      </div>

      <nav class="navbar navbar-light bg-light">
        <div class="container">

          <a href="top">ナビゲーションバー　表示エリア　Top</a>
        </div>
      </nav>
      @yield('content')
    </body>
  </html>
  