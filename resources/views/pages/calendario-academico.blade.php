@extends('layouts.site')

@section('title', $calendar ? 'Calendário Académico '.$calendar['ano'] : 'Calendário Académico')
@section('meta_description', 'Consulte o calendário académico oficialmente publicado pelo Instituto Superior Politécnico do Bié.')

@section('content')
<div class="mx-auto max-w-7xl px-4 pb-16 pt-4 sm:px-6 lg:px-8">
    @include('partials.page-hero', [
        'title' => 'Calendário Académico',
        'subtitle' => $calendar ? 'Ano académico '.$calendar['ano'] : 'Informação académica oficial do ISP-Bié',
        'breadcrumb' => 'Calendário Académico',
    ])

    @if($preview)
        <div role="status" class="mb-6 rounded-xl border border-amber-300 bg-amber-50 px-5 py-4 font-semibold text-amber-900">
            Pré-visualização do rascunho. Esta versão ainda não está publicada.
        </div>
    @endif

    @if($calendar)
        <section class="mb-10 flex flex-col gap-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8 lg:flex-row lg:items-center lg:justify-between lg:p-10" aria-labelledby="calendario-ano">
            <div>
                <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-[#c84a20]">Organização do ano académico</p>
                <h2 id="calendario-ano" class="text-2xl font-extrabold text-[#1e3a5f] sm:text-3xl">Calendário Académico {{ $calendar['ano'] }}</h2>
                <p class="mt-3 max-w-2xl leading-relaxed text-slate-600">{{ $preview ? 'Reveja as actividades, datas e documento deste rascunho antes da aprovação institucional.' : 'Consulte as actividades por semestre e as datas do calendário publicado pelo ISP-Bié.' }}</p>
            </div>
            @if($pdfUrl)
                <a href="{{ $pdfUrl }}" target="_blank" rel="noopener" class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-[#1e3a5f] px-6 py-3 font-bold text-white transition-colors hover:bg-[#2563eb] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#1e3a5f]">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 3h11l5 5v13H4V3Zm11 0v5h5M8 13h8M8 17h8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    {{ $preview ? 'Pré-visualizar PDF' : 'Consultar PDF oficial' }}
                </a>
            @endif
        </section>

        <div class="grid gap-7 lg:grid-cols-2">
            @foreach([1 => 'Primeiro Semestre', 2 => 'Segundo Semestre'] as $number => $semester)
                @php
                    $activities = collect($calendar['atividades'])
                        ->where('semestre', $number)
                        ->sortBy([['inicio', 'asc'], ['titulo', 'asc']]);
                @endphp
                <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm" aria-labelledby="semestre-{{ $number }}">
                    <div class="flex items-center gap-4 border-b border-slate-200 bg-slate-50 px-6 py-5 sm:px-8">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#1e3a5f] text-lg font-extrabold text-white">{{ $number }}.º</span>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#c84a20]">{{ $calendar['ano'] }}</p>
                            <h3 id="semestre-{{ $number }}" class="text-xl font-extrabold text-[#1e3a5f]">{{ $semester }}</h3>
                        </div>
                    </div>
                    <div class="space-y-4 p-6 sm:p-8">
                        @forelse($activities as $activity)
                            <article class="rounded-xl border border-slate-200 border-l-4 border-l-[#F05A28] bg-white p-4 sm:p-5">
                                <div class="flex flex-wrap items-start justify-between gap-2">
                                    <h4 class="font-bold text-[#1e3a5f]">{{ $activity['titulo'] }}</h4>
                                    <span class="rounded-full bg-blue-50 px-3 py-1 text-sm font-semibold text-[#1e3a5f]">
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $activity['inicio'])->format('d/m/Y') }}
                                        @if($activity['fim'] !== $activity['inicio'])
                                            – {{ \Carbon\Carbon::createFromFormat('Y-m-d', $activity['fim'])->format('d/m/Y') }}
                                        @endif
                                    </span>
                                </div>
                                @if($activity['descricao'] !== '')
                                    <p class="mt-3 whitespace-pre-line text-sm leading-relaxed text-slate-600">{{ $activity['descricao'] }}</p>
                                @endif
                            </article>
                        @empty
                            <p class="rounded-xl bg-slate-50 p-5 text-slate-600">Não há actividades registadas para este semestre nesta versão do calendário.</p>
                        @endforelse
                    </div>
                </section>
            @endforeach
        </div>
    @else
        <section class="rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-sm sm:p-12" aria-labelledby="calendario-indisponivel">
            <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 text-[#1e3a5f]">
                <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M7 3v4M17 3v4M3 10h18" stroke-linecap="round"/></svg>
            </div>
            <h2 id="calendario-indisponivel" class="text-2xl font-extrabold text-[#1e3a5f]">Calendário académico ainda não publicado</h2>
            <p class="mx-auto mt-3 max-w-xl leading-relaxed text-slate-600">O calendário oficial será apresentado nesta página após a sua aprovação institucional.</p>
        </section>
    @endif
</div>
@endsection
