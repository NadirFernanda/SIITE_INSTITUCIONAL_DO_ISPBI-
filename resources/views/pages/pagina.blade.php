@extends('layouts.site')

@section('title', $pagina->titulo)

@section('content')
    <h1 class="text-3xl md:text-4xl font-extrabold text-[#F05A28] mb-6 tracking-tight border-b-2 border-[#F05A28] pb-2">{{ $pagina->titulo }}</h1>
    <div class="prose max-w-none text-lg text-gray-800 leading-relaxed">
        {!! nl2br(e($pagina->conteudo)) !!}
    </div>
@endsection
