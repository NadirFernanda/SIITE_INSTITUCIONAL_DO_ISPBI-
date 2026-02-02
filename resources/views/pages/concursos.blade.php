<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concursos - Instituto Superior Politécnico do Bié</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    @include('partials.navbar')

    <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] text-white py-16 scroll-reveal">
        <div class="container mx-auto px-6">
            <h1 class="text-5xl font-bold mb-4">Concursos Públicos</h1>
            <p class="text-xl text-orange-100">Contratação de pessoal por meio de concurso público</p>
        </div>
    </div>

    <div class="bg-white border-b scroll-reveal">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center text-sm text-gray-600">
                <a href="/" class="hover:text-teal-600">Início</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Concursos Públicos</span>
            </div>
        </div>
    </div>

    <!-- Informação sobre Concursos Públicos -->
    <div class="bg-blue-50 border-b scroll-reveal">
        <div class="container mx-auto px-6 py-8">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-start">
                    <svg class="w-8 h-8 text-blue-600 mr-4 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Contratação por Concurso Público</h3>
                        <p class="text-gray-700 leading-relaxed mb-3">
                            O <strong>Instituto Superior Politécnico do Bié (ISP-Bié)</strong>, sendo uma instituição pública de ensino superior, 
                            contrata todo o seu pessoal exclusivamente através de <strong>concursos públicos</strong>, em conformidade com a 
                            legislação angolana e os princípios de transparência, igualdade de oportunidades e mérito.
                        </p>
                        <p class="text-gray-700 leading-relaxed">
                            Todos os editais de concursos são publicados no Diário da República e divulgados nos meios de comunicação social, 
                            bem como nesta página oficial. Os processos seguem critérios rigorosos de avaliação para garantir a selecção 
                            dos melhores candidatos.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 py-12 scroll-reveal">
        <!-- Categorias de Concursos -->
        <section class="mb-12 scroll-reveal">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Categorias de Concursos</h2>
            <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <div class="bg-white p-6 rounded-lg shadow-md text-center hover:shadow-xl transition-shadow interactive-card">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Docentes</h3>
                    <p class="text-gray-600 text-sm">Professores e investigadores para os diversos cursos</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md text-center hover:shadow-xl transition-shadow interactive-card">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Técnicos</h3>
                    <p class="text-gray-600 text-sm">Técnicos administrativos e de apoio</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md text-center hover:shadow-xl transition-shadow interactive-card">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Outros</h3>
                    <p class="text-gray-600 text-sm">Bibliotecários, investigadores e outras funções</p>
                </div>
            </div>
        </section>

        <section class="mb-16 scroll-reveal">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Concursos Abertos</h2>
            <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg p-12 text-center interactive-card">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Nenhum Concurso Aberto</h3>
                <p class="text-gray-600 mb-6">
                    Não há concursos públicos em andamento no momento. Cadastre-se para receber alertas quando novos concursos forem publicados.
                </p>
                <a href="/trabalhe-conosco#alertas" class="inline-block bg-[#2563eb] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#1f3342] transition-colors">
                    Receber Alertas
                </a>
            </div>
        </section>

        <section class="mb-16 scroll-reveal">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Concursos Encerrados</h2>
            <div class="space-y-4">
                <div class="bg-gray-50 p-6 rounded-lg interactive-card">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="inline-block bg-gray-300 text-gray-700 text-xs px-3 py-1 rounded-full mb-2">ENCERRADO</span>
                            <h3 class="text-lg font-semibold text-gray-700">Docentes - Psicologia</h3>
                        </div>
                        <button class="text-teal-600 hover:text-teal-700">Ver Resultado</button>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg interactive-card">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="inline-block bg-gray-300 text-gray-700 text-xs px-3 py-1 rounded-full mb-2">ENCERRADO</span>
                            <h3 class="text-lg font-semibold text-gray-700">Bibliotecário</h3>
                        </div>
                        <button class="text-teal-600 hover:text-teal-700">Ver Resultado</button>
                    </div>
                </div>
            </div>
        </section>

        <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] rounded-xl p-8 text-white text-center scroll-reveal">
            <h2 class="text-3xl font-bold mb-4">Receber Alertas de Concursos Públicos</h2>
            <p class="text-xl mb-8">Cadastre-se para receber notificações sobre novos concursos</p>
            <a href="/trabalhe-conosco#alertas" class="bg-white text-orange-600 px-8 py-3 rounded-lg font-semibold hover:bg-orange-50 transition-colors inline-block">
                Cadastrar-se
            </a>
        </div>

        <!-- Informação Adicional -->
        <section class="mt-12 bg-white rounded-lg shadow-md p-8 scroll-reveal interactive-card">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Princípios dos Concursos Públicos</h3>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="flex items-start">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-2">Transparência</h4>
                        <p class="text-gray-600 text-sm">Todos os editais e resultados são publicados oficialmente e divulgados amplamente</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-2">Igualdade de Oportunidades</h4>
                        <p class="text-gray-600 text-sm">Acesso aberto a todos os candidatos que cumpram os requisitos estabelecidos</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-2">Mérito</h4>
                        <p class="text-gray-600 text-sm">Selecção baseada em critérios objectivos de competência e qualificação</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                        <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-2">Legalidade</h4>
                        <p class="text-gray-600 text-sm">Conformidade com a legislação angolana e regulamentos internos</p>
                    </div>
                </div>
            </div>
        </section>
    </div>


</body>
</html>

