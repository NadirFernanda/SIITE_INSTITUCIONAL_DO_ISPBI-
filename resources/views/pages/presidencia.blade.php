@extends('layouts.site')


@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-10">
@include('partials.page-hero', [
    'title'      => 'Órgãos de Gestão',
    'subtitle'   => 'Estrutura orgânica e governança institucional do ISP-Bié.',
    'breadcrumb' => 'Órgãos de Gestão',
])

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 mb-8">
        <div class="overflow-x-auto rounded-xl border border-gray-100 bg-white">
            <img
                src="{{ asset('images/organigrama.jpeg') }}"
                alt="Organigrama institucional do Instituto Superior Politécnico do Bié"
                class="w-full h-auto object-contain"
            >
        </div>
    </div>

    <!-- CTA de Governança -->
    <section class="py-16 scroll-reveal">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[#2563eb] rounded-2xl p-12 text-center text-white interactive-card">
                <h2 class="text-3xl font-bold mb-4">Governança</h2>
                <p class="text-xl mb-8 opacity-90">
                    Acompanhe as ações e decisões dos Órgãos de gestão do ISP-Bié
                </p>
                <div class="flex justify-center">
                    <a href="/noticias" class="bg-[#2563eb] text-white px-8 py-3 rounded-full font-semibold border border-white hover:bg-white hover:text-[#2563eb] transition-colors">
                        Informe-se
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

