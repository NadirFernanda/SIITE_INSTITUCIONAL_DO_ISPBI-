@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-8 max-w-xl">
    <h1 class="text-2xl font-bold mb-6">Nova Notícia</h1>
    <form method="POST" action="{{ route('admin.noticias.store') }}" enctype="multipart/form-data" class="bg-white rounded shadow p-6 space-y-4">
        @csrf
        <div>
            <label for="titulo" class="block font-semibold mb-1">Título</label>
            <input type="text" name="titulo" id="titulo" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>
        <div>
            <label for="texto" class="block font-semibold mb-1">Texto</label>
            <textarea name="texto" id="texto" rows="6" class="w-full border border-gray-300 rounded px-3 py-2" required></textarea>
        </div>
        <div>
            <label for="imagem" class="block font-semibold mb-1">Imagem de destaque</label>
            <input type="file" name="imagem" id="imagem" accept="image/*" class="w-full">
        </div>
        <div>
            <label for="pdf" class="block font-semibold mb-1">Documento PDF (opcional)</label>
            <input type="file" name="pdf" id="pdf" accept="application/pdf" class="w-full">
        </div>
        <div>
            <label for="data" class="block font-semibold mb-1">Data</label>
            <input type="date" name="data" id="data" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>
        <div>
            <label for="institucional" class="block font-semibold mb-1">Notícia institucional?</label>
            <select name="institucional" id="institucional" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Salvar Notícia</button>
        </div>
    </form>
</div>
@endsection
