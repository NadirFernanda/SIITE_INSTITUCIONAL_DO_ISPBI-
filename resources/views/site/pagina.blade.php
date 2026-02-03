@extends('layouts.site')

@section('title', $pagina->titulo)

@section('content')
    <h1 class="text-3xl font-bold mb-6">{{ $pagina->titulo }}</h1>
    <div class="prose max-w-none">
        {{ nl2br(e($pagina->conteudo)) }}
    </div>
@endsection
