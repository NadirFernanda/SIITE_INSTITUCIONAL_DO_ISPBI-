@extends('layouts.site')

@section('content')
<div class="max-w-md mx-auto py-12 px-4">
    <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-all flex flex-col">
        @if($noticia->imagem)
            <img src="{{ asset('storage/' . $noticia->imagem) }}" alt="Imagem da notícia" class="h-72 w-full object-cover">
        @else
            <div class="h-72 w-full flex items-center justify-center bg-gradient-to-br from-[#2563eb] to-[#3B82F6]">
                <svg class="w-16 h-16 text-white opacity-60" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/></svg>
            </div>
        @endif
        <div class="p-6 flex-1 flex flex-col">
            <div class="text-sm text-gray-500 mb-2">{{ \Carbon\Carbon::parse($noticia->data)->format('d/m/Y') }}</div>
            <h1 class="text-2xl font-bold text-[#2563eb] mb-3">{{ $noticia->titulo }}</h1>
            <div class="text-gray-700 text-base mb-4">{!! nl2br(e($noticia->texto)) !!}</div>
            @if($noticia->pdf)
                <a href="{{ asset('storage/' . $noticia->pdf) }}" target="_blank" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition mb-4">Ver PDF</a>
            @endif
            <a href="/noticias" class="text-blue-600 hover:underline mt-auto">← Voltar para notícias</a>
        </div>
    </article>
</div>
@endsection
