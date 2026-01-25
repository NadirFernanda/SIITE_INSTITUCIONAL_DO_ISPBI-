@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-10 max-w-5xl">
    <h1 class="text-4xl font-bold mb-8 text-gray-900">Notícias</h1>
    <a href="{{ route('admin.noticias.create') }}" class="mb-6 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition font-semibold">Nova Notícia</a>
    <div class="bg-white rounded-xl shadow-lg p-8">
        @if($noticias->isEmpty())
            <div class="text-gray-500 mt-4 text-lg">Nenhuma notícia cadastrada ainda.</div>
        @else
        <div class="overflow-x-auto">
        <table class="min-w-full text-base text-left">
            <thead>
                <tr class="bg-blue-50 text-blue-900">
                    <th class="py-3 px-4 font-semibold">Título</th>
                    <th class="py-3 px-4 font-semibold">Data</th>
                    <th class="py-3 px-4 font-semibold">Imagem</th>
                    <th class="py-3 px-4 font-semibold">PDF</th>
                    <th class="py-3 px-4 font-semibold">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($noticias as $noticia)
                <tr class="border-b hover:bg-blue-50">
                    <td class="py-3 px-4">{{ $noticia->titulo }}</td>
                    <td class="py-3 px-4">{{ $noticia->data }}</td>
                    <td class="py-3 px-4">
                        @if($noticia->imagem)
                            <a href="{{ asset('storage/' . $noticia->imagem) }}" target="_blank" class="text-blue-600 underline">Ver imagem</a>
                        @else
                            <span class="text-gray-400 italic">Sem imagem</span>
                        @endif
                    </td>
                    <td class="py-3 px-4">
                        @if($noticia->pdf)
                            <a href="{{ asset('storage/' . $noticia->pdf) }}" target="_blank" class="text-blue-600 underline font-medium">Ver PDF</a>
                        @else
                            <span class="text-gray-400 italic">Sem PDF</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 space-x-2">
                        <a href="{{ route('noticias') }}#noticia-{{ $noticia->id }}" target="_blank" class="inline-block bg-gray-200 text-blue-700 px-4 py-1.5 rounded-lg shadow hover:bg-blue-100 transition font-semibold">Ver</a>
                        <form method="POST" action="{{ route('admin.noticias.toggle-publicar', $noticia->id) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="inline-block px-4 py-1.5 rounded-lg shadow font-semibold {{ $noticia->publicada ? 'bg-yellow-500 text-white hover:bg-yellow-600' : 'bg-green-600 text-white hover:bg-green-700' }}">
                                {{ $noticia->publicada ? 'Despublicar' : 'Publicar' }}
                            </button>
                        </form>
                        <button onclick="window.location='{{ route('admin.noticias.edit', $noticia->id) }}'" type="button" class="inline-block bg-blue-600 text-white px-4 py-1.5 rounded-lg shadow hover:bg-blue-700 transition font-semibold">Editar</button>
                        <form method="POST" action="{{ route('admin.noticias.destroy', $noticia->id) }}" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja apagar esta notícia?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-block bg-red-600 text-white px-4 py-1.5 rounded-lg shadow hover:bg-red-700 transition font-semibold">Apagar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        @endif
    </div>
</div>
@endsection
