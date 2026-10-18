@extends('layouts.site')


@section('content')
    <div class="institutional-page">
        @include('partials.page-hero', [
            'title' => $article->title,
            'breadcrumb' => $article->title,
            'parentUrl' => route('revista'),
            'parentLabel' => 'Revista Científica',
        ])

        <article class="institutional-card">
            <p class="text-sm text-gray-600 mt-2">Por {{ $article->author }}@if($article->affiliation) — {{ $article->affiliation }}@endif</p>
            <p class="text-sm text-gray-500 mt-1">Publicado em: {{ $article->published_at ? $article->published_at->format('d F, Y') : $article->created_at->format('d F, Y') }}</p>

            <div class="prose mt-6 text-gray-800">
                {!! nl2br(e($article->description)) !!}
            </div>

            @if($article->link && preg_match('/^https?:\/\//i', $article->link))
                <div class="mt-6">
                    <a href="{{ $article->link }}" target="_blank" rel="noopener" class="institutional-button">Abrir ficheiro do artigo</a>
                </div>
            @endif
        </article>
    </div>
@endsection
