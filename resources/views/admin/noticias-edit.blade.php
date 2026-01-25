@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-8 max-w-xl">
    <h1 class="text-2xl font-bold mb-6">Editar Notícia</h1>
    <form method="POST" action="{{ route('admin.noticias.update', $noticia->id) }}" enctype="multipart/form-data" class="bg-white rounded shadow p-6 space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="titulo" class="block font-semibold mb-1">Título</label>
            <input type="text" name="titulo" id="titulo" class="w-full border border-gray-300 rounded px-3 py-2" value="{{ $noticia->titulo }}" required>
        </div>
        <div>
            <label for="texto" class="block font-semibold mb-1">Texto</label>
            <textarea name="texto" id="texto" rows="6" class="w-full border border-gray-300 rounded px-3 py-2" required>{{ $noticia->texto }}</textarea>
        </div>
        <div>
            <label for="imagem" class="block font-semibold mb-1">Imagem de destaque</label>
            @if($noticia->imagem)
                <img src="{{ asset('storage/' . $noticia->imagem) }}" alt="Imagem" class="h-12 max-w-[80px] max-h-[80px] mb-2 rounded object-cover">
            @endif
            <input type="file" name="imagem" id="imagem" accept="image/*" class="w-full">
        </div>
        <div>
            <label for="pdf" class="block font-semibold mb-1">Documento PDF (opcional)</label>
            @if($noticia->pdf)
                <a href="{{ asset('storage/' . $noticia->pdf) }}" target="_blank" class="text-blue-600 underline">Ver PDF atual</a>
            @endif
            <input type="file" name="pdf" id="pdf" accept="application/pdf" class="w-full">
        </div>
        <div>
            <label for="data" class="block font-semibold mb-1">Data</label>
            <input type="date" name="data" id="data" class="w-full border border-gray-300 rounded px-3 py-2" value="{{ $noticia->data }}" required>
        </div>
        <div>
            <label for="institucional" class="block font-semibold mb-1">Notícia institucional?</label>
            <select name="institucional" id="institucional" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="0" @if(!$noticia->institucional) selected @endif>Não</option>
                <option value="1" @if($noticia->institucional) selected @endif>Sim</option>
            </select>
        </div>
        <div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Salvar Alterações</button>
        </div>
    </form>
</div>
@endsection
