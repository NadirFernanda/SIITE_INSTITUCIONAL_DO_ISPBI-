<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal ISP-Bié - Instituto Superior Politécnico do Bié</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    @include('partials.navbar')

    <!-- Cabeçalho em card -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 mb-6">
        <div class="bg-white rounded-lg shadow-md p-8 flex items-start gap-4">
            <div class="w-12 h-12 flex items-center justify-center text-[#2563eb] mt-1">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#2563eb] mb-2">Portal ISP-Bié</h1>
                <p class="text-gray-600 max-w-3xl">Acesso centralizado a todos os sistemas e serviços institucionais.</p>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center text-sm text-gray-600">
                <a href="/" class="hover:text-teal-600">Início</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Portal ISP-Bié</span>
            </div>
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="container mx-auto px-6 py-12">
        <!-- Sistemas Acadêmicos -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Sistemas Acadêmicos</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Sistema Acadêmico</h3>
                    <p class="text-gray-600 mb-4">Gestão de matrículas, notas e documentos</p>
                    <a href="#" class="text-orange-600 hover:text-orange-700 font-medium">Acessar →</a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Portal do Estudante</h3>
                    <p class="text-gray-600 mb-4">Área exclusiva para estudantes</p>
                    <a href="#" class="text-orange-600 hover:text-orange-700 font-medium">Acessar →</a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Portal do Docente</h3>
                    <p class="text-gray-600 mb-4">Área exclusiva para professores</p>
                    <a href="#" class="text-orange-600 hover:text-orange-700 font-medium">Acessar →</a>
                </div>
            </div>
        </section>

        <!-- Serviços Online -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Serviços Online</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <a href="/biblioteca" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow text-center group">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4 mx-auto group-hover:bg-orange-200 transition-colors">
                        <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Biblioteca</h3>
                </a>

                <a href="/repositorio" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow text-center group">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4 mx-auto group-hover:bg-orange-200 transition-colors">
                        <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Repositório</h3>
                </a>

                <a href="https://ispbie.ao/webmail" target="_blank" rel="noopener" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow text-center group">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4 mx-auto group-hover:bg-orange-200 transition-colors">
                        <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Webmail</h3>
                </a>

                <a href="/revista" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow text-center group">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4 mx-auto group-hover:bg-orange-200 transition-colors">
                        <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Revista Científica</h3>
                </a>
            </div>
        </section>

        <!-- Links Rápidos -->
        <section class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] rounded-xl p-8 text-white">
            <div class="text-center">
                <h2 class="text-3xl font-bold mb-4">Precisa de Ajuda?</h2>
                <p class="text-xl text-blue-100 mb-8">Nossa equipe está pronta para auxiliar</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="/ouvidoria" class="bg-white text-teal-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                        Ouvidoria
                    </a>
                    <a href="/servicos" class="bg-white text-teal-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                        Carta de Serviços
                    </a>
                    <a href="/contactos" class="bg-orange-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-orange-700 transition-colors">
                        Contactos
                    </a>
                </div>
            </div>
        </section>
    </div>


</body>
    @include('partials.footer')
</html>

