@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Editar Carrossel</h1>
    <form action="{{ route('admin.carrossel.update', $carrossel->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow max-w-lg mx-auto">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block font-semibold mb-1">Título</label>
            <input type="text" name="titulo" class="w-full border rounded px-3 py-2" value="{{ $carrossel->titulo }}" required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Subtítulo</label>
            <input type="text" name="subtitulo" class="w-full border rounded px-3 py-2" value="{{ $carrossel->subtitulo }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Texto do Botão</label>
            <input type="text" name="texto_botao" class="w-full border rounded px-3 py-2" value="{{ $carrossel->texto_botao }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Link</label>
            <input type="text" name="link" class="w-full border rounded px-3 py-2" value="{{ $carrossel->link }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Ordem</label>
            <input type="number" name="ordem" class="w-full border rounded px-3 py-2" value="{{ $carrossel->ordem }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Imagem</label>
            <input type="file" name="imagem" class="w-full border rounded px-3 py-2">
            @if($carrossel->imagem)
                <img src="{{ asset('storage/' . $carrossel->imagem) }}" alt="Imagem atual" class="mt-2 w-32 h-20 object-cover">
            @endif
        </div>
        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="publicado" value="1" class="form-checkbox" {{ $carrossel->publicado ? 'checked' : '' }}>
                <span class="ml-2">Publicar</span>
            </label>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Atualizar</button>
        </div>
    </form>
</div>
@endsection
