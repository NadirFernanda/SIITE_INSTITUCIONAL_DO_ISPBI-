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
                                                <p class="text-gray-600">(no caso de inscrição presencial)</p>
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

                                <h2 class="text-3xl font-bold text-[#2563eb] mb-8 text-center">Cursos Disponíveis</h2>
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

                                {{-- Application form --}}
                                <div id="formulario-candidatura" class="bg-white border border-[#2563eb]/20 rounded-2xl shadow-lg p-8">
                                    <h2 class="text-2xl font-bold text-[#2563eb] mb-2">Formulário de Candidatura Online</h2>
                                    <p class="text-gray-500 text-sm mb-8">Preencha todos os campos obrigatórios (<span class="text-red-500">*</span>)</p>

                                    <form method="POST" action="{{ route('candidaturas.store') }}" class="space-y-5">
                                        @csrf

                                        {{-- Dados Pessoais --}}
                                        <p class="text-xs font-bold text-[#2563eb] uppercase tracking-wider mb-1 mt-4">Dados Pessoais</p>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Nome Completo <span class="text-red-500">*</span></label>
                                                <input type="text" name="nome" value="{{ old('nome') }}" required maxlength="255"
                                                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition @error('nome') border-red-400 @enderror">
                                                @error('nome')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">BI (Bilhete de Identidade)</label>
                                                <input type="text" name="bi" value="{{ old('bi') }}" maxlength="20"
                                                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition @error('bi') border-red-400 @enderror">
                                                @error('bi')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                                <input type="email" name="email" value="{{ old('email') }}" required maxlength="255"
                                                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition @error('email') border-red-400 @enderror">
                                                @error('email')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Telefone <span class="text-red-500">*</span></label>
                                                <input type="tel" name="telefone" value="{{ old('telefone') }}" required maxlength="50"
                                                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition @error('telefone') border-red-400 @enderror">
                                                @error('telefone')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Data de Nascimento</label>
                                                <input type="date" name="data_nascimento" value="{{ old('data_nascimento') }}"
                                                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition @error('data_nascimento') border-red-400 @enderror">
                                                @error('data_nascimento')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                                            </div>
                                        </div>

                                        {{-- Dados Académicos --}}
                                        <p class="text-xs font-bold text-[#2563eb] uppercase tracking-wider mb-1 mt-6">Dados Académicos</p>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Curso Pretendido <span class="text-red-500">*</span></label>
                                                <select name="curso" required
                                                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition @error('curso') border-red-400 @enderror">
                                                    <option value="">Seleccione um curso</option>
                                                    @foreach(\App\Models\Candidatura::$cursos as $curso)
                                                        <option value="{{ $curso }}" {{ old('curso') === $curso ? 'selected' : '' }}>{{ $curso }}</option>
                                                    @endforeach
                                                </select>
                                                @error('curso')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Escola de Origem</label>
                                                <input type="text" name="escola_origem" value="{{ old('escola_origem') }}" maxlength="255"
                                                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Ano de Conclusão do Ensino Médio</label>
                                                <input type="number" name="ano_conclusao" value="{{ old('ano_conclusao') }}" min="1990" max="{{ date('Y') }}" maxlength="4"
                                                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition @error('ano_conclusao') border-red-400 @enderror">
                                                @error('ano_conclusao')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                                            </div>
                                        </div>

                                        {{-- Observações --}}
                                        <div class="mt-2">
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Observações</label>
                                            <textarea name="observacoes" rows="4" maxlength="2000"
                                                      class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition resize-none"
                                                      placeholder="Informação adicional que considere relevante...">{{ old('observacoes') }}</textarea>
                                        </div>

                                        <div class="pt-2">
                                            <button type="submit"
                                                    class="w-full sm:w-auto bg-[#2563eb] hover:bg-[#174ea6] text-white font-bold px-10 py-3 rounded-xl transition-colors text-sm">
                                                Submeter Candidatura
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

</div>
@endsection

