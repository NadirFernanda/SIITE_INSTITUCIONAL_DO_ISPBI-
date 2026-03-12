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
        'title'      => 'Psicologia Clínica',
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

{{-- Grade de Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($cursos as $curso)
    <a href="{{ route($curso['route']) }}"
       class="group flex flex-col bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden focus:outline-none focus:ring-2 focus:ring-[#F05A28] focus:ring-offset-2">

        {{-- Barra de cor topo --}}
        <div class="h-1.5 w-full" style="background:{{ $curso['color'] }};"></div>

        <div class="p-6 flex flex-col flex-1">
            {{-- Ícone + badge --}}
            <div class="flex items-start justify-between mb-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:{{ $curso['color'] }}18;">
                    <svg class="w-6 h-6" fill="none" stroke="{{ $curso['color'] }}" stroke-width="1.5" viewBox="0 0 24 24">
                        {!! $curso['icon'] !!}
                    </svg>
                </div>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold uppercase tracking-wide" style="background:{{ $curso['color'] }}18; color:{{ $curso['color'] }};">
                    {{ $curso['tag'] }}
                </span>
            </div>

            {{-- Título --}}
            <h2 class="text-base font-bold text-[#1e3a5f] leading-snug mb-1 group-hover:text-[#F05A28] transition-colors">
                {{ $curso['title'] }}
            </h2>

            {{-- Departamento --}}
            <p class="text-[11px] font-medium text-gray-400 uppercase tracking-wide mb-3">{{ $curso['department'] }}</p>

            {{-- Resumo --}}
            <p class="text-sm text-gray-500 leading-relaxed flex-1">{{ $curso['summary'] }}</p>

            {{-- Rodapé do card --}}
            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-3 text-xs text-gray-400">
                    <span class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"/><circle cx="12" cy="12" r="9"/></svg>
                        {{ $curso['duration'] }}
                    </span>

                </div>
                <span class="flex items-center gap-1 text-xs font-semibold" style="color:{{ $curso['color'] }};">
                    Ver curso
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </div>
        </div>
    </a>
    @endforeach
</div>

{{-- Secção cursos acreditados --}}
<div class="mt-14">
    <h2 class="text-lg font-bold text-[#1e3a5f] uppercase tracking-widest mb-6 flex items-center gap-2">
        <span class="inline-block w-6 h-0.5 bg-[#F05A28]"></span>
        Cursos Acreditados
    </h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach([
            ['title'=>'Enfermagem',              'percent'=>'65,94%'],
            ['title'=>'Psicologia',              'percent'=>'67,8%'],
            ['title'=>'Engenharia Informática',  'percent'=>'68,60%'],
            ['title'=>'Comunicação Social',      'percent'=>'73,63%'],
            ['title'=>'Contabilidade',           'percent'=>'73,23%'],
        ] as $ac)
        <div class="flex items-center justify-between bg-white rounded-xl border border-gray-100 shadow-sm px-5 py-4">
            <div>
                <p class="text-sm font-semibold text-[#1e3a5f]">{{ $ac['title'] }}</p>
                <p class="text-[11px] text-gray-400 mt-0.5">Acreditação oficial</p>
            </div>
            <span class="text-lg font-bold" style="color:#1D4ED8;">{{ $ac['percent'] }}</span>
        </div>
        @endforeach
    </div>
</div>

</div>
@endsection
