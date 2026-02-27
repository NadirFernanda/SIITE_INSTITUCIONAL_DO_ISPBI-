@extends('layouts.site')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
        <h1 class="text-2xl font-bold mb-4">Submissões da Revista</h1>

        @if(session('status'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
        @endif

        <div class="bg-white shadow rounded p-4">
            <form method="GET" class="mb-4 flex gap-2 items-center">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Pesquisar título ou autor" class="border rounded p-2" />
                <select name="status" class="border rounded p-2">
                    <option value="">Todos os estados</option>
                    <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pendente</option>
                    <option value="published" {{ request('status')=='published' ? 'selected' : '' }}>Publicado</option>
                </select>
                <input type="text" name="category" value="{{ request('category') }}" placeholder="Categoria" class="border rounded p-2" />
                <button class="px-3 py-2 bg-blue-600 text-white rounded">Filtrar</button>
            </form>

            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-3 text-left">ID</th>
                        <th class="p-3 text-left">Autor</th>
                        <th class="p-3 text-left">Título</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Criado em</th>
                        <th class="p-3 text-left">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submissions as $s)
                        <tr class="border-t">
                            <td class="p-3">{{ $s->id }}</td>
                            <td class="p-3">{{ $s->author }}</td>
                            <td class="p-3"><a href="{{ route('admin.revistas.show', $s->id) }}" class="underline">{{ $s->title }}</a></td>
                            <td class="p-3">{{ $s->status }}</td>
                            <td class="p-3">{{ $s->created_at->format('Y-m-d') }}</td>
                            <td class="p-3">
                                <a href="{{ route('admin.revistas.edit', $s->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Editar</a>
                                @if($s->status !== 'published')
                                    <form action="{{ route('admin.revistas.publish', $s->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        <button class="px-3 py-1 bg-green-600 text-white rounded">Publicar</button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.revistas.destroy', $s->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Eliminar submissão?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 bg-red-600 text-white rounded">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="p-3 text-sm text-gray-700">{{ $s->description }} @if($s->link) — <a href="{{ $s->link }}" target="_blank" class="underline">Link</a>@endif</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-4">
                {{ $submissions->links() }}
            </div>
        </div>
    </div>
@endsection
