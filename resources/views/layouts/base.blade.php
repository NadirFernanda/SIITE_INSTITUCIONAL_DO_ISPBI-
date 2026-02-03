{{-- ISP-Bié Layout Base Oficial --}}
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'ISP-Bié' }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="bg-white text-gray-900 min-h-screen flex flex-col">
    {{-- Header institucional --}}
    <header class="w-full bg-ispbie-blue text-white py-4 shadow-md">
        <div class="max-w-7xl mx-auto flex items-center justify-between px-4">
            <a href="/" class="font-bold text-xl tracking-tight">ISP-Bié</a>
            <nav class="space-x-6">
                <a href="/cursos" class="hover:underline">Cursos</a>
                <a href="/noticias" class="hover:underline">Notícias</a>
                <a href="/contato" class="hover:underline">Contato</a>
            </nav>
        </div>
    </header>

    {{-- Conteúdo principal --}}
    <main class="flex-1 w-full max-w-7xl mx-auto px-4 py-10">
        @yield('content')
    </main>

    {{-- Footer institucional --}}
    <footer class="w-full bg-ispbie-dark text-white py-6 mt-8">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-4">
            <span>&copy; {{ date('Y') }} ISP-Bié. Todos os direitos reservados.</span>
            <span class="text-sm">Desenvolvido com <span class="text-ispbie-orange">&#10084;</span> por Equipa Web</span>
        </div>
    </footer>
</body>
</html>
