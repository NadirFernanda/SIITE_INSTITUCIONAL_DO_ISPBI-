@extends('layouts.site')

@section('title', 'Parcerias Institucionais — ISP-Bié')
@section('meta_description', 'Conheça os parceiros nacionais e internacionais do Instituto Superior Politécnico do Bié e os instrumentos de cooperação indicados pelo Departamento Jurídico e de Intercâmbio.')

@push('head')
    <style>[x-cloak] { display: none !important; }</style>
@endpush

@php
    // Fonte dos instrumentos: quadro de acordos e protocolos do Departamento Jurídico e de Intercâmbio.
    // Não publicar datas ou prazos até à validação das inconsistências do quadro.
    // Os parceiros nacionais anteriores foram confirmados pelo ISP-Bié, sem tipo de acordo documentado neste quadro.
    $nacionais = [
        ['nome' => 'Instituto Superior Politécnico Ndunduma', 'local' => 'Bié, Angola', 'acordo' => 'Convénio de Colaboração Académica', 'sigla' => 'ISPN', 'logo' => 'images/parcerias/ispndunduma.png', 'url' => 'https://www.ispndunduma.co.ao/'],
        ['nome' => 'Instituto Superior Politécnico da Caála', 'local' => 'Huambo, Angola', 'acordo' => 'Protocolo de Cooperação', 'sigla' => 'ISP-C', 'logo' => 'images/parcerias/ispcaala.png', 'url' => 'https://www.ispcaala.com/inicio'],
        ['nome' => 'Universidade Internacional do Cuanza', 'local' => 'Bié, Angola', 'acordo' => 'Protocolo de Cooperação', 'sigla' => 'UNIC', 'logo' => 'images/parcerias/unic.svg', 'url' => 'https://www.unic.co.ao/'],
        ['nome' => 'Centro de Formação de Jornalistas', 'local' => 'Huambo, Angola', 'acordo' => 'Protocolo de Cooperação', 'sigla' => 'CFJ'],
        ['nome' => 'Empresa de Águas e Saneamento do Bié', 'local' => 'Bié, Angola', 'acordo' => 'Convénio de Cooperação', 'sigla' => 'EASB'],
        ['nome' => 'Hospital Dr. Walter Strangway', 'local' => 'Bié, Angola', 'acordo' => 'Protocolo de Cooperação', 'sigla' => 'HWS'],
        ['nome' => 'Hospital Mártires do Cuito', 'local' => 'Cuito, Bié, Angola', 'acordo' => 'Convénio para Estágios Supervisionados de Estudantes', 'sigla' => 'HMC'],
        ['nome' => 'Hospital Municipal do Cunje', 'local' => 'Cuito, Bié, Angola', 'acordo' => 'Convénio para Estágios Supervisionados de Estudantes', 'sigla' => 'HCU'],
        ['nome' => 'Fundo de Apoio Social (FAS)', 'local' => 'Bié, Angola', 'acordo' => 'Memorando de Cooperação', 'sigla' => 'FAS'],
        ['nome' => 'Standard Bank de Angola, S.A.', 'local' => 'Huambo, Angola', 'acordo' => 'Protocolo Bancário', 'sigla' => 'SBA', 'url' => 'https://www.standardbank.co.ao/'],
        ['nome' => 'Universidade de Luanda', 'local' => 'Luanda, Angola', 'acordo' => 'Memorando de Cooperação', 'sigla' => 'UL', 'logo' => 'images/parcerias/uniluanda.png', 'logo_escuro' => true, 'url' => 'https://uniluanda.ao/'],
        ['nome' => 'Centro Materno Infantil do Bié', 'local' => 'Bié, Angola', 'acordo' => 'Convénio para Estágios', 'sigla' => 'CMI'],
        ['nome' => 'Instituto Superior de Administração e Finanças (ISAF)', 'local' => 'Luanda, Angola', 'acordo' => 'Protocolo de Cooperação', 'sigla' => 'ISAF', 'url' => 'https://isaf.co.ao/'],
    ];

    $internacionais = [
        ['nome' => 'Morgan State University', 'local' => 'Estados Unidos da América', 'acordo' => 'Memorando de Cooperação', 'sigla' => 'MSU', 'logo' => 'images/parcerias/morgan.png', 'logo_escuro' => true, 'url' => 'https://www.morgan.edu/'],
        ['nome' => 'Universidade Federal de Santa Catarina', 'local' => 'Brasil', 'acordo' => 'Acordo de Cooperação', 'sigla' => 'UFSC', 'logo' => 'images/parcerias/ufsc.png', 'url' => 'https://ufsc.br/'],
        ['nome' => 'Universidade de Cabo Verde', 'local' => 'Cabo Verde', 'acordo' => 'Protocolo de Cooperação', 'sigla' => 'Uni-CV', 'logo' => 'images/parcerias/unicv.svg', 'logo_escuro' => true, 'url' => 'https://www.unicv.edu.cv/pt/'],
        ['nome' => 'Universidad Nacional del Litoral', 'local' => 'Argentina', 'acordo' => 'Convénio de Assistência Técnica', 'sigla' => 'UNL', 'logo' => 'images/parcerias/unl.svg', 'logo_escuro' => true, 'url' => 'https://www.unl.edu.ar/'],
    ];

    $nacionaisAnteriores = [
        'Gabinete Provincial da Educação do Bié',
        'Unitel',
        'Centro de Emprego e Formação Profissional de Jovens do Bié (Cefejor)',
    ];
@endphp

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-16" x-data="{ filtro: 'todos' }">
    @include('partials.page-hero', [
        'title' => 'Parcerias Institucionais',
        'subtitle' => 'Cooperação académica e científica com instituições em Angola e no exterior.',
        'breadcrumb' => 'Parcerias',
    ])

    <section class="relative overflow-hidden rounded-3xl bg-white border border-slate-200 shadow-sm mb-10">
        <div class="absolute inset-y-0 left-0 w-1.5 bg-[#F05A28]" aria-hidden="true"></div>
        <div class="grid gap-8 p-6 sm:p-8 lg:p-10 lg:grid-cols-[minmax(0,1fr)_auto] lg:items-center">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#F05A28] mb-3">Rede de cooperação</p>
                <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#1e3a5f]">Conhecimento que cria pontes</h2>
                <p class="mt-4 max-w-3xl text-slate-600 leading-relaxed">
                    O quadro de acordos e protocolos do Departamento Jurídico e de Intercâmbio identifica
                    13 parceiros nacionais e 5 internacionais. Apresentamos também três parceiros nacionais
                    já publicados anteriormente. Os instrumentos são indicados apenas quando constam do quadro.
                </p>
            </div>
            <div class="flex gap-3 sm:gap-4" aria-label="Instituições apresentadas">
                <div class="rounded-2xl bg-blue-50 px-5 py-4 min-w-24 text-center">
                    <span class="block text-3xl font-black text-[#1e3a8a]">{{ count($nacionais) + count($nacionaisAnteriores) }}</span>
                    <span class="block mt-1 text-xs font-semibold text-slate-600">Nacionais</span>
                </div>
                <div class="rounded-2xl bg-orange-50 px-5 py-4 min-w-24 text-center">
                    <span class="block text-3xl font-black text-[#c84a20]">{{ count($internacionais) + 1 }}</span>
                    <span class="block mt-1 text-xs font-semibold text-slate-600">Internacionais</span>
                </div>
            </div>
        </div>
    </section>

    <nav class="mb-9 flex flex-wrap items-center gap-2" aria-label="Filtrar parcerias" x-cloak>
        @foreach(['todos' => 'Todos', 'nacionais' => 'Nacionais', 'internacionais' => 'Internacionais'] as $valor => $rotulo)
            <button type="button"
                @click="filtro = '{{ $valor }}'"
                :aria-pressed="filtro === '{{ $valor }}'"
                :class="filtro === '{{ $valor }}' ? 'bg-[#1e3a5f] text-white shadow-md' : 'bg-white text-slate-700 border border-slate-200 hover:border-[#1e3a5f] hover:text-[#1e3a5f]'"
                class="rounded-full px-5 py-2.5 text-sm font-semibold transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#F05A28]">
                {{ $rotulo }}
            </button>
        @endforeach
    </nav>

    <section id="parcerias-nacionais" aria-labelledby="titulo-nacionais" class="mb-14" x-show="filtro !== 'internacionais'">
        <div class="mb-6 flex flex-wrap items-end justify-between gap-3">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#F05A28]">Em Angola</p>
                <h2 id="titulo-nacionais" class="mt-2 text-2xl sm:text-3xl font-extrabold text-[#1e3a5f]">Parceiros Nacionais</h2>
            </div>
            <span class="text-sm font-medium text-slate-500">{{ count($nacionais) }} no quadro · {{ count($nacionaisAnteriores) }} já publicadas</span>
        </div>
        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
            @foreach($nacionais as $parceiro)
                <article class="group flex h-full flex-col rounded-2xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm transition-all duration-200 hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex h-20 w-28 shrink-0 items-center justify-center rounded-xl border border-slate-100 p-3 {{ !empty($parceiro['logo_escuro']) ? 'bg-[#142d4f]' : 'bg-slate-50' }}">
                            @if(!empty($parceiro['logo']))
                                <img src="{{ asset($parceiro['logo']) }}" alt="Logótipo de {{ $parceiro['nome'] }}" loading="lazy" class="max-h-full max-w-full object-contain">
                            @else
                                <span aria-hidden="true" class="text-xl font-black tracking-tight text-[#1e3a5f]">{{ $parceiro['sigla'] }}</span>
                            @endif
                        </div>
                        <span class="rounded-full bg-blue-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wide text-blue-800">Nacional</span>
                    </div>
                    <h3 class="mt-5 text-lg font-bold leading-snug text-[#1e3a5f]">{{ $parceiro['nome'] }}</h3>
                    <p class="mt-2 text-sm text-slate-500">Local indicado no quadro: {{ $parceiro['local'] }}</p>
                    <div class="mt-5 border-t border-slate-100 pt-4">
                        <p class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Natureza do acordo</p>
                        <p class="mt-1.5 text-sm font-medium leading-relaxed text-slate-700">{{ $parceiro['acordo'] }}</p>
                    </div>
                    @if(!empty($parceiro['url']))
                        <a href="{{ $parceiro['url'] }}" target="_blank" rel="noopener noreferrer"
                            class="mt-auto pt-5 inline-flex w-fit items-center gap-1.5 text-sm font-semibold text-[#1d4ed8] hover:text-[#1e3a5f] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#F05A28]"
                            aria-label="Visitar o site de {{ $parceiro['nome'] }} (abre numa nova janela)">
                            Visitar instituição <span aria-hidden="true">↗</span>
                        </a>
                    @endif
                </article>
            @endforeach
        </div>

        <div class="mt-9 rounded-3xl border border-blue-100 bg-blue-50/60 p-6 sm:p-8">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#F05A28]">Parcerias nacionais anteriores</p>
            <h3 class="mt-2 text-xl sm:text-2xl font-extrabold text-[#1e3a5f]">Parceiros já publicados</h3>
            <p class="mt-3 max-w-3xl text-sm leading-relaxed text-slate-700">
                Estas três entidades já constavam da página de parcerias e foram confirmadas como parceiros nacionais.
                O quadro recebido não indica o tipo de acordo de cada uma, pelo que não lhes atribuímos um instrumento ou uma data.
            </p>
            <div class="mt-6 grid gap-4 md:grid-cols-3">
                @foreach($nacionaisAnteriores as $nome)
                    <article class="rounded-2xl border border-blue-100 bg-white p-5 shadow-sm">
                        <span class="inline-flex rounded-full bg-blue-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wide text-blue-800">Nacional</span>
                        <h4 class="mt-4 text-base font-bold leading-snug text-[#1e3a5f]">{{ $nome }}</h4>
                        <p class="mt-3 text-sm leading-relaxed text-slate-600">Tipo de acordo não indicado no quadro recebido.</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="parcerias-internacionais" aria-labelledby="titulo-internacionais" class="mb-14" x-show="filtro !== 'nacionais'">
        <div class="mb-6 flex flex-wrap items-end justify-between gap-3">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#F05A28]">Além-fronteiras</p>
                <h2 id="titulo-internacionais" class="mt-2 text-2xl sm:text-3xl font-extrabold text-[#1e3a5f]">Parceiros Internacionais</h2>
            </div>
            <span class="text-sm font-medium text-slate-500">{{ count($internacionais) + 1 }} instituições</span>
        </div>

        <article class="relative overflow-hidden rounded-3xl bg-[#142d4f] p-6 sm:p-8 lg:p-10 text-white shadow-xl mb-5">
            <div class="absolute -right-16 -top-20 h-72 w-72 rounded-full bg-[#F05A28]/10 blur-2xl" aria-hidden="true"></div>
            <div class="relative grid gap-7 lg:grid-cols-[minmax(0,1fr)_auto] lg:items-center">
                <div>
                    <span class="inline-flex rounded-full border border-orange-300/40 bg-orange-400/10 px-3 py-1 text-xs font-bold uppercase tracking-widest text-orange-200">Cooperação científica internacional</span>
                    <h3 class="mt-4 text-2xl sm:text-3xl font-extrabold">SASSCAL</h3>
                    <p class="mt-1 text-sm font-medium text-blue-100">Southern African Science Service Centre for Climate Change and Adaptive Land Management</p>
                    <p class="mt-4 max-w-2xl leading-relaxed text-blue-50/90">
                        Centro regional dedicado à ciência sobre alterações climáticas e gestão adaptativa da terra.
                        O quadro institucional do ISP-Bié indica um Memorando de Entendimento com o SASSCAL.
                    </p>
                    <div class="mt-5 flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-blue-100">
                        <span>Secretariado regional: Namíbia</span>
                        <span>Instrumento: Memorando de Entendimento</span>
                    </div>
                    <a href="https://sasscal.org/" target="_blank" rel="noopener noreferrer"
                        class="mt-6 inline-flex items-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-bold text-[#1e3a5f] transition-colors hover:bg-orange-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
                        aria-label="Visitar o site do SASSCAL (abre numa nova janela)">
                        Conhecer o SASSCAL <span aria-hidden="true">↗</span>
                    </a>
                </div>
                <div class="flex h-40 w-full items-center justify-center rounded-2xl border border-white/15 bg-white/10 p-6 lg:w-72">
                    <img src="{{ asset('images/parcerias/sasscal.png') }}" alt="Logótipo oficial do SASSCAL" loading="lazy" class="max-h-full max-w-full object-contain">
                </div>
            </div>
        </article>

        <div class="grid gap-5 sm:grid-cols-2">
            @foreach($internacionais as $parceiro)
                <article class="group flex h-full flex-col rounded-2xl border border-slate-200 bg-white p-5 sm:p-6 shadow-sm transition-all duration-200 hover:-translate-y-1 hover:border-orange-200 hover:shadow-lg">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex h-20 w-32 shrink-0 items-center justify-center rounded-xl border border-slate-100 p-3 {{ !empty($parceiro['logo_escuro']) ? 'bg-[#142d4f]' : 'bg-slate-50' }}">
                            @if(!empty($parceiro['logo']))
                                <img src="{{ asset($parceiro['logo']) }}" alt="Logótipo de {{ $parceiro['nome'] }}" loading="lazy" class="max-h-full max-w-full object-contain">
                            @else
                                <span aria-hidden="true" class="text-xl font-black text-[#1e3a5f]">{{ $parceiro['sigla'] }}</span>
                            @endif
                        </div>
                        <span class="rounded-full bg-orange-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wide text-orange-800">Internacional</span>
                    </div>
                    <h3 class="mt-5 text-lg font-bold leading-snug text-[#1e3a5f]">{{ $parceiro['nome'] }}</h3>
                    <p class="mt-2 text-sm text-slate-500">{{ $parceiro['local'] }}</p>
                    <div class="mt-5 border-t border-slate-100 pt-4">
                        <p class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Natureza do acordo</p>
                        <p class="mt-1.5 text-sm font-medium leading-relaxed text-slate-700">{{ $parceiro['acordo'] }}</p>
                    </div>
                    <a href="{{ $parceiro['url'] }}" target="_blank" rel="noopener noreferrer"
                        class="mt-auto pt-5 inline-flex w-fit items-center gap-1.5 text-sm font-semibold text-[#1d4ed8] hover:text-[#1e3a5f] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#F05A28]"
                        aria-label="Visitar o site de {{ $parceiro['nome'] }} (abre numa nova janela)">
                        Visitar instituição <span aria-hidden="true">↗</span>
                    </a>
                </article>
            @endforeach
        </div>
    </section>

    <section aria-labelledby="titulo-contacto" class="rounded-3xl p-7 sm:p-10 text-center" style="background:linear-gradient(135deg,#1e3a8a 0%,#F05A28 100%);">
        <h2 id="titulo-contacto" class="text-white text-xl sm:text-2xl font-bold">Propor uma nova cooperação</h2>
        <p class="mx-auto mt-3 mb-6 max-w-2xl text-sm sm:text-base leading-relaxed text-white/90">
            Instituições interessadas em estabelecer uma parceria com o ISP-Bié podem apresentar a sua proposta através dos nossos contactos institucionais.
        </p>
        <a href="{{ route('contactos') }}" class="inline-flex items-center justify-center rounded-xl bg-white px-6 py-3 text-sm font-bold text-[#1e3a8a] shadow-lg transition-colors hover:bg-orange-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
            Contactar o ISP-Bié
        </a>
    </section>
</div>
@endsection
