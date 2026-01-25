@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Estatísticas</h1>
        <a href="{{ route('admin.estatisticas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Nova Estatística</a>
    </div>
    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Ordem</th>
                <th class="py-2 px-4 border-b">Título</th>
                <th class="py-2 px-4 border-b">Valor</th>
                <th class="py-2 px-4 border-b">Descrição</th>
                <th class="py-2 px-4 border-b">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estatisticas as $estatistica)
            <tr>
                <td class="py-2 px-4 border-b">{{ $estatistica->ordem }}</td>
                <td class="py-2 px-4 border-b">{{ $estatistica->titulo }}</td>
                <td class="py-2 px-4 border-b">{{ $estatistica->valor }}</td>
                <td class="py-2 px-4 border-b">{{ $estatistica->descricao }}</td>
                <td class="py-2 px-4 border-b">
                    <a href="{{ route('admin.estatisticas.edit', $estatistica) }}" class="text-blue-600 hover:underline mr-2">Editar</a>
                    <form action="{{ route('admin.estatisticas.destroy', $estatistica) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
