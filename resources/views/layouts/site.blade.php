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
        <style>
            @media (min-width: 768px) {
                body { padding-top: 8px; }
            }
        </style>
    <!-- Barra topo institucional (sempre fixa no topo) -->
    <div class="hidden md:block w-full fixed left-0 top-0 z-50" style="background:#0E8F81;height:4px;"></div>
    <div class="hidden md:block w-full fixed left-0 top-0 z-40" style="background:#F05A28;height:4px;top:4px;"></div>

    <!-- Navbar institucional principal -->
    @include('partials.navbar')

    {{-- Hero global para páginas que definem a seção hero --}}
    @hasSection('hero')
        @yield('hero')
    @endif

    @php
        // Detecta se é a homepage
        $isHome = request()->routeIs('home') || request()->is('/');
    @endphp
    <!--
        O navbar é fixed, então o <main> precisa de padding-top para não ser coberto.
        Ajuste pt-20/md:pt-24 conforme a altura real do header/navbar.
    -->
    <main @if($isHome) class="min-w-0 p-0 m-0 bg-white pt-0 md:pt-0" style="max-width:100vw;" @else class="max-w-4xl mx-auto py-12 px-4 pt-20 md:pt-24" @endif>
        @yield('content')
    </main>

    @include('partials.footer-content')

    @php
        $jsFile = $manifest['resources/js/app.js']['file'] ?? 'resources/js/app.js';
        $jsPath = public_path('build/' . $jsFile);
        $jsVersion = file_exists($jsPath) ? filemtime($jsPath) : time();
    @endphp
    <script type="module" src="{{ asset('build/' . $jsFile) }}?v={{ $jsVersion }}"></script>
    <!-- Alpine.js para interatividade do menu mobile -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

        @stack('scripts')

        @push('scripts')
        <script>
        function testemunhosCarousel() {
            return {
                current: 0,
                autoplay: null,
                testimonials: window.TESTEMUNHOS || [
                    {
                        nome: 'Ana Beatriz',
                        curso: 'Engenharia Informática',
                        texto: 'O ISP-Bié mudou a minha vida. Professores excelentes e uma estrutura moderna.',
                        iniciais: 'AB'
                    }
                ],
                get total() {
                    return this.testimonials.length
                },
                get currentItem() {
                    return this.testimonials[this.current]
                },
                next() {
                    this.current = (this.current + 1) % this.total
                },
                prev() {
                    this.current = (this.current - 1 + this.total) % this.total
                },
                startAutoplay() {
                    if (this.total > 1) {
                        this.autoplay = setInterval(() => this.next(), 4000)
                    }
                },
                stopAutoplay() {
                    if (this.autoplay) clearInterval(this.autoplay)
                },
                init() {
                    this.startAutoplay()
                }
            }
        }
        </script>
        @endpush
</body>
</html>
