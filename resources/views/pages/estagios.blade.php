@extends('layouts.site')

@section('title', 'Gestão de Estágios')
@section('meta_description', 'Informações sobre a organização dos estágios do ISP-Bié em Angola e as instituições nacionais com protocolos de cooperação.')

@php
    // Fonte dos instrumentos: quadro nacional do Departamento Jurídico e de Intercâmbio.
    // A apresentação dos nomes e logótipos segue a página institucional de Parcerias.
    // Apenas os três instrumentos com estágios expressamente indicados recebem essa identificação.
    $parceirosNacionais = [
        ['nome' => 'Instituto Superior Politécnico Ndunduma', 'local' => 'Bié, Angola', 'acordo' => 'Convénio de Colaboração Académica', 'sigla' => 'ISPN', 'logo' => 'images/parcerias/ispndunduma.png'],
        ['nome' => 'Instituto Superior Politécnico da Caála', 'local' => 'Huambo, Angola', 'acordo' => 'Protocolo de Cooperação', 'sigla' => 'ISP-C', 'logo' => 'images/parcerias/ispcaala.png'],
        ['nome' => 'Universidade Internacional do Cuanza', 'local' => 'Bié, Angola', 'acordo' => 'Protocolo de Cooperação', 'sigla' => 'UNIC', 'logo' => 'images/parcerias/unic.svg'],
        ['nome' => 'Centro de Formação de Jornalistas', 'local' => 'Huambo, Angola', 'acordo' => 'Protocolo de Cooperação', 'sigla' => 'CFJ'],
        ['nome' => 'Empresa de Águas e Saneamento do Bié', 'local' => 'Bié, Angola', 'acordo' => 'Convénio de Cooperação', 'sigla' => 'EASB'],
        ['nome' => 'Hospital Dr. Walter Strangway', 'local' => 'Bié, Angola', 'acordo' => 'Protocolo de Cooperação', 'sigla' => 'HWS'],
        ['nome' => 'Hospital Mártires do Cuito', 'local' => 'Cuito, Bié, Angola', 'acordo' => 'Convénio para Estágios Supervisionados de Estudantes', 'sigla' => 'HMC', 'estagios' => true],
        ['nome' => 'Hospital Municipal do Cunje', 'local' => 'Cuito, Bié, Angola', 'acordo' => 'Convénio para Estágios Supervisionados de Estudantes', 'sigla' => 'HCU', 'estagios' => true],
        ['nome' => 'Fundo de Apoio Social (FAS)', 'local' => 'Bié, Angola', 'acordo' => 'Memorando de Cooperação', 'sigla' => 'FAS'],
        ['nome' => 'Standard Bank de Angola, S.A.', 'local' => 'Huambo, Angola', 'acordo' => 'Protocolo Bancário', 'sigla' => 'SBA'],
        ['nome' => 'Universidade de Luanda', 'local' => 'Luanda, Angola', 'acordo' => 'Memorando de Cooperação', 'sigla' => 'UL', 'logo' => 'images/parcerias/uniluanda.png', 'logo_escuro' => true],
        ['nome' => 'Centro Materno Infantil do Bié', 'local' => 'Bié, Angola', 'acordo' => 'Convénio para Estágios', 'sigla' => 'CMI', 'estagios' => true],
        ['nome' => 'Instituto Superior de Administração e Finanças (ISAF)', 'local' => 'Luanda, Angola', 'acordo' => 'Protocolo de Cooperação', 'sigla' => 'ISAF'],
    ];
    $comEstagios = array_values(array_filter($parceirosNacionais, fn ($parceiro) => !empty($parceiro['estagios'])));
    $outraCooperacao = array_values(array_filter($parceirosNacionais, fn ($parceiro) => empty($parceiro['estagios'])));
    $etapas = [
        ['titulo' => 'Organização', 'texto' => 'Consulte o curso para conhecer as orientações aplicáveis e a forma de preparação do estágio.'],
        ['titulo' => 'Colocação', 'texto' => 'Confirme com o ISP-Bié a instituição de acolhimento e as condições definidas para o seu caso.'],
        ['titulo' => 'Supervisão', 'texto' => 'O acompanhamento segue as orientações do curso e as condições acordadas com a instituição de acolhimento.'],
        ['titulo' => 'Avaliação', 'texto' => 'Os critérios e elementos de avaliação são comunicados pelo curso responsável.'],
        ['titulo' => 'Conclusão', 'texto' => 'Confirme junto do curso os passos necessários para encerrar e registar o estágio.'],
    ];
@endphp

@section('content')
<div class="mx-auto max-w-7xl px-4 pb-16 pt-4 sm:px-6 lg:px-8">
    @include('partials.page-hero', [
        'title' => 'Gestão de Estágios',
        'subtitle' => 'Formação prática e ligação a instituições em Angola.',
        'breadcrumb' => 'Estágios',
    ])

    <section aria-labelledby="titulo-apresentacao" class="relative mb-12 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="absolute inset-y-0 left-0 w-1.5 bg-[#F05A28]" aria-hidden="true"></div>
        <div class="grid gap-7 p-6 sm:p-8 lg:grid-cols-[minmax(0,1fr)_auto] lg:items-center lg:p-10">
            <div>
                <p class="mb-3 text-xs font-bold uppercase tracking-[0.2em] text-[#F05A28]">Formação em contexto real</p>
                <h2 id="titulo-apresentacao" class="text-2xl font-extrabold tracking-tight text-[#1e3a5f] sm:text-3xl">Apresentação da Gestão de Estágios</h2>
                <p class="mt-4 max-w-3xl leading-relaxed text-slate-600">
                    Os estágios aproximam a formação académica da prática profissional e das necessidades das comunidades.
                    Esta página reúne orientações gerais para estudantes do ISP-Bié e identifica, entre os parceiros nacionais,
                    as instituições cujos instrumentos de cooperação mencionam expressamente estágios.
                </p>
            </div>
            <div class="rounded-2xl bg-[#142d4f] px-6 py-5 text-white lg:max-w-56">
                <span class="block text-xl font-extrabold">Em Angola</span>
                <span class="mt-2 block text-sm leading-relaxed text-blue-100">Informação sobre estágios e cooperação institucional nacional.</span>
            </div>
        </div>
    </section>

    <section aria-labelledby="titulo-objectivos" class="mb-12">
        <div class="mb-6">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#F05A28]">Formação académica e profissional</p>
            <h2 id="titulo-objectivos" class="mt-2 text-2xl font-extrabold text-[#1e3a5f] sm:text-3xl">Objectivos e importância</h2>
            <p class="mt-2 max-w-3xl text-sm leading-relaxed text-slate-600">O estágio cria condições para relacionar conhecimentos do curso com situações de trabalho e serviço à comunidade.</p>
        </div>
        <div class="grid gap-5 md:grid-cols-3">
            <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 font-black text-[#1e3a5f]">01</div>
                <h3 class="text-lg font-bold text-[#1e3a5f]">Aplicar conhecimentos</h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-600">Relacionar a aprendizagem académica com experiências práticas adequadas à área de formação.</p>
            </article>
            <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 font-black text-[#1e3a5f]">02</div>
                <h3 class="text-lg font-bold text-[#1e3a5f]">Desenvolver competências</h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-600">Conhecer práticas profissionais, responsabilidades e formas de colaboração no local de estágio.</p>
            </article>
            <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 font-black text-[#1e3a5f]">03</div>
                <h3 class="text-lg font-bold text-[#1e3a5f]">Servir a comunidade</h3>
                <p class="mt-2 text-sm leading-relaxed text-slate-600">Aproximar estudantes e instituições nacionais em actividades compatíveis com o percurso académico.</p>
            </article>
        </div>
    </section>

    <section aria-labelledby="titulo-modalidades" class="mb-12">
        <div class="mb-6">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#F05A28]">Percursos de formação prática</p>
            <h2 id="titulo-modalidades" class="mt-2 text-2xl font-extrabold text-[#1e3a5f] sm:text-3xl">Modalidades de estágio</h2>
        </div>
        <div class="grid gap-5 md:grid-cols-2">
            <article class="rounded-2xl border border-slate-200 border-t-4 border-t-[#1e3a8a] bg-white p-6 shadow-sm sm:p-7">
                <h3 class="text-lg font-bold text-[#1e3a5f]">Estágios curriculares</h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-600">Integram o percurso de formação quando previstos pelo plano de estudos do curso. A organização e os requisitos concretos são confirmados pelo curso responsável.</p>
            </article>
            <article class="rounded-2xl border border-slate-200 border-t-4 border-t-[#F05A28] bg-white p-6 shadow-sm sm:p-7">
                <h3 class="text-lg font-bold text-[#1e3a5f]">Estágios extracurriculares</h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-600">A sua eventual realização depende de confirmação institucional e das condições acordadas com a entidade de acolhimento. Consulte o ISP-Bié antes de planear esta modalidade.</p>
            </article>
        </div>
    </section>

    <section aria-labelledby="titulo-procedimentos" class="mb-12">
        <div class="mb-6">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#F05A28]">Percurso de referência</p>
            <h2 id="titulo-procedimentos" class="mt-2 text-2xl font-extrabold text-[#1e3a5f] sm:text-3xl">Como se organiza um estágio</h2>
            <p class="mt-2 max-w-3xl text-sm leading-relaxed text-slate-600">As etapas abaixo ajudam a orientar o percurso. Requisitos e procedimentos específicos são confirmados pelo curso e pela instituição de acolhimento.</p>
        </div>
        <ol class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
            @foreach($etapas as $indice => $etapa)
                <li class="relative rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <span class="mb-4 flex h-11 w-11 items-center justify-center rounded-full bg-[#1e3a5f] text-sm font-black text-white">{{ str_pad($indice + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3 class="font-bold text-[#1e3a5f]">{{ $etapa['titulo'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $etapa['texto'] }}</p>
                </li>
            @endforeach
        </ol>
    </section>

    <section aria-labelledby="titulo-parceiros" class="mb-12">
        <div class="mb-7">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#F05A28]">Cooperação em Angola</p>
            <h2 id="titulo-parceiros" class="mt-2 text-2xl font-extrabold text-[#1e3a5f] sm:text-3xl">Instituições parceiras nacionais</h2>
            <p class="mt-2 max-w-3xl text-sm leading-relaxed text-slate-600">O quadro jurídico distingue os instrumentos que mencionam estágios dos demais acordos de cooperação. A existência de um protocolo não representa, por si só, uma vaga disponível.</p>
        </div>

        <div class="mb-7 rounded-3xl bg-[#142d4f] p-6 text-white sm:p-8">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-orange-200">Estágios expressamente previstos</p>
            <h3 id="titulo-acordos-estagios" class="mt-2 text-xl font-extrabold sm:text-2xl">Unidades de saúde com convénios para estágios</h3>
            <p class="mt-2 max-w-3xl text-sm leading-relaxed text-blue-100">Os instrumentos destas três instituições mencionam estágios de estudantes. A colocação concreta depende de confirmação institucional.</p>
        </div>
        <div class="mb-10 grid gap-5 sm:grid-cols-2 xl:grid-cols-3" aria-labelledby="titulo-acordos-estagios">
            @foreach($comEstagios as $parceiro)
                <article class="flex h-full min-w-0 flex-col rounded-2xl border border-blue-200 bg-white p-5 shadow-sm transition-shadow hover:shadow-lg sm:p-6">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex h-20 w-28 shrink-0 items-center justify-center rounded-xl border border-slate-100 bg-slate-50 p-3">
                            <span aria-hidden="true" class="text-xl font-black tracking-tight text-[#1e3a5f]">{{ $parceiro['sigla'] }}</span>
                        </div>
                        <span class="rounded-full bg-blue-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wide text-blue-800">Nacional</span>
                    </div>
                    <h4 class="mt-5 text-lg font-bold leading-snug text-[#1e3a5f]">{{ $parceiro['nome'] }}</h4>
                    <p class="mt-2 text-sm text-slate-500">{{ $parceiro['local'] }}</p>
                    <div class="mt-auto border-t border-slate-100 pt-4">
                        <p class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Natureza do acordo</p>
                        <p class="mt-1.5 text-sm font-medium leading-relaxed text-slate-700">{{ $parceiro['acordo'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mb-5">
            <h3 id="titulo-outra-cooperacao" class="text-xl font-extrabold text-[#1e3a5f] sm:text-2xl">Outras instituições em cooperação</h3>
            <p class="mt-2 max-w-3xl text-sm leading-relaxed text-slate-600">Estes acordos constam do quadro nacional, mas o seu objecto apresentado não confirma acolhimento de estagiários.</p>
        </div>
        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3" aria-labelledby="titulo-outra-cooperacao">
            @foreach($outraCooperacao as $parceiro)
                <article class="flex h-full min-w-0 flex-col rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition-shadow hover:shadow-lg sm:p-6">
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
                    <h4 class="mt-5 text-lg font-bold leading-snug text-[#1e3a5f]">{{ $parceiro['nome'] }}</h4>
                    <p class="mt-2 text-sm text-slate-500">{{ $parceiro['local'] }}</p>
                    <div class="mt-auto border-t border-slate-100 pt-4">
                        <p class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Natureza do acordo</p>
                        <p class="mt-1.5 text-sm font-medium leading-relaxed text-slate-700">{{ $parceiro['acordo'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
        <a href="{{ route('parcerias') }}" class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-[#1d4ed8] hover:text-[#1e3a5f] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#F05A28]">
            Ver todas as Parcerias Institucionais <span aria-hidden="true">→</span>
        </a>
    </section>

    <section aria-labelledby="titulo-orientacoes" class="mb-12 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#F05A28]">Antes de iniciar</p>
        <h2 id="titulo-orientacoes" class="mt-2 text-2xl font-extrabold text-[#1e3a5f] sm:text-3xl">Orientações aos estudantes</h2>
        <ul class="mt-6 grid gap-4 md:grid-cols-3">
            <li class="rounded-xl bg-slate-50 p-5 text-sm leading-relaxed text-slate-700"><strong class="mb-2 block text-[#1e3a5f]">Consulte o seu curso</strong>Verifique se o estágio integra o seu plano de estudos e quais são os requisitos aplicáveis.</li>
            <li class="rounded-xl bg-slate-50 p-5 text-sm leading-relaxed text-slate-700"><strong class="mb-2 block text-[#1e3a5f]">Confirme a colocação</strong>A presença de uma instituição nesta página não garante uma vaga ou um período de estágio.</li>
            <li class="rounded-xl bg-slate-50 p-5 text-sm leading-relaxed text-slate-700"><strong class="mb-2 block text-[#1e3a5f]">Siga as orientações oficiais</strong>Peça ao ISP-Bié informação actualizada sobre supervisão, avaliação e conclusão.</li>
        </ul>
    </section>

    <section aria-labelledby="titulo-contactos" class="rounded-3xl p-7 text-center sm:p-10" style="background:linear-gradient(135deg,#1e3a8a 0%,#F05A28 100%);">
        <h2 id="titulo-contactos" class="text-xl font-bold text-white sm:text-2xl">Contactos e informação institucional</h2>
        <p class="mx-auto mt-3 max-w-2xl text-sm leading-relaxed text-white/90 sm:text-base">Para conhecer as orientações do seu curso ou esclarecer questões sobre estágios em Angola, utilize os contactos institucionais do ISP-Bié.</p>
        <div class="mt-6 flex flex-wrap justify-center gap-3">
            <a href="{{ route('contactos') }}" class="inline-flex items-center justify-center rounded-xl bg-white px-6 py-3 text-sm font-bold text-[#1e3a8a] shadow-lg transition-colors hover:bg-orange-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Contactar o ISP-Bié</a>
            <a href="mailto:geral@isp-bie.ao" class="inline-flex items-center justify-center rounded-xl border border-white/60 px-6 py-3 text-sm font-bold text-white transition-colors hover:bg-white/10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">geral@isp-bie.ao</a>
        </div>
    </section>
</div>
@endsection
