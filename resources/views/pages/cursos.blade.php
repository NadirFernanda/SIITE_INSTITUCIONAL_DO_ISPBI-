@extends('layouts.site')

@section('title', 'Cursos — ISP-Bié')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-12">

@include('partials.page-hero', [
    'title'      => 'Oferta Formativa',
    'subtitle'   => 'Conheça os cursos do ISP-Bié — formação de qualidade para o desenvolvimento de Angola.',
    'breadcrumb' => 'Cursos',
    'ctaUrl'     => '/candidaturas',
    'ctaLabel'   => 'Candidatar-me',
])

@php
$cursos = [
    [
        'slug'       => 'enfermagem',
        'route'      => 'cursos.enfermagem',
        'title'      => 'Enfermagem Geral',
        'department' => 'Ciências da Saúde',
        'duration'   => '5 anos',
        'vagas'      => 40,
        'tag'        => 'Saúde',
        'color'      => '#16A34A',
        'icon'       => '<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>',
        'svgExtra'   => '',
        'summary'    => 'Forma profissionais aptos a actuar na promoção, prevenção, recuperação e reabilitação da saúde.',
    ],
    [
        'slug'       => 'psicologia',
        'route'      => 'cursos.psicologia',
        'title'      => 'Psicologia',
        'department' => 'Ciências da Saúde',
        'duration'   => '5 anos',
        'vagas'      => 40,
        'tag'        => 'Saúde',
        'color'      => '#D03B1F',
        'icon'       => '<circle cx="12" cy="8" r="4"/><path stroke-linecap="round" stroke-linejoin="round" d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>',
        'svgExtra'   => '',
        'summary'    => 'Avaliação, diagnóstico e intervenção psicológica em contextos clínicos, educativos e comunitários.',
    ],
    [
        'slug'       => 'comunicacao',
        'route'      => 'cursos.comunicacao',
        'title'      => 'Comunicação Social',
        'department' => 'Ciências Humanas, Sociais e Económicas',
        'duration'   => '4 anos',
        'vagas'      => 40,
        'tag'        => 'Social',
        'color'      => '#C2710C',
        'icon'       => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z"/>',
        'svgExtra'   => '',
        'summary'    => 'Gestão, planeamento e produção de comunicação pública, jornalismo, publicidade e assessoria.',
    ],
    [
        'slug'       => 'contabilidade',
        'route'      => 'cursos.contabilidade',
        'title'      => 'Contabilidade e Administração',
        'department' => 'Ciências Humanas, Sociais e Económicas',
        'duration'   => '4 anos',
        'vagas'      => 40,
        'tag'        => 'Gestão',
        'color'      => '#92680A',
        'icon'       => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 13h4v6H7zm6-8h4v14h-4z"/>',
        'svgExtra'   => '',
        'summary'    => 'Gestão de recursos, análise financeira, contabilidade, auditoria e apoio à decisão económica.',
    ],
    [
        'slug'       => 'informatica',
        'route'      => 'cursos.informatica',
        'title'      => 'Engenharia Informática',
        'department' => 'Engenharias',
        'duration'   => '5 anos',
        'vagas'      => 40,
        'tag'        => 'Engenharia',
        'color'      => '#1D4ED8',
        'icon'       => '<path stroke-linecap="round" stroke-linejoin="round" d="M16 18l6-6-6-6M8 6l-6 6 6 6"/>',
        'svgExtra'   => '',
        'summary'    => 'Desenvolvimento de software, redes, sistemas e soluções tecnológicas para a transformação digital.',
    ],
    [
        'slug'       => 'hidricos',
        'route'      => 'cursos.hidricos',
        'title'      => 'Eng. em Recursos Hídricos',
        'department' => 'Engenharias',
        'duration'   => '6 anos',
        'vagas'      => 40,
        'tag'        => 'Engenharia',
        'color'      => '#0284C7',
        'icon'       => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3c0 0-6 5.686-6 10a6 6 0 0012 0c0-4.314-6-10-6-10z"/>',
        'svgExtra'   => '',
        'summary'    => 'Gestão e aproveitamento sustentável de recursos hídricos, saneamento e infraestruturas hidráulicas.',
    ],
];
@endphp

{{-- Intro strip --}}
<div class="mb-8 flex items-center gap-3">
    <span class="inline-block w-8 h-0.5 bg-[#F05A28]"></span>
    <p class="text-sm font-semibold text-gray-400 uppercase tracking-widest">{{ count($cursos) }} cursos disponíveis</p>
</div>

{{-- Grade de Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($cursos as $curso)
    <a href="{{ route($curso['route']) }}"
       x-data="{ hovered: false }"
       @mouseenter="hovered = true" @mouseleave="hovered = false"
       :style="hovered ? 'box-shadow: 0 24px 56px -8px {{ $curso['color'] }}55, 0 4px 16px -4px {{ $curso['color'] }}33' : ''"
       class="group flex flex-col bg-white rounded-2xl shadow-md hover:-translate-y-2 transition-all duration-300 overflow-hidden focus:outline-none focus:ring-2 focus:ring-offset-2"
       style="focus-ring-color: {{ $curso['color'] }};">

        {{-- Vivid coloured header with glass shine --}}
        <div class="relative h-32 flex items-center justify-center overflow-hidden"
             style="background: linear-gradient(140deg, {{ $curso['color'] }} 0%, {{ $curso['color'] }}cc 60%, {{ $curso['color'] }}88 100%);">
            {{-- Glass highlight overlay --}}
            <div class="absolute inset-0 bg-gradient-to-br from-white/30 via-white/5 to-transparent pointer-events-none"></div>
            {{-- Decorative depth circles --}}
            <div class="absolute -top-10 -left-10 w-36 h-36 rounded-full bg-white/10 pointer-events-none"></div>
            <div class="absolute -bottom-12 -right-8 w-32 h-32 rounded-full bg-black/15 pointer-events-none"></div>
            {{-- Icon --}}
            <div class="relative z-10 w-16 h-16 rounded-2xl flex items-center justify-center shadow-xl"
                 style="background: rgba(255,255,255,0.22); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.3);">
                <svg class="w-8 h-8 text-white drop-shadow" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    {!! $curso['icon'] !!}
                </svg>
            </div>
            {{-- Tag badge --}}
            <span class="absolute top-3 right-3 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide text-white"
                  style="background: rgba(0,0,0,0.25); backdrop-filter: blur(4px);">
                {{ $curso['tag'] }}
            </span>
            {{-- Shine line at bottom of header --}}
            <div class="absolute bottom-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5) 50%, transparent);"></div>
        </div>

        <div class="p-6 flex flex-col flex-1">
            {{-- Title --}}
            <h2 class="text-base font-bold text-[#1e3a5f] leading-snug mb-1 transition-colors duration-200"
                :style="hovered ? 'color: {{ $curso['color'] }}' : ''">
                {{ $curso['title'] }}
            </h2>

            {{-- Department --}}
            <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wide mb-3">{{ $curso['department'] }}</p>

            {{-- Summary --}}
            <p class="text-sm text-gray-500 leading-relaxed flex-1">{{ $curso['summary'] }}</p>

            {{-- Footer --}}
            <div class="mt-5 pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="flex items-center gap-1.5 text-xs text-gray-400">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"/><circle cx="12" cy="12" r="9"/></svg>
                    {{ $curso['duration'] }}
                </span>
                <span class="inline-flex items-center gap-1 text-xs font-bold px-3 py-1.5 rounded-lg text-white shadow-sm transition-all duration-200 group-hover:shadow-md"
                      style="background: {{ $curso['color'] }};">
                    Ver curso
                    <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </div>
        </div>
    </a>
    @endforeach
</div>

{{-- Secção cursos acreditados --}}
<div class="mt-16 pt-10 border-t border-gray-100">
    <div class="flex items-center gap-3 mb-6">
        <span class="inline-block w-6 h-0.5 bg-[#F05A28]"></span>
        <h2 class="text-lg font-bold text-[#1e3a5f] uppercase tracking-widest">
            Cursos Acreditados
        </h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach([
            ['title'=>'Enfermagem',              'percent'=>'65,94%', 'color'=>'#16A34A'],
            ['title'=>'Psicologia',              'percent'=>'67,8%',  'color'=>'#D03B1F'],
            ['title'=>'Engenharia Informática',  'percent'=>'68,60%', 'color'=>'#1D4ED8'],
            ['title'=>'Comunicação Social',      'percent'=>'73,63%', 'color'=>'#C2710C'],
            ['title'=>'Contabilidade',           'percent'=>'73,23%', 'color'=>'#92680A'],
        ] as $ac)
        <div class="group flex items-center justify-between rounded-2xl border border-gray-100 px-5 py-4 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 overflow-hidden relative bg-white">
            <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-2xl" style="background:{{ $ac['color'] }};"></div>
            <div class="pl-2">
                <p class="text-sm font-bold text-[#1e3a5f]">{{ $ac['title'] }}</p>
                <p class="text-[11px] text-gray-400 mt-0.5 uppercase tracking-wide">Acreditação oficial</p>
            </div>
            <span class="text-xl font-extrabold" style="color:{{ $ac['color'] }};">{{ $ac['percent'] }}</span>
        </div>
        @endforeach
    </div>
</div>

</div>
@endsection


