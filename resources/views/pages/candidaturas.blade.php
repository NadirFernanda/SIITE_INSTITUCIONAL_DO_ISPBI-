@extends('layouts.site')


@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 scroll-reveal">
        <nav class="text-sm opacity-75 mb-8">
            <a href="/" class="hover:underline">Início</a> \ Candidaturas
        </nav>

        <div class="bg-white rounded-lg shadow-md p-8 mb-10 interactive-card">
            <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Candidaturas</h1>
            <p class="text-lg text-gray-700">Instituto Superior Politécnico do Bié</p>
            <p class="mt-3 text-gray-600 max-w-2xl">Candidatura e ingresso no ISP-Bié. Veja abaixo o processo, requisitos e etapas para se tornar estudante.</p>
        </div>

        <!-- Conteúdo Principal -->
        <section class="py-16 bg-white scroll-reveal">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                    <div class="lg:col-span-3">
                        <div class="bg-white border-l-4 border-[#2563eb] p-8 shadow-lg rounded-lg">
                            <div class="prose max-w-none text-gray-700 leading-relaxed space-y-6">
                                <div class="mb-6">
                                    <div class="bg-[#F5F5F5] border-l-4 border-[#F05A28] p-6 mb-8">
                                        <div class="flex items-center">
                                            <svg class="w-6 h-6 text-[#F05A28] mr-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"/>
                                            </svg>
                                            <div>
                                                <h3 class="font-bold text-[#F05A28]">Candidaturas para o ano 2026/2027</h3>
                                                <p class="text-[#F05A28]">As candidaturas para o ano 2026/2027 ainda não estão abertas</p>
                                            </div>
                                        </div>
                                    </div>

                                    <h2 class="text-3xl font-bold text-[#2563eb] mb-8">Processo de Candidatura</h2>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-6">
                                        <div class="bg-white p-6 rounded-lg shadow-md text-center interactive-card min-h-[160px]">
                                            <div class="w-16 h-16 bg-[#e0e7ff] rounded-full flex items-center justify-center mb-4 mx-auto">
                                                <span class="text-2xl font-bold text-[#2563eb]">1</span>
                                            </div>
                                            <h3 class="text-base sm:text-lg font-semibold text-[#2563eb] mb-2 whitespace-normal break-words">Documentação</h3>
                                            <p class="text-sm text-gray-600">Prepare os documentos necessários</p>
                                        </div>

                                        <div class="bg-white p-6 rounded-lg shadow-md text-center interactive-card min-h-[160px]">
                                            <div class="w-16 h-16 bg-[#e0e7ff] rounded-full flex items-center justify-center mb-4 mx-auto">
                                                <span class="text-2xl font-bold text-[#2563eb]">2</span>
                                            </div>
                                            <h3 class="text-base sm:text-lg font-semibold text-[#2563eb] mb-2 whitespace-normal break-words">Candidatura (Online/Presencial)</h3>
                                            <p class="text-sm text-gray-600">Preencha o formulário online</p>
                                        </div>

                                        <div class="bg-white p-6 rounded-lg shadow-md text-center interactive-card min-h-[160px]">
                                            <div class="w-16 h-16 bg-[#e0e7ff] rounded-full flex items-center justify-center mb-4 mx-auto">
                                                <span class="text-2xl font-bold text-[#2563eb]">3</span>
                                            </div>
                                            <h3 class="text-base sm:text-lg font-semibold text-[#2563eb] mb-2 whitespace-normal break-words">Pagamento</h3>
                                            <p class="text-sm text-gray-600">Efetue o pagamento da taxa</p>
                                        </div>

                                        <div class="bg-white p-6 rounded-lg shadow-md text-center interactive-card min-h-[160px]">
                                            <div class="w-16 h-16 bg-[#e0e7ff] rounded-full flex items-center justify-center mb-4 mx-auto">
                                                <span class="text-2xl font-bold text-[#2563eb]">4</span>
                                            </div>
                                            <h3 class="text-base sm:text-lg font-semibold text-[#2563eb] mb-2 whitespace-normal break-words">Exame de Acesso</h3>
                                            <p class="text-sm text-gray-600">Informações sobre exame de acesso e calendário</p>
                                        </div>

                                        <div class="bg-white p-6 rounded-lg shadow-md text-center interactive-card min-h-[160px]">
                                            <div class="w-16 h-16 bg-[#e0e7ff] rounded-full flex items-center justify-center mb-4 mx-auto">
                                                <span class="text-2xl font-bold text-[#2563eb]">5</span>
                                            </div>
                                            <h3 class="text-base sm:text-lg font-semibold text-[#2563eb] mb-2 whitespace-normal break-words">Resultado</h3>
                                            <p class="text-sm text-gray-600">Aguarde a divulgação dos resultados</p>
                                        </div>
                                    </div>
                                </div>

                                <h2 class="text-3xl font-bold text-[#2563eb] mb-8">Documentos Necessários</h2>
                                <div class="bg-white p-8 rounded-lg shadow-md">
                                    <ul class="space-y-4">
                                        <li class="flex items-start">
                                            <svg class="w-6 h-6 text-[#0E8F81] mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
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

                                <h2 class="text-3xl font-bold text-[#2563eb] mb-8 text-center">Cursos Disponíveis</h2>
                                <div class="flex flex-wrap justify-center gap-8">
                                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow interactive-card w-full max-w-sm md:max-w-xs">
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Cursos de Graduação</h3>
                                        <p class="text-gray-600 mb-4">Conheça todos os cursos disponíveis no ISP-Bié</p>
                                        <div class="text-sm text-gray-500 mb-4">
                                            <span class="font-semibold">Vagas:</span> 40 por curso
                                        </div>
                                        <a href="/cursos" class="text-[#0E8F81] hover:text-[#0a6b5c] font-medium">Ver todos os cursos →</a>
                                    </div>
                                </div>

                                <hr class="my-6">

                                <div class="bg-gradient-to-r from-[#2563eb] to-[#174ea6] rounded-xl p-8 text-white text-center">
                                    <h2 class="text-3xl font-bold mb-4">Pronto para Candidatar-se?</h2>
                                    <p class="text-xl text-[#FFD700] mb-8">Inicie sua candidatura online agora mesmo</p>
                                    <div class="flex flex-wrap justify-center gap-4">
                                        <button id="openFormBtn" class="bg-white text-[#2563eb] border border-[#2563eb] px-8 py-3 rounded-lg font-semibold hover:bg-[#e0e7ff] transition-colors">Candidatar-se (Online/Presencial)</button>
                                        <a href="/contactos" class="bg-[#F05A28] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#c94a1f] transition-colors">Fale Conosco</a>
                                    </div>
                                </div>

                                <!-- Modal permanece para funcionalidade JS -->
                                <div id="formModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                                    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-8 relative max-h-[90vh] overflow-auto">
                                        <button id="closeFormBtn" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
                                        <h2 class="text-2xl font-bold mb-6 text-[#2563eb]">Formulário de Candidatura</h2>
                                        <form class="space-y-4 text-left">
                                            @csrf
                                            <!-- campos mantidos -->
                                            <div>
                                                <label class="block font-semibold mb-1">Nome Completo</label>
                                                <input type="text" class="w-full border rounded px-3 py-2" required>
                                            </div>
                                            <div>
                                                <label class="block font-semibold mb-1">Email</label>
                                                <input type="email" class="w-full border rounded px-3 py-2" required>
                                            </div>
                                            <div>
                                                <label class="block font-semibold mb-1">Telefone</label>
                                                <input type="tel" class="w-full border rounded px-3 py-2" required>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="bg-[#2563eb] text-white px-6 py-2 rounded font-semibold hover:bg-[#174ea6]">Enviar Candidatura</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

@endsection

