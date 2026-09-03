@extends('layouts.site')


@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-10">
@include('partials.page-hero', [
    'title'      => 'Candidaturas',
    'subtitle'   => 'Candidatura e ingresso no ISP-Bié — processo, requisitos e etapas.',
    'breadcrumb' => 'Candidaturas',
])
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                    <div class="lg:col-span-3">
                        <div class="bg-white border-l-4 border-[#2563eb] p-4 sm:p-8 shadow-lg rounded-lg">
                            <div class="prose max-w-none text-gray-700 leading-relaxed space-y-6">
                                <div class="mb-6">
                                    <div class="bg-red-50 border-l-4 border-red-500 p-4 sm:p-6 mb-8">
                                        <div class="flex items-start gap-3">
                                            <svg class="w-6 h-6 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>
                                            </svg>
                                            <div>
                                                <h3 class="font-bold text-red-700">Inscrições Encerradas — Exames de Acesso 2026/2027</h3>
                                                <p class="text-red-600">As inscrições para o ano lectivo 2026/2027 estão encerradas. Não é possível submeter novas candidaturas.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <h2 class="text-2xl sm:text-3xl font-bold text-[#2563eb] mb-6 sm:mb-8">Processo de Candidatura</h2>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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
                                            <h3 class="text-base sm:text-lg font-semibold text-[#2563eb] mb-2 whitespace-normal break-words">Impressão do comprovativo de inscrição</h3>
                                            <p class="text-sm text-gray-600">Guarde o comprovativo para apresentação no dia do exame</p>
                                        </div>

                                        <div class="bg-white p-6 rounded-lg shadow-md text-center interactive-card min-h-[160px]">
                                            <div class="w-16 h-16 bg-[#e0e7ff] rounded-full flex items-center justify-center mb-4 mx-auto">
                                                <span class="text-2xl font-bold text-[#2563eb]">5</span>
                                            </div>
                                            <h3 class="text-base sm:text-lg font-semibold text-[#2563eb] mb-2 whitespace-normal break-words">Exame de Acesso</h3>
                                            <p class="text-sm text-gray-600">Realize o exame conforme o calendário definido</p>
                                        </div>

                                        <div class="bg-white p-6 rounded-lg shadow-md text-center interactive-card min-h-[160px]">
                                            <div class="w-16 h-16 bg-[#e0e7ff] rounded-full flex items-center justify-center mb-4 mx-auto">
                                                <span class="text-2xl font-bold text-[#2563eb]">6</span>
                                            </div>
                                            <h3 class="text-base sm:text-lg font-semibold text-[#2563eb] mb-2 whitespace-normal break-words">Resultado</h3>
                                            <p class="text-sm text-gray-600">Aguarde a divulgação dos resultados</p>
                                        </div>
                                    </div>
                                </div>

                                <h2 class="text-2xl sm:text-3xl font-bold text-[#2563eb] mb-6 sm:mb-8">Documentos Necessários</h2>
                                <div class="bg-white p-4 sm:p-8 rounded-lg shadow-md">
                                    <ul class="space-y-4">
                                        <li class="flex items-start">
                                            <svg class="w-6 h-6 text-[#0E8F81] mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                            </svg>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">Bilhete de Identidade</h3>
                                            </div>
                                        </li>

                                        <li class="flex items-start">
                                            <svg class="w-6 h-6 text-[#0E8F81] mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                            </svg>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">Fotocópia do certificado de conclusão do segundo ciclo</h3>
                                            </div>
                                        </li>

                                        <li class="flex items-start">
                                            <svg class="w-6 h-6 text-[#0E8F81] mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                            </svg>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">Pasta de processos</h3>
                                            </div>
                                        </li>

                                        <li class="flex items-start">
                                            <svg class="w-6 h-6 text-[#0E8F81] mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                            </svg>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">Ficha de inscrição devidamente preenchida</h3>
                                            </div>
                                        </li>

                                        <li class="flex items-start">
                                            <svg class="w-6 h-6 text-[#0E8F81] mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                            </svg>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">Comprovativo dos emolumentos de pagamento</h3>
                                                <p class="text-gray-600">(via RUP)</p>
                                            </div>
                                        </li>

                                        <li class="flex items-start">
                                            <svg class="w-6 h-6 text-[#0E8F81] mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                            </svg>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">Recibo emitido no acto da inscrição</h3>
                                                <p class="text-gray-600">(emitido em nome do candidato)</p>
                                            </div>
                                        </li>

                                        <li class="flex items-start">
                                            <svg class="w-6 h-6 text-[#0E8F81] mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                            </svg>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">Número de identificação do processo</h3>
                                                <p class="text-gray-600">(emitido no acto da inscrição)</p>
                                            </div>
                                        </li>

                                        <li class="flex items-start">
                                            <svg class="w-6 h-6 text-[#0E8F81] mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                            </svg>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">Declaração de conclusão (caso o certificado não esteja disponível)</h3>
                                                <p class="text-gray-600">Caso o certificado ainda não tenha sido emitido por razões alheias ao candidato, poderá inscrever-se com a declaração de conclusão do ensino médio.</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <h2 class="text-2xl sm:text-3xl font-bold text-[#2563eb] mb-6 sm:mb-8 text-center">Cursos Disponíveis</h2>
                                <div class="flex flex-wrap justify-center gap-8">
                                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow interactive-card w-full max-w-sm md:max-w-xs">
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Cursos de Graduação</h3>
                                        <p class="text-gray-600 mb-4">Conheça todos os cursos disponíveis no ISP-Bié</p>
                                        <div class="text-sm text-gray-500 mb-4">
                                            <span class="font-semibold">Vagas:</span> variavel
                                        </div>
                                        <a href="/cursos" class="text-[#0E8F81] hover:text-[#0a6b5c] font-medium">Ver todos os cursos →</a>
                                    </div>
                                </div>

                                <hr class="my-6">

                                {{-- Success message --}}
                                @if(session('candidatura_success'))
                                <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl p-5 mb-8 flex items-start gap-3">
                                    <svg class="w-6 h-6 flex-shrink-0 mt-0.5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <div>
                                        <p class="font-bold text-green-800 mb-1">Candidatura submetida com sucesso!</p>
                                        <p class="text-sm text-green-700">{{ session('candidatura_success') }}</p>
                                    </div>
                                </div>
                                @endif

                                {{-- Inscrições encerradas --}}

                                <div id="formulario-candidatura" class="rounded-2xl overflow-hidden shadow-xl border border-red-200">
                                    {{-- Cabeçalho vermelho --}}
                                    <div class="bg-red-600 px-6 py-8 sm:px-10 sm:py-12 text-center">
                                        <div class="flex justify-center mb-4">
                                            <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center">
                                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <h2 class="text-2xl sm:text-3xl font-black text-white mb-2">Inscrições Encerradas</h2>
                                        <p class="text-red-100 text-lg font-semibold">Exames de Acesso 2026/2027</p>
                                    </div>

                                    {{-- Corpo informativo --}}
                                    <div class="bg-white px-6 py-8 sm:px-10 sm:py-10 text-center">
                                        <p class="text-gray-700 text-base sm:text-lg leading-relaxed mb-6">
                                            O período de inscrições para os <strong>Exames de Acesso ao ano lectivo 2026/2027</strong>
                                            encontra-se <strong class="text-red-600">encerrado</strong>.
                                            Não é possível submeter novas candidaturas através deste formulário.
                                        </p>

                                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 sm:p-6 mb-6 text-left max-w-lg mx-auto">
                                            <h3 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                                                <svg class="w-5 h-5 text-[#2563eb]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"/></svg>
                                                Informações úteis
                                            </h3>
                                            <ul class="space-y-2 text-sm text-gray-600">
                                                <li class="flex items-start gap-2">
                                                    <span class="text-[#2563eb] font-bold mt-0.5">›</span>
                                                    Os resultados dos exames serão publicados no portal institucional.
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-[#2563eb] font-bold mt-0.5">›</span>
                                                    Para consultar o estado da sua candidatura, contacte a secretaria da instituição.
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <span class="text-[#2563eb] font-bold mt-0.5">›</span>
                                                    As inscrições para o próximo ano lectivo serão anunciadas oportunamente.
                                                </li>
                                            </ul>
                                        </div>

                                        <a href="{{ route('contactos') }}" class="inline-flex items-center gap-2 bg-[#2563eb] hover:bg-[#174ea6] text-white font-bold px-8 py-3 rounded-xl transition-colors text-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                            Contactar a Instituição
                                        </a>
                                    </div>
                                </div>

                                {{-- form removido: inscrições encerradas em Agosto 2026 --}}

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

</div>
@push('scripts')
<script src="{{ asset('js/provincias-angola.js') }}"></script>
<script src="{{ asset('js/perfil-curso.js') }}"></script>
<script src="{{ asset('js/categorias-especiais.js') }}"></script>
@endpush
@endsection
