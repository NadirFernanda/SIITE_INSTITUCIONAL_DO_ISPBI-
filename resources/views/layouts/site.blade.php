<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- ─── Primary SEO ──────────────────────────────────────────────────── --}}
    @php
        $pageTitle       = trim(View::yieldContent('title', 'ISP-Bié'));
        $fullTitle       = $pageTitle === 'ISP-Bié'
                            ? 'Instituto Superior Politécnico do Bié — ISP-Bié'
                            : $pageTitle . ' — ISP-Bié';
        $metaDescription = trim(View::yieldContent('meta_description',
            'Website oficial do Instituto Superior Politécnico do Bié (ISP-Bié). ' .
            'Conheça os nossos cursos de graduação, pós-graduação, serviços e oportunidades.'));
        $metaKeywords    = trim(View::yieldContent('meta_keywords',
            'ISP-Bié, Instituto Superior Politécnico do Bié, ensino superior Angola, ' .
            'cursos universitários Bié, Cuito, engenharia, psicologia, comunicação social'));
        $canonicalUrl    = url()->current();
        $ogImage         = trim(View::yieldContent('og_image', asset('images/og-default.jpg')));
    @endphp

    <title>{{ $fullTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords"    content="{{ $metaKeywords }}">
    <meta name="author"      content="Instituto Superior Politécnico do Bié">
    <meta name="robots"      content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <link  rel="canonical"   href="{{ $canonicalUrl }}">

    {{-- ─── Open Graph (Facebook / LinkedIn / WhatsApp) ──────────────────── --}}
    <meta property="og:type"        content="website">
    <meta property="og:url"         content="{{ $canonicalUrl }}">
    <meta property="og:title"       content="{{ $fullTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:image"       content="{{ $ogImage }}">
    <meta property="og:image:width"  content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale"      content="pt_AO">
    <meta property="og:site_name"   content="ISP-Bié">

    {{-- ─── Twitter Card ─────────────────────────────────────────────────── --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="{{ $fullTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image"       content="{{ $ogImage }}">

    {{-- ─── Favicon & Touch Icons ────────────────────────────────────────── --}}
    <link rel="icon"             type="image/png"         href="{{ asset('images/favicon.png') }}">
    <link rel="shortcut icon"    type="image/x-icon"      href="{{ asset('images/favicon.ico') }}">
    <link rel="apple-touch-icon"                          href="{{ asset('images/apple-touch-icon.png') }}">

    {{-- ─── JSON-LD Structured Data ──────────────────────────────────────── --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "CollegeOrUniversity",
        "name": "Instituto Superior Politécnico do Bié",
        "alternateName": "ISP-Bié",
        "url": "{{ config('app.url') }}",
        "logo": "{{ asset('images/logo.png') }}",
        "image": "{{ $ogImage }}",
        "description": "{{ $metaDescription }}",
        "foundingDate": "2020",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Rua Padre Fidalgo, entre Artur de Paiva e Francisco de Leite Cardoso S/N",
            "addressLocality": "Cuito",
            "addressRegion": "Bié",
            "addressCountry": "AO"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "customer support",
            "email": "geral@isp-bie.ao",
            "url": "{{ url('/contactos') }}"
        },
        "sameAs": []
    }
    </script>

    {{-- ─── Page-level extra head content ────────────────────────────────── --}}
    @stack('head')

    @php
        $manifestPath = public_path('build/manifest.json');
        $manifest = file_exists($manifestPath)
            ? (json_decode(file_get_contents($manifestPath), true) ?? [])
            : [];
        $cssFile = $manifest['resources/css/app.css']['file'] ?? null;
    @endphp
    @if($cssFile)
        <link rel="stylesheet" href="{{ asset('build/' . $cssFile) }}">
    @endif
</head>

<body class="bg-white text-gray-900 overflow-x-hidden">
    <!-- Navbar institucional principal -->
    @include('partials.navbar')

    {{-- Hero global para páginas que definem a seção hero --}}
    @hasSection('hero')
        @yield('hero')
    @endif

    @php
        $isHome = request()->routeIs('home') || request()->is('/');
    @endphp
    <main @if($isHome) class="min-w-0 p-0 m-0 bg-white" style="max-width:100vw;" @else class="w-full min-h-screen bg-gray-50" @endif>
        @yield('content')
    </main>

    @include('partials.footer-content')

    @php
        $jsFile = $manifest['resources/js/app.js']['file'] ?? 'resources/js/app.js';
        $jsPath = public_path('build/' . $jsFile);
        $jsVersion = file_exists($jsPath) ? filemtime($jsPath) : time();
    @endphp
    <script type="module" src="{{ asset('build/' . $jsFile) }}?v={{ $jsVersion }}"></script>
    <script>
        window.addEventListener('contextmenu', function (event) {
            event.preventDefault();
        });

        window.addEventListener('keydown', function (event) {
            const ctrlKey = event.ctrlKey || event.metaKey;
            const key = event.key?.toLowerCase();

            if (event.key === 'F12') {
                event.preventDefault();
                return;
            }

            if (ctrlKey && (key === 'u' || key === 's' || key === 'p' || key === 'i' || key === 'j' || key === 'c')) {
                event.preventDefault();
                return;
            }

            if (ctrlKey && event.shiftKey && ['i', 'j', 'c'].includes(key)) {
                event.preventDefault();
            }
        });
    </script>

        @stack('scripts')

</body>
</html>
