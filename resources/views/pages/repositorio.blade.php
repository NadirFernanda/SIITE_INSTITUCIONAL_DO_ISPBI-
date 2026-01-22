<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repositório Académico - Instituto Superior Politécnico do Bié</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    @include('partials.navbar')

    <div class="bg-gradient-to-r from-[#2563eb] to-[#3B82F6] text-white py-16">
        <div class="container mx-auto px-6">
            <h1 class="text-5xl font-bold mb-4">Repositório Académico</h1>
            <p class="text-xl text-indigo-100">Trabalhos de conclusão e produção científica</p>
        </div>
    </div>

    <div class="bg-white border-b">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center text-sm text-gray-600">
                <a href="/" class="hover:text-teal-600">Início</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Repositório Académico</span>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 py-12">
        <div class="mb-8">
            <div class="max-w-2xl mx-auto">
                <input type="text" placeholder="Buscar trabalhos, autores, orientadores..." class="w-full px-6 py-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
        </div>

        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Coleções por Curso</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Contabilidade e Administração</h3>
                    <p class="text-gray-600 mb-2">45 trabalhos</p>
                    <span class="text-teal-600 font-medium">Ver todos â†’</span>
                </a>

                <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Engenharia Informática</h3>
                    <p class="text-gray-600 mb-2">38 trabalhos</p>
                    <span class="text-teal-600 font-medium">Ver todos â†’</span>
                </a>

                <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Eng. Recursos Hídricos</h3>
                    <p class="text-gray-600 mb-2">32 trabalhos</p>
                    <span class="text-teal-600 font-medium">Ver todos â†’</span>
                </a>

                <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Comunicação Social</h3>
                    <p class="text-gray-600 mb-2">28 trabalhos</p>
                    <span class="text-teal-600 font-medium">Ver todos â†’</span>
                </a>

                <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Psicologia Clínica</h3>
                    <p class="text-gray-600 mb-2">25 trabalhos</p>
                    <span class="text-teal-600 font-medium">Ver todos â†’</span>
                </a>

                <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Engenharia Civil</h3>
                    <p class="text-gray-600 mb-2">30 trabalhos</p>
                    <span class="text-teal-600 font-medium">Ver todos â†’</span>
                </a>
            </div>
        </section>

        <div class="bg-gradient-to-r from-[#2563eb] to-[#3B82F6] rounded-xl p-8 text-white text-center">
            <h2 class="text-3xl font-bold mb-4">Depositar Trabalho</h2>
            <p class="text-xl mb-8">Contribua para o repositório institucional</p>
            <button class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition-colors">
                Fazer Depósito
            </button>
        </div>
    </div>


</body>
</html>

