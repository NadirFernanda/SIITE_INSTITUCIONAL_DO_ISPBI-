@extends('layouts.site')

@section('title', $pagina->titulo)

@section('content')
    <div class="institutional-page scroll-reveal">
        <h1 class="institutional-heading mb-6 border-b-2 border-[#F05A28] pb-4">{{ $pagina->titulo }}</h1>
        <div class="institutional-card prose max-w-none text-lg leading-relaxed text-gray-800">
            {!! nl2br(e($pagina->conteudo)) !!}
        </div>
    </div>
@endsection
