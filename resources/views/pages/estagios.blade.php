@extends('layouts.site')

@section('title', 'Estágios — ISP-Bié')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-16">

@include('partials.page-hero', [
    'title'      => 'Centro de Gestão de Estágios',
    'subtitle'   => 'Conectamos estudantes ao mercado de trabalho angolano e internacional.',
    'breadcrumb' => 'Estágios',
    'gradient'   => 'from-[#1e3a8a] to-[#2563eb]',
    'ctaUrl'     => 'mailto:estagios@ispbie.ao',
    'ctaLabel'   => 'Contactar o CGE',
])

{{-- Intro strip --}}
<div class="mb-8 flex items-center gap-3">
    <span class="inline-block w-8 h-0.5 bg-[#F05A28]"></span>
    <p class="text-sm font-semibold text-gray-400 uppercase tracking-widest">Centro de Gestão de Estágios</p>
</div>

{{-- Sobre o CGE + Números --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
        <h2 class="text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-4 flex items-center gap-2">
            <span class="inline-block w-5 h-0.5 bg-[#F05A28]"></span> Sobre o CGE
        </h2>
        <p class="text-gray-600 leading-relaxed mb-4">
            O Centro de Gestão de Estágios (CGE) do ISP-Bié é responsável por estabelecer parcerias
            com empresas e instituições, facilitar a colocação de estudantes em estágios curriculares
            e extracurriculares, e acompanhar o desenvolvimento profissional dos nossos alunos.
        </p>
        <p class="text-gray-600 leading-relaxed">
            Trabalhamos para garantir que cada estudante tenha oportunidades de aplicar conhecimentos
            teóricos em ambientes profissionais reais, desenvolvendo competências práticas essenciais
            para o mercado de trabalho.
        </p>
    </section>

    <div class="rounded-2xl p-6 sm:p-8 text-white flex flex-col justify-between" style="background:linear-gradient(135deg,#1e3a8a,#2563eb);">
        <h3 class="text-lg font-bold mb-6 uppercase tracking-widest opacity-90">CGE em Números</h3>
        <dl class="space-y-4">
            <div class="flex items-center justify-between border-b border-white/20 pb-3">
                <dt class="text-white/80 text-sm">Empresas Parceiras</dt>
                <dd class="text-3xl font-bold">45+</dd>
            </div>
            <div class="flex items-center justify-between border-b border-white/20 pb-3">
                <dt class="text-white/80 text-sm">Estudantes em Estágio</dt>
                <dd class="text-3xl font-bold">180</dd>
            </div>
            <div class="flex items-center justify-between border-b border-white/20 pb-3">
                <dt class="text-white/80 text-sm">Taxa de Colocação</dt>
                <dd class="text-3xl font-bold">92%</dd>
            </div>
            <div class="flex items-center justify-between">
                <dt class="text-white/80 text-sm">Horas de Estágio / Ano</dt>
                <dd class="text-3xl font-bold">50k+</dd>
            </div>
        </dl>
    </div>
</div>

{{-- Modalidades --}}
<section class="mb-12">
    <h2 class="text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-6 flex items-center gap-2">
        <span class="inline-block w-6 h-0.5 bg-[#F05A28]"></span> Modalidades de Estágio
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 border-t-4 border-t-[#2563eb]">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 rounded-xl bg-[#2563eb]/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-[#2563eb]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                    </svg>
                </div>
                <h3 class="text-base font-bold text-[#1e3a5f]">Estágio Curricular Obrigatório</h3>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed mb-4">
                Parte integrante do currículo académico, necessário para a conclusão do curso.
                Duração mínima de 400 horas, realizado no último ano de formação.
            </p>
            <ul class="space-y-2">
                @foreach(['Requisito obrigatório para graduação', 'Supervisão de docente orientador', 'Relatório final e apresentação'] as $item)
                <li class="flex items-start gap-2 text-sm text-gray-600">
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#F05A28]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    {{ $item }}
                </li>
                @endforeach
            </ul>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 border-t-4 border-t-[#F05A28]">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 rounded-xl bg-[#F05A28]/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-[#F05A28]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
                    </svg>
                </div>
                <h3 class="text-base font-bold text-[#1e3a5f]">Estágio Extracurricular</h3>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed mb-4">
                Opcional, permite ao estudante adquirir experiência profissional complementar durante
                o curso, sem carácter obrigatório.
            </p>
            <ul class="space-y-2">
                @foreach(['Flexibilidade de horários', 'Possibilidade de bolsa-auxílio', 'Certificado de participação'] as $item)
                <li class="flex items-start gap-2 text-sm text-gray-600">
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#F05A28]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    {{ $item }}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

{{-- Empresas Parceiras --}}
<section class="mb-12">
    <h2 class="text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-6 flex items-center gap-2">
        <span class="inline-block w-6 h-0.5 bg-[#F05A28]"></span> Empresas e Instituições Parceiras
    </h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach([
            ['icon'=>'🏛️', 'name'=>'Governo Provincial do Bié'],
            ['icon'=>'🏥', 'name'=>'Hospital Provincial do Bié'],
            ['icon'=>'🏗️', 'name'=>'Empresas de Construção Civil'],
            ['icon'=>'💼', 'name'=>'Bancos e Seguradoras'],
            ['icon'=>'📡', 'name'=>'Empresas de Telecomunicações'],
            ['icon'=>'💧', 'name'=>'MINEA — Recursos Hídricos'],
            ['icon'=>'📰', 'name'=>'Órgãos de Comunicação Social'],
            ['icon'=>'🤝', 'name'=>'ONGs e Organizações Sociais'],
        ] as $parceiro)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 text-center hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="text-3xl mb-2">{{ $parceiro['icon'] }}</div>
            <p class="text-xs font-semibold text-[#1e3a5f] leading-snug">{{ $parceiro['name'] }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- Processo de Candidatura --}}
<section class="mb-12">
    <h2 class="text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-6 flex items-center gap-2">
        <span class="inline-block w-6 h-0.5 bg-[#F05A28]"></span> Como Candidatar-se a Estágio
    </h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach([
            ['n'=>'1','title'=>'Consulta de Vagas',  'desc'=>'Verifique as vagas disponíveis no portal do CGE ou no mural da instituição.'],
            ['n'=>'2','title'=>'Submissão de CV',    'desc'=>'Envie o seu CV e carta de motivação ao Centro de Gestão de Estágios.'],
            ['n'=>'3','title'=>'Entrevista',          'desc'=>'Participe da entrevista com a empresa ou instituição parceira.'],
            ['n'=>'4','title'=>'Início do Estágio',  'desc'=>'Assine o termo de compromisso e inicie as suas atividades.'],
        ] as $step)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 text-center hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-full bg-[#1e3a5f] flex items-center justify-center text-white text-lg font-bold mx-auto mb-4">
                {{ $step['n'] }}
            </div>
            <h4 class="font-bold text-[#1e3a5f] text-sm mb-2">{{ $step['title'] }}</h4>
            <p class="text-xs text-gray-500 leading-relaxed">{{ $step['desc'] }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- CTA --}}
<div class="rounded-2xl p-8 text-white text-center" style="background:linear-gradient(135deg,#1e3a8a,#2563eb);">
    <h2 class="text-xl font-bold mb-2">Procura uma Oportunidade de Estágio?</h2>
    <p class="text-blue-100 text-sm mb-6 max-w-lg mx-auto">
        Entre em contacto com o Centro de Gestão de Estágios do ISP-Bié. Estamos disponíveis de segunda a sexta, das 08h00 às 17h00.
    </p>
    <div class="flex flex-col sm:flex-row justify-center gap-3">
        <a href="mailto:estagios@ispbie.ao"
           class="inline-flex items-center justify-center gap-2 bg-[#F05A28] hover:bg-[#d04a1e] text-white font-semibold px-6 py-3 rounded-xl shadow transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
            estagios@ispbie.ao
        </a>
        <a href="tel:+244922408061"
           class="inline-flex items-center justify-center gap-2 bg-white/15 hover:bg-white/25 text-white font-semibold px-6 py-3 rounded-xl transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
            (+244) 922 408 061
        </a>
    </div>
</div>

</div>
@endsection
