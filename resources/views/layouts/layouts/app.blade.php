<!doctype html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Instituto Superior Politécnico do Bié</title>
    <link rel="icon" type="image/png" href="/favicon.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="antialiased bg-white text-[var(--brand-dark)]">
    @include('partials.navbar')

    <main class="min-h-screen main-content">
      @yield('content')
    </main>

    @include('partials.footer')
  </body>
  </html>

