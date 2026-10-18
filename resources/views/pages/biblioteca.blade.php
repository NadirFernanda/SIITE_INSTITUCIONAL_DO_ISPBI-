@extends('layouts.site')

@section('content')
<div class="institutional-page">
    @include('partials.page-hero', [
        'title' => 'Biblioteca Digital',
        'subtitle' => 'Recursos bibliográficos e informação científica para a comunidade do ISP-Bié.',
        'breadcrumb' => 'Biblioteca Digital',
    ])

    <section class="institutional-card" aria-labelledby="biblioteca-recursos">
        <h2 id="biblioteca-recursos" class="institutional-heading">Acesso a recursos científicos</h2>
        <p class="mt-4 max-w-3xl leading-relaxed text-slate-700">
            O ISP-Bié disponibiliza à sua comunidade académica acesso institucional ao Research4Life.
            Consulte a página dedicada para conhecer os recursos e as instruções de acesso.
        </p>
        <a href="{{ route('research4life') }}"
            class="institutional-button mt-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#F05A28]">
            Conhecer o Research4Life
        </a>
    </section>

    <section class="institutional-card mt-8" aria-labelledby="biblioteca-acervo">
        <h2 id="biblioteca-acervo" class="institutional-heading">Acervo e serviços da Biblioteca</h2>
        <p class="mt-4 max-w-3xl leading-relaxed text-slate-700">
            Para confirmar a disponibilidade de obras ou obter informações sobre os serviços da Biblioteca,
            utilize os contactos institucionais do ISP-Bié.
        </p>
    </section>

    <x-institutional-cta class="mt-10"
        title="Precisa de informações sobre a Biblioteca?"
        description="A equipa do ISP-Bié pode orientar o seu pedido pelos canais institucionais de atendimento."
        button-text="Contactar o ISP-Bié"
        :href="route('contactos')" />
</div>
@endsection
