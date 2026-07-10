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
                                    <h2 class="text-2xl font-bold text-[#2563eb] mb-1">Ficha de Inscrição — Exame de Acesso 2026/2027</h2>
                                    <p class="text-gray-500 text-sm mb-6">Todos os campos são obrigatórios, excepto o Telefone 2 e a Instituição Laboral (apenas se não trabalhar).</p>

                                    {{-- Banner de erros de validação --}}
                                    @if($errors->any())
                                    <div class="bg-red-50 border border-red-200 rounded-xl p-5 mb-6 flex items-start gap-3">
                                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <div>
                                            <p class="font-semibold text-red-700 mb-2">Por favor corrija os seguintes erros antes de submeter:</p>
                                            <ul class="space-y-1">
                                                @foreach($errors->all() as $erro)
                                                    <li class="text-sm text-red-600 flex items-start gap-1.5">
                                                        <span class="mt-0.5 text-red-400">›</span> {{ $erro }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    @endif

                                    @php $inp = 'w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition'; @endphp

                                    <form method="POST" action="{{ route('candidaturas.store') }}" class="space-y-6" novalidate>
                                        @csrf

                                        {{-- 1. Nome --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nome Completo <span class="text-red-500">*</span></label>
                                            <input type="text" name="nome" value="{{ old('nome') }}" required maxlength="255" class="{{ $inp }} @error('nome') border-red-400 @enderror">
                                            @error('nome')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                        </div>

                                        {{-- 2. Filiação --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Filiação <span class="text-gray-400 font-normal text-xs">(opcional)</span></label>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-xs text-gray-500 mb-1">Nome do Pai</label>
                                                    <input type="text" name="filiacao_pai" value="{{ old('filiacao_pai') }}" maxlength="255" class="{{ $inp }} @error('filiacao_pai') border-red-400 @enderror">
                                                    @error('filiacao_pai')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                                <div>
                                                    <label class="block text-xs text-gray-500 mb-1">Nome da Mãe</label>
                                                    <input type="text" name="filiacao_mae" value="{{ old('filiacao_mae') }}" maxlength="255" class="{{ $inp }} @error('filiacao_mae') border-red-400 @enderror">
                                                    @error('filiacao_mae')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                            </div>
                                        </div>

                                        {{-- 3. Data de Nascimento --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Data de Nascimento <span class="text-red-500">*</span></label>
                                            <input type="date" name="data_nascimento"
                                                   value="{{ old('data_nascimento') }}"
                                                   required
                                                   max="{{ now()->subYears(17)->format('Y-m-d') }}"
                                                   class="{{ $inp }} @error('data_nascimento') border-red-400 @enderror" style="max-width:220px;">
                                            <p class="text-xs text-gray-400 mt-1">Idade mínima: 17 anos</p>
                                            @error('data_nascimento')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                        </div>

                                        {{-- 4. Naturalidade --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Naturalidade <span class="text-red-500">*</span></label>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-xs text-gray-500 mb-1">Província</label>
                                                    <select id="select-provincia" name="naturalidade_provincia"
                                                            data-old="{{ old('naturalidade_provincia') }}"
                                                            required class="{{ $inp }} @error('naturalidade_provincia') border-red-400 @enderror">
                                                        <option value="">Seleccione a província</option>
                                                    </select>
                                                    @error('naturalidade_provincia')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                                <div>
                                                    <label class="block text-xs text-gray-500 mb-1">Município</label>
                                                    <select id="select-municipio" name="naturalidade_municipio"
                                                            data-old="{{ old('naturalidade_municipio') }}"
                                                            required class="{{ $inp }} @error('naturalidade_municipio') border-red-400 @enderror">
                                                        <option value="">Seleccione primeiro a província</option>
                                                    </select>
                                                    @error('naturalidade_municipio')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                            </div>
                                        </div>

                                        {{-- 5. Bilhete de Identidade / Passaporte --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Bilhete de Identidade / Passaporte <span class="text-red-500">*</span></label>
                                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                                <div>
                                                    <label class="block text-xs text-gray-500 mb-1">Número</label>
                                                    <input type="text" name="bi" value="{{ old('bi') }}" required maxlength="20" class="{{ $inp }} @error('bi') border-red-400 @enderror">
                                                    @error('bi')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                                <div>
                                                    <label class="block text-xs text-gray-500 mb-1">Emitido em (local)</label>
                                                    <input type="text" name="bi_emitido_em" value="{{ old('bi_emitido_em') }}" required maxlength="255" class="{{ $inp }} @error('bi_emitido_em') border-red-400 @enderror">
                                                    @error('bi_emitido_em')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                                <div>
                                                    <label class="block text-xs text-gray-500 mb-1">Data de emissão</label>
                                                    <input type="date" name="bi_data_emissao" value="{{ old('bi_data_emissao') }}" required class="{{ $inp }} @error('bi_data_emissao') border-red-400 @enderror">
                                                    @error('bi_data_emissao')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                            </div>
                                        </div>

                                        {{-- 6. Sexo + Estado Civil --}}
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Sexo <span class="text-red-500">*</span></label>
                                                <div class="flex gap-6">
                                                    <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                                        <input type="radio" name="sexo" value="masculino" {{ old('sexo') === 'masculino' ? 'checked' : '' }} required class="accent-[#2563eb]"> Masculino
                                                    </label>
                                                    <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                                        <input type="radio" name="sexo" value="feminino" {{ old('sexo') === 'feminino' ? 'checked' : '' }} class="accent-[#2563eb]"> Feminino
                                                    </label>
                                                </div>
                                                @error('sexo')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Estado Civil <span class="text-red-500">*</span></label>
                                                <input type="text" name="estado_civil" value="{{ old('estado_civil') }}" required maxlength="100" placeholder="Ex: Solteiro(a), Casado(a)..." class="{{ $inp }} @error('estado_civil') border-red-400 @enderror">
                                                @error('estado_civil')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                            </div>
                                        </div>

                                        {{-- 7. Necessidade de Educação Especial --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Necessidade de Educação Especial <span class="text-red-500">*</span></label>
                                            <input type="text" name="necessidade_especial" value="{{ old('necessidade_especial') }}" required maxlength="255" placeholder="Escreva 'Nenhuma' se não aplicável" class="{{ $inp }} @error('necessidade_especial') border-red-400 @enderror">
                                            @error('necessidade_especial')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                        </div>

                                        {{-- 8. Residência --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Residência <span class="text-red-500">*</span></label>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-xs text-gray-500 mb-1">Município</label>
                                                    <input type="text" name="residencia_municipio" value="{{ old('residencia_municipio') }}" required maxlength="255" class="{{ $inp }} @error('residencia_municipio') border-red-400 @enderror">
                                                    @error('residencia_municipio')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                                <div>
                                                    <label class="block text-xs text-gray-500 mb-1">Rua / Bairro</label>
                                                    <input type="text" name="residencia_bairro" value="{{ old('residencia_bairro') }}" required maxlength="255" class="{{ $inp }} @error('residencia_bairro') border-red-400 @enderror">
                                                    @error('residencia_bairro')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                            </div>
                                        </div>

                                        {{-- 9. Telefones + Email --}}
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Telefone 1 <span class="text-red-500">*</span></label>
                                                <input type="tel" name="telefone" value="{{ old('telefone') }}" required maxlength="50" class="{{ $inp }} @error('telefone') border-red-400 @enderror">
                                                @error('telefone')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Telefone 2 <span class="text-gray-400 font-normal">(opcional)</span></label>
                                                <input type="tel" name="telefone2" value="{{ old('telefone2') }}" maxlength="50" class="{{ $inp }}">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                                <input type="email" name="email" value="{{ old('email') }}" required maxlength="255" class="{{ $inp }} @error('email') border-red-400 @enderror">
                                                @error('email')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                            </div>
                                        </div>

                                        {{-- 10. Habilitações + Escola --}}
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Habilitações Literárias <span class="text-red-500">*</span></label>
                                                <input type="text" name="habilitacoes" value="{{ old('habilitacoes') }}" required maxlength="100" placeholder="Ex: 12ª Classe" class="{{ $inp }} @error('habilitacoes') border-red-400 @enderror">
                                                @error('habilitacoes')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                            </div>
                                            <div class="sm:col-span-2">
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Escola de Proveniência <span class="text-red-500">*</span></label>
                                                <input type="text" name="escola_origem" value="{{ old('escola_origem') }}" required maxlength="255" class="{{ $inp }} @error('escola_origem') border-red-400 @enderror">
                                                @error('escola_origem')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                            </div>
                                        </div>

                                        {{-- 10b. Perfil de Acesso --}}
                                        @php $oldPerfil = old('perfil', ''); @endphp
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Perfil do Curso de Proveniência <span class="text-red-500">*</span></label>
                                            <select name="perfil" id="perfil-select"
                                                    class="{{ $inp }} @error('perfil') border-red-400 @enderror">
                                                <option value="">— Seleccione o perfil do seu curso de origem —</option>
                                                @foreach(\App\Models\Candidatura::todosOsPerfis() as $p)
                                                    <option value="{{ $p }}" {{ $oldPerfil === $p ? 'selected' : '' }}>{{ $p }}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-xs text-gray-400 mt-1">Os cursos disponíveis serão filtrados automaticamente com base no seu perfil.</p>
                                            @error('perfil')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                        </div>

                                        {{-- 11. Ano de Conclusão --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Ano de Conclusão do Ensino Médio <span class="text-red-500">*</span></label>
                                            <input type="number" name="ano_conclusao" value="{{ old('ano_conclusao') }}" required min="1990" max="{{ date('Y') }}"
                                                   class="{{ $inp }} @error('ano_conclusao') border-red-400 @enderror" style="max-width:160px;">
                                            @error('ano_conclusao')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                        </div>

                                        {{-- 12. Estado Financeiro --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">Estado Financeiro da Família <span class="text-red-500">*</span></label>
                                            <div class="flex gap-6">
                                                @foreach(['maximo' => 'Máximo', 'medio' => 'Médio', 'minimo' => 'Mínimo'] as $val => $label)
                                                <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                                    <input type="radio" name="estado_financeiro" value="{{ $val }}" {{ old('estado_financeiro') === $val ? 'checked' : '' }} required class="accent-[#2563eb]"> {{ $label }}
                                                </label>
                                                @endforeach
                                            </div>
                                            @error('estado_financeiro')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                        </div>

                                        {{-- 13. Trabalhador --}}
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">Trabalhador <span class="text-red-500">*</span></label>
                                            <div class="flex gap-6 items-center flex-wrap">
                                                <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                                    <input type="radio" name="trabalhador" value="sim" {{ old('trabalhador') === 'sim' ? 'checked' : '' }} required class="accent-[#2563eb]"
                                                           onchange="document.getElementById('inst-laboral').classList.remove('hidden')"> Sim
                                                </label>
                                                <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                                    <input type="radio" name="trabalhador" value="nao" {{ old('trabalhador') === 'nao' ? 'checked' : '' }} class="accent-[#2563eb]"
                                                           onchange="document.getElementById('inst-laboral').classList.add('hidden')"> Não
                                                </label>
                                                <div id="inst-laboral" class="{{ old('trabalhador') === 'sim' ? '' : 'hidden' }} flex-1 min-w-[220px]">
                                                    <input type="text" name="instituicao_laboral" value="{{ old('instituicao_laboral') }}" maxlength="255"
                                                           placeholder="Nome da Instituição Laboral" class="{{ $inp }} @error('instituicao_laboral') border-red-400 @enderror">
                                                    @error('instituicao_laboral')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                                </div>
                                            </div>
                                            @error('trabalhador')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                        </div>

                                        {{-- 14. Curso + Período --}}
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-1">Curso a Inscrever <span class="text-red-500">*</span></label>
                                                @php
                                                $oldCurso = old('curso', '');
                                                $oldPerfilV = old('perfil', '');
                                                @endphp
                                                <select name="curso" id="curso-select" required class="{{ $inp }} @error('curso') border-red-400 @enderror">
                                                    <option value="">— Seleccione primeiro o seu perfil acima —</option>
                                                    @foreach(\App\Models\Candidatura::$cursos as $c)
                                                        @php
                                                        $perfisC = \App\Models\Candidatura::$perfisCurso[$c] ?? [];
                                                        $elegivel = empty($perfisC) || !$oldPerfilV || in_array($oldPerfilV, $perfisC);
                                                        @endphp
                                                        @if($elegivel)
                                                            <option value="{{ $c }}" {{ $oldCurso === $c ? 'selected' : '' }}>{{ $c }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('curso')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold text-gray-700 mb-2">Período <span class="text-red-500">*</span></label>
                                                <div class="flex gap-6 mt-1">
                                                    <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                                        <input type="radio" name="periodo" value="regular" {{ old('periodo') === 'regular' ? 'checked' : '' }} required class="accent-[#2563eb]"> Regular
                                                    </label>
                                                    <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                                        <input type="radio" name="periodo" value="pos-laboral" {{ old('periodo') === 'pos-laboral' ? 'checked' : '' }} class="accent-[#2563eb]"> Pós-laboral
                                                    </label>
                                                </div>
                                                @error('periodo')<p style="font-size:0.78rem;color:#dc2626;margin-top:5px;font-weight:400;">{{ $message }}</p>@enderror
                                            </div>
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
@push('scripts')
<script src="{{ asset('js/provincias-angola.js') }}"></script>
<script>
(function() {
    var perfisCurso = @json(\App\Models\Candidatura::$perfisCurso);
    var allCursos   = @json(\App\Models\Candidatura::$cursos);
    var oldCurso    = @json(old('curso', ''));

    // Mapa inverso: perfil → [cursos elegíveis]
    var cursoPorPerfil = {};
    for (var c in perfisCurso) {
        perfisCurso[c].forEach(function(p) {
            if (!cursoPorPerfil[p]) cursoPorPerfil[p] = [];
            cursoPorPerfil[p].push(c);
        });
    }
    // Cursos sem restrição de perfil (sempre elegíveis)
    var cursosLivres = allCursos.filter(function(c) {
        return !perfisCurso[c] || perfisCurso[c].length === 0;
    });

    function updateCursos() {
        var perfilEl = document.getElementById('perfil-select');
        var cursoEl  = document.getElementById('curso-select');
        if (!perfilEl || !cursoEl) return;
        var perfil  = perfilEl.value;
        var current = cursoEl.value;
        var eligible = cursosLivres.slice();
        if (perfil) {
            (cursoPorPerfil[perfil] || []).forEach(function(c) {
                if (eligible.indexOf(c) === -1) eligible.push(c);
            });
        } else {
            allCursos.forEach(function(c) { if (eligible.indexOf(c) === -1) eligible.push(c); });
        }
        cursoEl.innerHTML = '';
        var ph = document.createElement('option');
        ph.value = '';
        ph.textContent = perfil ? '— Seleccione o curso —' : '— Seleccione primeiro o seu perfil acima —';
        cursoEl.appendChild(ph);
        allCursos.forEach(function(c) {
            if (eligible.indexOf(c) !== -1) {
                var o = document.createElement('option');
                o.value = c; o.textContent = c;
                if (c === (current || oldCurso)) o.selected = true;
                cursoEl.appendChild(o);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        var perfilEl = document.getElementById('perfil-select');
        if (perfilEl) { perfilEl.addEventListener('change', updateCursos); updateCursos(); }
    });
})();
</script>
@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var el = document.getElementById('formulario-candidatura');
        if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
</script>
@endif
@endpush
@endsection

