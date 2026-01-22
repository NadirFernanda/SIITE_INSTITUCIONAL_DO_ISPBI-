<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidaturas - Instituto Superior Politécnico do Bié</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    @include('partials.navbar')

    <!-- Banner -->
    <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] text-white py-16">
        <div class="container mx-auto px-6">
            <div class="flex items-center mb-4">
                <svg class="w-12 h-12 mr-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                </svg>
                <h1 class="text-5xl font-bold">Candidaturas</h1>
            </div>
            <p class="text-xl text-orange-100 max-w-3xl">
                Candidatura e ingresso no ISP-Bié
            </p>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center text-sm text-gray-600">
                <a href="/" class="hover:text-teal-600">Início</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Candidaturas</span>
            </div>
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="container mx-auto px-6 py-12">
        <!-- Calendário -->
        <section class="mb-16">
            <div class="bg-orange-50 border-l-4 border-orange-600 p-6 mb-8">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-orange-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"/>
                    </svg>
                    <div>
                        <h3 class="font-bold text-orange-900">Período de Candidaturas 2026</h3>
                        <p class="text-orange-800">As candidaturas para o ano académico 2026 estarão abertas de 15 de Janeiro a 15 de Março de 2026</p>
                    </div>
                </div>
            </div>

            <h2 class="text-3xl font-bold text-gray-900 mb-8">Processo de Candidatura</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <span class="text-2xl font-bold text-orange-600">1</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Documentação</h3>
                    <p class="text-sm text-gray-600">Prepare os documentos necessários</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <span class="text-2xl font-bold text-orange-600">2</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Candidatura Online</h3>
                    <p class="text-sm text-gray-600">Preencha o formulário online</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <span class="text-2xl font-bold text-orange-600">3</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Pagamento</h3>
                    <p class="text-sm text-gray-600">Efetue o pagamento da taxa</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <span class="text-2xl font-bold text-orange-600">4</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Resultado</h3>
                    <p class="text-sm text-gray-600">Aguarde a divulgação dos resultados</p>
                </div>
            </div>
        </section>

        <!-- Documentos Necessários -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Documentos Necessários</h2>
            <div class="bg-white p-8 rounded-lg shadow-md">
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-teal-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-900">Certificado do Ensino Secundário</h3>
                            <p class="text-gray-600">Original e fotocópia autenticada</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-teal-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-900">Bilhete de Identidade</h3>
                            <p class="text-gray-600">Fotocópia autenticada</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-teal-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-900">Atestado Médico</h3>
                            <p class="text-gray-600">Comprovação de aptidão física</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-teal-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-900">Fotografias 3x4</h3>
                            <p class="text-gray-600">4 fotografias tipo passe recentes</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-teal-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-gray-900">Comprovativo de Pagamento</h3>
                            <p class="text-gray-600">Taxa de candidatura: 5.000 AOA</p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <!-- Cursos Disponíveis -->
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Cursos Disponíveis</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Contabilidade e Administração</h3>
                    <p class="text-gray-600 mb-4">Duração: 4 anos</p>
                    <div class="text-sm text-gray-500 mb-4">
                        <span class="font-semibold">Vagas:</span> 40
                    </div>
                    <a href="/cursos" class="text-teal-600 hover:text-teal-700 font-medium">Ver detalhes â†’</a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Engenharia Informática</h3>
                    <p class="text-gray-600 mb-4">Duração: 5 anos</p>
                    <div class="text-sm text-gray-500 mb-4">
                        <span class="font-semibold">Vagas:</span> 40
                    </div>
                    <a href="/cursos" class="text-teal-600 hover:text-teal-700 font-medium">Ver detalhes â†’</a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Eng. Recursos Hídricos</h3>
                    <p class="text-gray-600 mb-4">Duração: 5 anos</p>
                    <div class="text-sm text-gray-500 mb-4">
                        <span class="font-semibold">Vagas:</span> 40
                    </div>
                    <a href="/cursos" class="text-teal-600 hover:text-teal-700 font-medium">Ver detalhes â†’</a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Comunicação Social</h3>
                    <p class="text-gray-600 mb-4">Duração: 4 anos</p>
                    <div class="text-sm text-gray-500 mb-4">
                        <span class="font-semibold">Vagas:</span> 40
                    </div>
                    <a href="/cursos" class="text-teal-600 hover:text-teal-700 font-medium">Ver detalhes â†’</a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Psicologia Clínica</h3>
                    <p class="text-gray-600 mb-4">Duração: 5 anos</p>
                    <div class="text-sm text-gray-500 mb-4">
                        <span class="font-semibold">Vagas:</span> 40
                    </div>
                    <a href="/cursos" class="text-teal-600 hover:text-teal-700 font-medium">Ver detalhes â†’</a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Engenharia Civil</h3>
                    <p class="text-gray-600 mb-4">Duração: 5 anos</p>
                    <div class="text-sm text-gray-500 mb-4">
                        <span class="font-semibold">Vagas:</span> 40
                    </div>
                    <a href="/cursos" class="text-teal-600 hover:text-teal-700 font-medium">Ver detalhes â†’</a>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] rounded-xl p-8 text-white text-center">
            <h2 class="text-3xl font-bold mb-4">Pronto para Candidatar-se?</h2>
            <p class="text-xl text-orange-100 mb-8">Inicie sua candidatura online agora mesmo</p>
            <div class="flex flex-wrap justify-center gap-4">
                <button class="bg-white text-orange-600 px-8 py-3 rounded-lg font-semibold hover:bg-orange-50 transition-colors">
                    Candidatar-se Online
                </button>
                <a href="/contactos" class="bg-teal-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-teal-700 transition-colors">
                    Fale Connosco
                </a>
            </div>
        </section>
    </div>


</body>
    @include('partials.footer')
</html>

