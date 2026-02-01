<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revista Científica - Instituto Superior Politécnico do Bié</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    @include('partials.navbar')

    <!-- Cabeçalho em card -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 mb-6">
        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-3xl font-bold text-[#2563eb] mb-2">Revista Científica ISP-Bié</h1>
            <p class="text-gray-600">Publicações científicas e académicas.</p>
        </div>
    </div>

    <div class="bg-white border-b">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center text-sm text-gray-600">
                <a href="/" class="hover:text-teal-600">Início</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Revista Científica</span>
            </div>
        </div>
    </div>


    <div class="container mx-auto px-6 py-12">
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Última Edição</h2>
            <div class="bg-white p-8 rounded-lg shadow-md">
                <div class="flex items-start gap-6">
                    <div class="w-48 h-64 bg-gradient-to-br from-[#2563eb] to-[#2563eb] rounded-lg flex items-center justify-center text-white">
                        <span class="text-6xl font-bold">Vol. 1</span>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Volume 1, Número 1 (2024)</h3>
                        <p class="text-gray-600 mb-4">Edição inaugural da Revista Científica do ISP-Bié.</p>
                        <button class="bg-teal-600 text-white px-6 py-2 rounded-lg hover:bg-teal-700">Acessar Edição</button>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Submissão de Artigos</h2>
            <div class="bg-white p-8 rounded-lg shadow-md">
                <p class="text-gray-600 mb-6">A Revista Científica do ISP-Bié aceita submissões de artigos nas áreas de Engenharia, Ciências Sociais, Gestão e áreas afins.</p>
                <button class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">Submeter Artigo</button>
            </div>
        </section>
    </div>

    @include('partials.footer-content')

</body>
</html>

