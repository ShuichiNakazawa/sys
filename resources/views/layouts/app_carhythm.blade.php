<!DOCTYPE html>
  <html lang="{{ app()->getLocale() }}">
    <head>
      <title>CARHYTHM</title>
      <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    </head>

    <body>
      <nav class="navbar navbar-light bg-light">
        <div class="container">
          <a href="top">ナビゲーションバー　表示エリア　Top</a>
        </div>
      </nav>
      @yield('content')
    </body>
  </html>
  