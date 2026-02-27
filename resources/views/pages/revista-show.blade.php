@extends('layouts.site')


@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <nav class="text-sm text-gray-500 mb-4">
            <a href="/" class="hover:underline">Início</a>
            <span class="mx-2">/</span>
            <a href="{{ route('revista') }}" class="hover:underline">Revista Científica</a>
            <span class="mx-2">/</span>
            <span class="font-medium text-gray-700">{{ $article->title }}</span>
        </nav>

        <article class="bg-white shadow rounded-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900">{{ $article->title }}</h1>
            <p class="text-sm text-gray-600 mt-2">Por {{ $article->author }}@if($article->affiliation) — {{ $article->affiliation }}@endif</p>
            <p class="text-sm text-gray-500 mt-1">Publicado em: {{ $article->published_at ? $article->published_at->format('d F, Y') : $article->created_at->format('d F, Y') }}</p>

            <div class="prose mt-6 text-gray-800">
                {!! nl2br(e($article->description)) !!}
            </div>

            @if($article->link)
                <div class="mt-6">
                    <a href="{{ $article->link }}" target="_blank" rel="noopener" class="inline-block bg-blue-600 text-white px-4 py-2 rounded">Abrir ficheiro do artigo</a>
                </div>
            @endif
        </article>
    </div>
@endsection
