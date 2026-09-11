@extends('layouts.site')

@section('title', 'Alumni — ISP-Bié')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-16">

@include('partials.page-hero', [
    'title'      => 'Alumni ISP-Bié',
    'subtitle'   => 'Rede de ex-estudantes, histórias de sucesso e oportunidades.',
    'breadcrumb' => 'Alumni',
    'gradient'   => 'from-[#1e3a5f] to-[#2563eb]',
    'ctaUrl'     => '#formulario',
    'ctaLabel'   => 'Juntar-me à Rede',
])

{{-- Intro strip --}}
<div class="mb-8 flex items-center gap-3">
    <span class="inline-block w-8 h-0.5 bg-[#F05A28]"></span>
    <p class="text-sm font-semibold text-gray-400 uppercase tracking-widest">Comunidade Alumni</p>
</div>

{{-- Filtros e indicadores --}}
<section class="mb-12">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 sm:p-6">
        <div class="flex items-start justify-between gap-4 flex-wrap mb-5">
            <div>
                <h2 class="text-lg font-bold text-[#1e3a5f]">Consultar Alumni</h2>
                <p class="text-sm text-gray-500 mt-1">Filtre os dados públicos por situação profissional, curso, ano ou país.</p>
            </div>
            <a href="{{ route('alumni') }}" class="text-sm font-semibold text-[#2563eb] hover:underline">Limpar filtros</a>
        </div>
        <form method="GET" action="{{ route('alumni') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <div>
                <label for="estado" class="block text-xs font-semibold text-gray-600 mb-1">Situação profissional</label>
                <select id="estado" name="estado" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm">
                    <option value="todos" @selected(($filters['estado'] ?? 'todos') === 'todos')>Todos</option>
                    <option value="trabalha" @selected(($filters['estado'] ?? '') === 'trabalha')>Trabalha</option>
                    <option value="nao_trabalha" @selected(($filters['estado'] ?? '') === 'nao_trabalha')>Não trabalha</option>
                </select>
            </div>
            <div>
                <label for="curso-filtro" class="block text-xs font-semibold text-gray-600 mb-1">Curso</label>
                <select id="curso-filtro" name="curso" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm">
                    <option value="">Todos os cursos</option>
                    @foreach($filterOptions['cursos'] as $curso)
                        <option value="{{ $curso }}" @selected(($filters['curso'] ?? '') === $curso)>{{ $curso }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="ano-filtro" class="block text-xs font-semibold text-gray-600 mb-1">Ano de conclusão</label>
                <select id="ano-filtro" name="ano" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm">
                    <option value="">Todos os anos</option>
                    @foreach($filterOptions['anos'] as $ano)
                        <option value="{{ $ano }}" @selected((string) ($filters['ano'] ?? '') === (string) $ano)>{{ $ano }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="pais-filtro" class="block text-xs font-semibold text-gray-600 mb-1">País de trabalho</label>
                <select id="pais-filtro" name="pais" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm">
                    <option value="">Todos os países</option>
                    @foreach($filterOptions['paises'] as $pais)
                        <option value="{{ $pais }}" @selected(($filters['pais'] ?? '') === $pais)>{{ $pais }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="pesquisa" class="block text-xs font-semibold text-gray-600 mb-1">Pesquisar</label>
                <input id="pesquisa" name="pesquisa" value="{{ $filters['pesquisa'] ?? '' }}" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm" placeholder="Nome, empresa ou cargo">
            </div>
            <div class="sm:col-span-2 lg:col-span-5">
                <button type="submit" class="bg-[#1e3a5f] hover:bg-[#2563eb] text-white font-bold rounded-xl px-6 py-2.5 text-sm transition-colors">Aplicar filtros</button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 mt-5">
        @foreach([
            ['label' => 'Resultados', 'value' => $stats['total'], 'color' => 'text-[#1e3a5f]'],
            ['label' => 'Trabalham', 'value' => $stats['working'], 'color' => 'text-[#2563eb]'],
            ['label' => 'Não trabalham', 'value' => $stats['notWorking'], 'color' => 'text-[#F05A28]'],
            ['label' => 'Empregabilidade', 'value' => $stats['employability'].'%', 'color' => 'text-[#1e3a5f]'],
            ['label' => 'Países', 'value' => $stats['countries'], 'color' => 'text-[#2563eb]'],
            ['label' => 'Empresas', 'value' => $stats['companies'], 'color' => 'text-[#F05A28]'],
        ] as $stat)
            <div class="bg-white rounded-xl border border-gray-100 p-4 text-center shadow-sm">
                <div class="text-2xl font-bold {{ $stat['color'] }}">{{ $stat['value'] }}</div>
                <div class="text-[10px] uppercase tracking-wide text-gray-400 mt-1">{{ $stat['label'] }}</div>
            </div>
        @endforeach
    </div>

    @if($stats['total'])
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
            <div class="bg-white rounded-xl border border-gray-100 p-5">
                <h3 class="text-sm font-bold text-[#1e3a5f] mb-3">Alumni por curso</h3>
                <div class="space-y-2">
                    @foreach($stats['byCourse'] as $curso => $total)
                        <div class="flex justify-between text-sm"><span class="text-gray-600">{{ $curso ?: 'Não informado' }}</span><strong class="text-[#1e3a5f]">{{ $total }}</strong></div>
                    @endforeach
                </div>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 p-5">
                <h3 class="text-sm font-bold text-[#1e3a5f] mb-3">Países de trabalho</h3>
                <div class="space-y-2">
                    @forelse($stats['byCountry'] as $pais => $total)
                        <div class="flex justify-between text-sm"><span class="text-gray-600">{{ $pais }}</span><strong class="text-[#1e3a5f]">{{ $total }}</strong></div>
                    @empty
                        <p class="text-sm text-gray-400">Ainda não há países informados.</p>
                    @endforelse
                </div>
            </div>
        </div>
    @endif
</section>

{{-- Histórico Alumni --}}
<section class="mb-12">
    <h2 class="text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-6 flex items-center gap-2">
        <span class="inline-block w-6 h-0.5 bg-[#F05A28]"></span> Histórico Alumni
    </h2>
    <p class="text-sm text-gray-500 mb-6">Conheça as histórias de sucesso, conquistas e trajetórias inspiradoras dos ex-estudantes do ISP-Bié.</p>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($alumni as $alumnus)
          <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow flex items-center gap-5">
            <div class="flex-shrink-0 w-14 h-14 rounded-full bg-[#1e3a5f] flex items-center justify-center text-white text-lg font-bold uppercase">
              {{ mb_substr($alumnus->nome ?? 'A', 0, 1) }}
            </div>
            <div class="min-w-0">
              <p class="font-bold text-[#1e3a5f] uppercase">{{ $alumnus->nome }}</p>
              <p class="text-xs text-gray-400 font-semibold mb-1">Alumni #{{ $alumnus->id }}</p>
              <p class="text-sm text-gray-400 mb-2">
                {{ $alumnus->curso }}@if($alumnus->ano) &bull; Turma {{ $alumnus->ano }}@endif
              </p>
              @php
                $satisfacao = trim((string) $alumnus->satisfacao);
                $hasDepoimento = $satisfacao && !preg_match('/^\d+$/', $satisfacao);
              @endphp
              @if($hasDepoimento)
                <p class="text-sm text-gray-600 italic">"{{ Str::limit($satisfacao, 200) }}"
                  @if(Str::length($satisfacao) > 200)
                    <a href="{{ route('alumni.show', $alumnus->id) }}" class="ml-1 text-[#2563eb] font-semibold hover:text-[#1d4ed8] text-xs">Ler mais</a>
                  @endif
                </p>
              @endif
            </div>
          </div>
        @empty
          <div class="bg-white rounded-2xl border border-gray-100 p-6 text-center text-gray-400 col-span-2 text-sm">
            Nenhum histórico de alumni publicado ainda.
          </div>
        @endforelse
    </div>
</section>
{{-- Benefícios --}}
<section class="mb-12">
    <h2 class="text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-6 flex items-center gap-2">
        <span class="inline-block w-6 h-0.5 bg-[#F05A28]"></span> Benefícios da Comunidade Alumni
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
        @foreach([
            ['icon'=>'🤝', 'title'=>'Networking',        'desc'=>'Conecte-se com ex-estudantes e amplie a sua rede profissional em Angola e no mundo.'],
            ['icon'=>'💼', 'title'=>'Oportunidades',     'desc'=>'Acesse vagas exclusivas de emprego e estágio divulgadas na rede alumni.'],
            ['icon'=>'🎓', 'title'=>'Eventos',           'desc'=>'Participe de eventos, reencontros e conferências exclusivas para alumni.'],
            ['icon'=>'📚', 'title'=>'Formação Contínua', 'desc'=>'Descontos em cursos de pós-graduação e formações especializadas.'],
        ] as $benefit)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="text-4xl mb-3">{{ $benefit['icon'] }}</div>
            <h3 class="font-bold text-[#1e3a5f] text-sm mb-2">{{ $benefit['title'] }}</h3>
            <p class="text-xs text-gray-500 leading-relaxed">{{ $benefit['desc'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Estatísticas Alumni --}}
    @php
        $alumni_count = $stats['total'];
        $employability = $stats['employability'];
        $countries = $stats['countries'];
        $companies = $stats['companies'];
    @endphp
    <div class="rounded-2xl p-8 text-white" style="background:linear-gradient(135deg,#1e3a5f,#2563eb);">
        <h3 class="text-base font-bold mb-6 uppercase tracking-widest text-center opacity-90">Alumni em Números</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div><div class="text-4xl font-bold mb-1" data-counter data-target="{{ $alumni_count }}" data-duration="2000">{{ $alumni_count }}</div><div class="text-xs text-white/70 uppercase tracking-wide">Alumni Formados</div></div>
            <div><div class="text-4xl font-bold mb-1" data-counter data-target="{{ $employability }}" data-suffix="%" data-duration="2000">{{ $employability }}%</div><div class="text-xs text-white/70 uppercase tracking-wide">Empregabilidade</div></div>
            <div><div class="text-4xl font-bold mb-1" data-counter data-target="{{ $countries }}" data-duration="2000">{{ $countries }}</div><div class="text-xs text-white/70 uppercase tracking-wide">Países onde trabalham</div></div>
            <div><div class="text-4xl font-bold mb-1" data-counter data-target="{{ $companies }}" data-duration="2000">{{ $companies }}</div><div class="text-xs text-white/70 uppercase tracking-wide">Empresas fundadas</div></div>
        </div>
    </div>
</section>

{{-- CTA Portal Alumni --}}
<section class="mb-10">
    <div class="rounded-2xl overflow-hidden" style="background:linear-gradient(135deg,#1e3a5f,#2563eb);">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-6 px-8 py-8">
            <div class="text-white">
                <p class="text-xs font-bold uppercase tracking-widest text-white/60 mb-1">Exclusivo para ex-estudantes</p>
                <h3 class="text-xl font-bold mb-1">Aceda ao Portal Alumni</h3>
                <p class="text-sm text-white/70">Notícias exclusivas, directório de alumni, documentos e muito mais.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 shrink-0">
                @auth
                    @if(Auth::user()->hasRole('alumni') && Auth::user()->aprovado)
                        <a href="{{ route('portal.dashboard') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm text-[#1e3a5f] bg-white hover:bg-orange-50 transition-colors whitespace-nowrap">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Entrar no Portal
                        </a>
                    @elseif(Auth::user()->hasRole('alumni'))
                        <span class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm text-white/60 bg-white/10 whitespace-nowrap cursor-not-allowed">
                            A aguardar aprovação
                        </span>
                    @else
                        <a href="{{ route('portal.register') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm text-[#1e3a5f] bg-white hover:bg-orange-50 transition-colors whitespace-nowrap">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                            Registar no Portal
                        </a>
                    @endif
                @else
                    <a href="{{ route('portal.login') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm text-[#1e3a5f] bg-white hover:bg-orange-50 transition-colors whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        Entrar
                    </a>
                    <a href="{{ route('portal.register') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm text-white border border-white/40 hover:bg-white/10 transition-colors whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        Registar
                    </a>
                @endauth
            </div>
        </div>
    </div>
</section>

{{-- Formulário de registo --}}
<section id="formulario" class="mt-4">
    <h2 class="text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-6 flex items-center gap-2">
        <span class="inline-block w-6 h-0.5 bg-[#F05A28]"></span> Faça Parte da Rede Alumni
    </h2>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 max-w-2xl">
    @if(session('success'))
      <div class="mb-6 p-4 rounded-xl bg-green-50 text-green-800 border border-green-200 text-sm">
        {{ session('success') }}
      </div>
    @endif
    @if($errors->any())
      <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-800 border border-red-200 text-sm">
        <ul class="list-disc list-inside space-y-1">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <h3 class="text-base font-bold text-[#1e3a5f] mb-2">Formulário de Alumni</h3>
    <p class="text-sm text-gray-500 mb-6">Este formulário é exclusivo para ex-estudantes que já concluíram o curso. Se ainda está a estudar, aguarde até concluir os estudos para se cadastrar como Alumni.</p>
    <form method="POST" action="{{ route('alumni.store') }}" class="space-y-5">
      @csrf
      <div x-data="{ trabalha: '' }">
        <div class="space-y-5">
          <div>
            <label for="nome" class="block text-sm font-semibold text-gray-700 mb-1">Nome completo <span class="text-red-500">*</span></label>
            <input type="text" id="nome" name="nome" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition" placeholder="Digite o seu nome completo">
          </div>
          <div>
            <label for="curso" class="block text-sm font-semibold text-gray-700 mb-1">Curso que frequentou <span class="text-red-500">*</span></label>
            <select id="curso" name="curso" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition">
              <option value="">Selecione o curso</option>
              <option value="contabilidade">Contabilidade e Administração</option>
              <option value="comunicacao">Comunicação Social</option>
              <option value="engenharia-informatica">Engenharia Informática</option>
              <option value="enfermagem">Enfermagem Geral</option>
              <option value="engenharia-hidricos">Engenharia em Recursos Hídricos</option>
              <option value="psicologia">Psicologia</option>
            </select>
          </div>
          <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
              <label for="ano" class="block text-sm font-semibold text-gray-700 mb-1">Ano de conclusão <span class="text-red-500">*</span></label>
              <p class="text-xs text-gray-500 mb-2">Informe o ano em que concluiu os estudos. Não é permitido indicar um ano futuro.</p>
              <input type="number" id="ano" name="ano" min="1950" max="{{ date('Y') }}" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition" placeholder="Ano">
            </div>
            <div class="flex-1">
              <label for="contacto" class="block text-sm font-semibold text-gray-700 mb-1">Contacto telefónico <span class="text-red-500">*</span></label>
              <input type="text" id="contacto" name="contacto" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition" placeholder="(+244) 9XX XXX XXX">
            </div>
          </div>
          <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Endereço de email <span class="text-red-500">*</span></label>
            <input type="email" id="email" name="email" required value="{{ old('email') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition" placeholder="seuemail@exemplo.com">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Trabalha atualmente? <span class="text-red-500">*</span></label>
            <div class="flex gap-6">
              <label class="inline-flex items-center gap-2 text-sm cursor-pointer">
                <input type="radio" name="trabalha" value="sim" x-model="trabalha" required class="form-radio text-[#2563eb]">
                <span>Sim</span>
              </label>
              <label class="inline-flex items-center gap-2 text-sm cursor-pointer">
                <input type="radio" name="trabalha" value="nao" x-model="trabalha" required class="form-radio text-[#2563eb]">
                <span>Não</span>
              </label>
            </div>
          </div>
          <template x-if="trabalha === 'sim'">
            <div class="space-y-4">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label for="empresa" class="block text-sm font-semibold text-gray-700 mb-1">Onde trabalha <span class="text-red-500">*</span></label>
                  <input type="text" id="empresa" name="empresa" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition" placeholder="Nome da empresa ou instituição">
                </div>
                <div>
                  <label for="pais" class="block text-sm font-semibold text-gray-700 mb-1">País onde trabalha <span class="text-red-500">*</span></label>
                  <input type="text" id="pais" name="pais" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition" placeholder="Ex: Angola, Portugal...">
                </div>
              </div>
              <div>
                <label for="cargo" class="block text-sm font-semibold text-gray-700 mb-1">Cargo atual <span class="text-red-500">*</span></label>
                <input type="text" id="cargo" name="cargo" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition" placeholder="O seu cargo atual">
              </div>
              <div>
                <label for="satisfacao" class="block text-sm font-semibold text-gray-700 mb-1">Partilhe a sua experiência profissional <span class="text-red-500">*</span></label>
                <textarea id="satisfacao" name="satisfacao" rows="4" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#2563eb] focus:border-transparent focus:outline-none transition" placeholder="Conte como tem sido a sua experiência profissional e o nível de satisfação"></textarea>
              </div>
            </div>
          </template>
          <div class="pt-2">
            <button type="submit" class="w-full bg-[#1e3a5f] hover:bg-[#2563eb] text-white font-bold py-3 px-6 rounded-xl transition-colors duration-200 text-sm">
              Cadastrar-me na Rede Alumni
            </button>
          </div>
        </div>
      </div>
    </form>
    </div>
</section>

</div>
@endsection
