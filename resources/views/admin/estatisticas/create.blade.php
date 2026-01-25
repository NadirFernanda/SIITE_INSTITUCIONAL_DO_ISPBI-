@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Nova Estatística</h1>
    <form action="{{ route('admin.estatisticas.store') }}" method="POST" class="bg-white p-6 rounded shadow max-w-lg mx-auto">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold mb-1">Título</label>
            <input type="text" name="titulo" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Valor</label>
            <input type="text" name="valor" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Descrição</label>
            <input type="text" name="descricao" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Ordem</label>
            <input type="number" name="ordem" class="w-full border rounded px-3 py-2" value="0">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Ícone (opcional)</label>
            <input type="text" name="icone" class="w-full border rounded px-3 py-2">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Salvar</button>
        </div>
    </form>
</div>
@endsection
