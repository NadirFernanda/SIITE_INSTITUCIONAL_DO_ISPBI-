@extends('layouts.site')

@section('title', $calendar ? 'Calendário Académico '.$calendar['ano'] : 'Calendário Académico')
@section('meta_description', 'Consulte o calendário académico oficialmente publicado pelo Instituto Superior Politécnico do Bié.')

@section('content')
<div class="institutional-page">
    @include('partials.page-hero', [
        'title' => 'Calendário Académico',
        'subtitle' => $calendar ? 'Ano académico '.$calendar['ano'] : 'Informação académica oficial do ISP-Bié',
        'breadcrumb' => 'Calendário Académico',
    ])

    @if($preview)
        <p role="status" class="mb-6 rounded-xl border border-amber-300 bg-amber-50 px-5 py-4 font-semibold text-amber-900">
            Pré-visualização privada. Esta versão ainda não está publicada.
        </p>
    @endif

    @if($calendar && $pdfUrl)
        <section class="institutional-card" aria-labelledby="calendario-documento">
            <h2 id="calendario-documento" class="institutional-heading">Calendário Académico {{ $calendar['ano'] }}</h2>
            <p class="mt-3 max-w-3xl leading-relaxed text-slate-600">Consulte o documento oficial do calendário académico do ISP-Bié.</p>

            <div class="mt-6 overflow-hidden rounded-xl border border-slate-200 bg-slate-50">
                <iframe src="{{ $pdfUrl }}" title="Visualização do Calendário Académico {{ $calendar['ano'] }} em PDF"
                    class="block h-[65vh] min-h-[420px] w-full sm:h-[760px]" loading="lazy"></iframe>
            </div>

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ $pdfUrl }}" target="_blank" rel="noopener noreferrer" class="institutional-button">
                    {{ $preview ? 'Pré-visualizar PDF' : 'Consultar PDF' }}
                </a>
                @if(! $preview && $downloadUrl)
                    <a href="{{ $downloadUrl }}" class="inline-flex items-center justify-center rounded-xl border border-[#1e3a5f] px-6 py-3 font-bold text-[#1e3a5f] transition-colors hover:bg-blue-50">
                        Descarregar PDF
                    </a>
                @endif
            </div>
        </section>
    @else
        <section class="institutional-card text-center" aria-labelledby="calendario-indisponivel">
            <h2 id="calendario-indisponivel" class="institutional-heading">
                {{ $preview ? 'PDF ainda não carregado no rascunho' : 'Calendário académico ainda não publicado' }}
            </h2>
            <p class="mx-auto mt-3 max-w-xl leading-relaxed text-slate-600">
                {{ $preview ? 'Carregue o documento oficial para concluir a pré-visualização.' : 'O documento oficial será apresentado nesta página após a sua aprovação institucional.' }}
            </p>
        </section>
    @endif

    <section class="py-12 sm:py-16">
        <x-institutional-cta title="Informações académicas"
            description="Para esclarecimentos sobre o calendário académico, utilize os contactos institucionais do ISP-Bié."
            button-text="Contactar o ISP-Bié" :href="route('contactos')" />
    </section>
</div>
@endsection
