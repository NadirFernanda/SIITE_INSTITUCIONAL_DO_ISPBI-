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

    @if($calendar)
        <section class="institutional-card" aria-labelledby="calendario-documento">
            <h2 id="calendario-documento" class="institutional-heading">Calendário Académico {{ $calendar['ano'] }}</h2>
            <p class="mt-3 max-w-3xl leading-relaxed text-slate-600">Consulte a imagem oficial do calendário académico do ISP-Bié.</p>

            <div class="mt-6 overflow-hidden rounded-xl border border-slate-200 bg-white">
                <img src="{{ route('calendario-academico.imagem') }}"
                    alt="Calendário Académico {{ $calendar['ano'] }} do Instituto Superior Politécnico do Bié"
                    class="block h-auto w-full object-contain" loading="lazy">
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('calendario-academico.imagem') }}" target="_blank" rel="noopener noreferrer" class="institutional-button">
                    Ampliar calendário <span class="sr-only">(abre numa nova janela)</span>
                </a>
            </div>
        </section>
    @else
        <section class="institutional-card text-center" aria-labelledby="calendario-indisponivel">
            <h2 id="calendario-indisponivel" class="institutional-heading">Calendário académico ainda não publicado</h2>
            <p class="mx-auto mt-3 max-w-xl leading-relaxed text-slate-600">
                A imagem oficial será apresentada nesta página após a sua publicação institucional.
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
