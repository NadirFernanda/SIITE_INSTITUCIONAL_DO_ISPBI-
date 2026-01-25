@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Visualizar Estatística</h1>
    <div class="bg-white p-6 rounded shadow max-w-lg mx-auto">
        <div class="mb-4">
            <strong>Título:</strong> {{ $estatistica->titulo }}
        </div>
        <div class="mb-4">
            <strong>Valor:</strong> {{ $estatistica->valor }}
        </div>
        <div class="mb-4">
            <strong>Descrição:</strong> {{ $estatistica->descricao }}
        </div>
        <div class="mb-4">
            <strong>Ordem:</strong> {{ $estatistica->ordem }}
        </div>
        <div class="mb-4">
            <strong>Ícone:</strong> {{ $estatistica->icone }}
        </div>
        <a href="{{ route('admin.estatisticas.index') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Voltar</a>
    </div>
</div>
@endsection
