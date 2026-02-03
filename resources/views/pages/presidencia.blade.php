@extends('layouts.site')


@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 scroll-reveal">
    <!-- Breadcrumb -->
    <nav class="text-sm opacity-75 mb-8">
        <a href="/" class="hover:underline">Início</a> \ Órgãos de gestão
    </nav>

    <div class="bg-white rounded-lg shadow-md p-8 mb-10 interactive-card">
        <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Órgãos de gestão</h1>
        <p class="text-lg text-gray-700 mb-4">Instituto Superior Politécnico do Bié</p>
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
                    <a href="/contactos" class="bg-[#2563eb] text-white px-8 py-3 rounded-full font-semibold border border-white hover:bg-white hover:text-[#2563eb] transition-colors">
                        Entre em Contacto
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

