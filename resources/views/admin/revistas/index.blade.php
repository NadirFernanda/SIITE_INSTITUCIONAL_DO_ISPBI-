@extends('layouts.site')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold">Submissões da Revista</h1>
                <p class="text-gray-600 mt-1">Gerencie submissões pendentes e publicadas da Revista Científica.</p>
            </div>
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ route('revista') }}" target="_blank" class="text-sm text-gray-600 hover:underline">Ver site público</a>
                <a href="{{ route('admin.revistas') }}" class="inline-flex items-center gap-2 bg-white border px-3 py-2 rounded shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor"><path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z" /></svg>
                    <span class="text-sm">Atualizar</span>
                </a>
            </div>
        </div>

        @if(session('status'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
        @endif

        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-3 items-center">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Pesquisar título ou autor" class="col-span-2 border rounded px-4 py-2" />
                    <select name="status" class="border rounded px-4 py-2">
                        <option value="">Todos os estados</option>
                        <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pendente</option>
                        <option value="published" {{ request('status')=='published' ? 'selected' : '' }}>Publicado</option>
                    </select>
                    <input type="text" name="category" value="{{ request('category') }}" placeholder="Categoria" class="border rounded px-4 py-2" />
                    <div class="flex gap-2">
                        <button class="px-4 py-2 bg-blue-600 text-white rounded">Filtrar</button>
                        <a href="{{ route('admin.revistas') }}" class="px-4 py-2 border rounded text-sm">Limpar</a>
                    </div>
                </form>
            </div>

            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Autor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criado em</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($submissions as $s)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $s->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $s->author }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600"><a href="{{ route('admin.revistas.show', $s->id) }}">{{ $s->title }}</a></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($s->status === 'published')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Publicado</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pendente</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $s->created_at->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex gap-2 justify-end">
                                        <a href="{{ route('admin.revistas.edit', $s->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Editar</a>
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
                                    <td colspan="6" class="px-6 py-4 text-sm text-gray-700">{{ $s->description }} @if($s->link) — <a href="{{ $s->link }}" target="_blank" class="underline text-blue-600">Link</a>@endif</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $submissions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
