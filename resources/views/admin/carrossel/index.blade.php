@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Carrosseis</h1>
    <a href="{{ route('admin.carrossel.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Novo Carrossel</a>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2">Imagem</th>
                <th class="py-2">Título</th>
                <th class="py-2">Subtítulo</th>
                <th class="py-2">Texto do Botão</th>
                <th class="py-2">Link</th>
                <th class="py-2">Ordem</th>
                <th class="py-2">Publicado</th>
                <th class="py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carrosseis as $carrossel)
            <tr>
                <td class="py-2">
                    @if($carrossel->imagem)
                        <img src="{{ asset('storage/' . $carrossel->imagem) }}" alt="Imagem" class="w-24 h-16 object-cover rounded">
                    @endif
                </td>
                <td class="py-2">{{ $carrossel->titulo }}</td>
                <td class="py-2">{{ $carrossel->subtitulo }}</td>
                <td class="py-2">{{ $carrossel->texto_botao }}</td>
                <td class="py-2">{{ $carrossel->link }}</td>
                <td class="py-2">{{ $carrossel->ordem }}</td>
                <td class="py-2">
                    <form action="{{ route('admin.carrossel.toggle-publicar', $carrossel->id) }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="px-2 py-1 rounded {{ $carrossel->publicado ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-700' }}">
                            {{ $carrossel->publicado ? 'Publicado' : 'Rascunho' }}
                        </button>
                    </form>
                </td>
                <td class="py-2">
                    <a href="{{ route('admin.carrossel.edit', $carrossel->id) }}" class="text-blue-600 mr-2">Editar</a>
                    <form action="{{ route('admin.carrossel.destroy', $carrossel->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 ml-2">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
