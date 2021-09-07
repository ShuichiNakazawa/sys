<!DOCTYPE html>
  <html lang="{{ app()->getLocale() }}">
    <head>
      <title>@yield('title') | {{ config('app.name&', 'CARHYTHM') }}</title>
      <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    </head>

    <body>
      <nav class="navbar navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="/">{{ config('app.name.carhythm', 'CARHYTHM') }}</a>
          <a class="fas fa-shopping-cart" href="{{ route('') }}"></a>
        </div>
      </nav>
      @yield('content')
    </body>
  </html>
  