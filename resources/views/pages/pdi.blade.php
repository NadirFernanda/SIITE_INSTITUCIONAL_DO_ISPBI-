@extends('layouts.site')

@section('title', 'Plano de Desenvolvimento Institucional (PDI) 2026–2031')
@section('meta_description', 'Conheça os sete pilares estratégicos do Plano de Desenvolvimento Institucional 2026–2031 do ISP-Bié.')

@php
    $pilares = [
        ['titulo' => 'Qualidade Académica e Acreditação', 'icone' => 'M3 10l9-5 9 5-9 5-9-5Zm4 2v5c3 2 7 2 10 0v-5M21 10v6', 'cor' => '#d71920', 'fundo' => '#fff1f2'],
        ['titulo' => 'Inovação STEAM e Modernização Digital', 'icone' => 'M4 5h16v11H4V5Zm4 15h8m-4-4v4M8 9h3v3H8V9Zm5 0h3v3h-3V9Z', 'cor' => '#ed7800', 'fundo' => '#fff4e7'],
        ['titulo' => 'Infraestruturas e Laboratórios', 'icone' => 'M4 21h16M6 21V5l6-2 6 2v16M9 9h1m4 0h1m-6 4h1m4 0h1m-5 8v-4h4v4', 'cor' => '#1647a5', 'fundo' => '#eff6ff'],
        ['titulo' => 'Desenvolvimento do Capital Humano', 'icone' => 'M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm-7 10v-2a7 7 0 0 1 14 0v2H5Zm14-14h2m-1-1v2', 'cor' => '#107247', 'fundo' => '#ecfdf5'],
        ['titulo' => 'Investigação, Extensão e Impacto Comunitário', 'icone' => 'M10 3a7 7 0 1 0 0 14 7 7 0 0 0 0-14Zm5 12 6 6M7 10h6m-3-3v6', 'cor' => '#d71920', 'fundo' => '#fff1f2'],
        ['titulo' => 'Empreendedorismo e Relação Universidade–Sociedade', 'icone' => 'M9 18h6m-5 3h4m-5-6a7 7 0 1 1 6 0c-.6.5-1 1.2-1 2H10c0-.8-.4-1.5-1-2Z', 'cor' => '#ed7800', 'fundo' => '#fff4e7'],
        ['titulo' => 'Governação, Transparência e Sustentabilidade', 'icone' => 'M12 2 4 6v5c0 5 3.4 9 8 11 4.6-2 8-6 8-11V6l-8-4Zm-3 9 2 2 4-4', 'cor' => '#1647a5', 'fundo' => '#eff6ff'],
    ];
@endphp

@section('content')
<div class="institutional-page">
    @include('partials.page-hero', [
        'title' => 'Plano de Desenvolvimento Institucional',
        'subtitle' => 'PDI 2026–2031',
        'breadcrumb' => 'PDI 2026–2031',
    ])

    <section class="mb-10 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm" aria-labelledby="pdi-apresentacao">
        <div class="grid gap-6 p-6 sm:p-8 lg:grid-cols-[minmax(0,1fr)_auto] lg:items-center lg:p-10">
            <div>
                <p class="mb-3 text-xs font-bold uppercase tracking-[0.2em] text-[#c84a20]">Estratégia institucional</p>
                <h2 id="pdi-apresentacao" class="text-2xl font-extrabold tracking-tight text-[#1e3a5f] sm:text-3xl">PDI 2026–2031</h2>
                <p class="mt-4 max-w-3xl text-base leading-relaxed text-slate-600 sm:text-lg">
                    Instrumento orientador do desenvolvimento académico, científico, tecnológico e institucional do Instituto Superior Politécnico do Bié.
                </p>
            </div>
            @if($pdfUrl)
                <a href="{{ $pdfUrl }}" target="_blank" rel="noopener" class="institutional-button gap-2">
                    Consultar o PDI 2026–2031
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17 17 7M8 7h9v9"/></svg>
                </a>
            @endif
        </div>
    </section>

    @if($photoUrl)
        <figure class="mb-12 overflow-hidden rounded-3xl border border-slate-200 bg-white p-3 shadow-sm sm:p-5">
            <a href="{{ $photoUrl }}" target="_blank" rel="noopener" aria-label="Ampliar a fotografia original dos sete pilares do PDI">
                <img src="{{ $photoUrl }}" alt="Fotografia original do painel dos sete pilares estratégicos do PDI 2026–2031 do ISP-Bié" class="mx-auto block h-auto max-h-[720px] w-auto max-w-full rounded-2xl object-contain" loading="eager">
            </a>
            <figcaption class="px-2 pb-1 pt-4 text-center text-sm text-slate-500">Painel dos sete pilares estratégicos do PDI 2026–2031. Seleccione a fotografia para a ampliar.</figcaption>
        </figure>
    @endif

    <section aria-labelledby="pdi-pilares">
        <div class="mb-7 flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-[#c84a20]">Orientação estratégica</p>
                <h2 id="pdi-pilares" class="text-2xl font-extrabold tracking-tight text-[#1e3a5f] sm:text-3xl">Os sete pilares estratégicos</h2>
            </div>
            <span class="rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold text-[#1e3a5f]">2026–2031</span>
        </div>

        <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach($pilares as $pilar)
                <article class="relative flex min-h-56 flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition-shadow hover:shadow-lg sm:p-7 @if($loop->last) lg:col-start-2 @endif" style="border-top:4px solid {{ $pilar['cor'] }};">
                    <div class="mb-5 flex items-center justify-between gap-3">
                        <span class="inline-flex h-11 w-11 items-center justify-center rounded-xl" style="background:{{ $pilar['fundo'] }};color:{{ $pilar['cor'] }};">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true"><path d="{{ $pilar['icone'] }}"/></svg>
                        </span>
                        <span class="text-xs font-bold uppercase tracking-widest text-[#1e3a5f]">Pilar {{ $loop->iteration }}</span>
                    </div>
                    <h3 class="text-lg font-bold leading-snug text-[#1e3a5f] sm:text-xl">{{ $pilar['titulo'] }}</h3>
                </article>
            @endforeach
        </div>
    </section>
</div>
@endsection
