@extends('layouts.site')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-16">
    @include('partials.page-hero', [
        'title'      => $noticia->titulo,
        'subtitle'   => \Carbon\Carbon::parse($noticia->data)->translatedFormat('d \d\e F \d\e Y'),
        'breadcrumb' => 'Notícias',
    ])

    <article class="bg-white rounded-2xl shadow-md overflow-hidden">
        @if($noticia->imagem)
            <div class="relative w-full" style="aspect-ratio:16/9; overflow:hidden;">
                <img src="{{ asset('storage/' . $noticia->imagem) }}"
                     alt="{{ $noticia->titulo }}"
                     class="absolute inset-0 w-full h-full object-contain bg-gray-50">
            </div>
        @endif

        <div class="p-8">
            <div class="flex items-center gap-3 text-sm text-gray-500 mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ \Carbon\Carbon::parse($noticia->data)->format('d/m/Y') }}
            </div>

            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                {!! nl2br(e($noticia->texto)) !!}
            </div>

            @if($noticia->pdf)
                <div class="mt-8">
                    <a href="{{ asset('storage/' . $noticia->pdf) }}" target="_blank"
                       class="inline-flex items-center gap-2 bg-[#2563eb] text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Ver documento PDF
                    </a>
                </div>
            @endif

            <div class="mt-10 pt-6 border-t border-gray-100">
                <a href="{{ route('noticias') }}" class="inline-flex items-center gap-2 text-[#2563eb] font-semibold hover:underline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Voltar para Notícias
                </a>
            </div>
        </div>
    </article>
</div>
@endsection
