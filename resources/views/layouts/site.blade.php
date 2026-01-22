<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Página') - ISP-Bié</title>
    @php
        $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        $cssFile = $manifest['resources/css/app.css']['file'] ?? null;
    @endphp
    @if($cssFile)
        <link rel="stylesheet" href="{{ asset('build/' . $cssFile) }}">
    @endif
</head>
<body class="bg-white text-gray-900">

    @include('partials.navbar')

    {{-- Hero global para páginas que definem a seção hero --}}
    @hasSection('hero')
        @yield('hero')
    @endif

    @php
        // Detecta se é a homepage
        $isHome = request()->routeIs('home') || request()->is('/');
    @endphp
    <main @if($isHome) class="min-w-0 p-0 m-0 bg-white" style="max-width:100vw;" @else class="max-w-4xl mx-auto py-12 px-4" @endif>
        @yield('content')
    </main>

    @include('partials.footer-content')

    @php
        $jsFile = $manifest['resources/js/app.js']['file'] ?? null;
    @endphp
    @if($jsFile)
        <script type="module" src="{{ asset('build/' . $jsFile) }}"></script>
    @endif
</body>
</html>
