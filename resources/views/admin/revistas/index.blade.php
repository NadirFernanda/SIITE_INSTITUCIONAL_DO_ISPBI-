@extends('layouts.site')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        <nav class="text-sm text-gray-500 mb-6">
            <a href="/" class="hover:underline">Início</a>
            <span class="mx-2">/</span>
            <span class="font-medium text-gray-700">Submissões da Revista</span>
        </nav>

        <header class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 flex items-center justify-center bg-blue-600 text-white rounded-md shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2v4h6v-4c0-1.105-1.343-2-3-2z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Submissões da Revista</h1>
                    <p class="text-gray-600">Gerencie submissões pendentes e publicadas da Revista Científica.</p>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-3 justify-end">
                <a href="{{ route('revista') }}" target="_blank" class="text-sm text-gray-600 hover:underline">Ver site público</a>
                <a href="{{ route('admin.revistas') }}" class="inline-flex items-center gap-2 bg-[#2563eb] text-white px-4 py-2 rounded-md shadow-sm hover:bg-[#1f4fb6] text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor"><path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z" /></svg>
                    <span>Atualizar</span>
                </a>
            </div>
        </header>

        @if(session('status'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-800 rounded">{{ session('status') }}</div>
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
                    <select name="category" class="border rounded px-4 py-2">
                        <option value="">Todas as áreas</option>
                        <option value="Engenharias e Tecnologia" {{ request('category')=='Engenharias e Tecnologia' ? 'selected' : '' }}>Engenharias e Tecnologia</option>
                        <option value="Ciências da Saúde" {{ request('category')=='Ciências da Saúde' ? 'selected' : '' }}>Ciências da Saúde</option>
                        <option value="Ciências Sociais e Humanas" {{ request('category')=='Ciências Sociais e Humanas' ? 'selected' : '' }}>Ciências Sociais e Humanas</option>
                    </select>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 bg-blue-600 text-white rounded">Filtrar</button>
                        <a href="{{ route('admin.revistas') }}" class="px-4 py-2 bg-blue-600 text-white rounded text-sm">Limpar</a>
                    </div>
                </form>
            </div>

            <div class="p-6">
                <div class="overflow-auto">
                    <table class="min-w-full divide-y divide-gray-200 bg-white rounded-lg shadow-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Autor</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Título</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Área</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Criado em</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($submissions as $s)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 text-sm text-gray-700">{{ $s->id }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-700">{{ $s->author }}</td>
                                    <td class="px-4 py-4 text-sm font-medium text-[#2563eb]"><a href="{{ route('admin.revistas.show', $s->id) }}" class="hover:underline">{{ $s->title }}</a></td>
                                    <td class="px-4 py-4 text-sm text-gray-700">{{ $s->category ?? '-' }}</td>
                                    <td class="px-4 py-4 text-sm">
                                        @if($s->status === 'published')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Publicado</span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Pendente</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500">{{ $s->created_at->format('Y-m-d') }}</td>
                                    <td class="px-4 py-4 text-sm text-right flex gap-2 justify-end">
                                        <a href="{{ route('admin.revistas.edit', $s->id) }}" class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium bg-[#2563eb] text-white rounded-md hover:bg-[#1f4fb6] transition">Editar</a>
                                        @if($s->status !== 'published')
                                            <form action="{{ route('admin.revistas.publish', $s->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                <button class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium bg-green-600 text-white rounded-md hover:bg-green-700 transition">Publicar</button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.revistas.destroy', $s->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Eliminar submissão?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium bg-red-600 text-white rounded-md hover:bg-red-700 transition">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7" class="px-4 py-4 text-sm text-gray-700 border-t">{{ $s->description }} @if($s->link) — <a href="{{ $s->link }}" target="_blank" class="text-indigo-600 hover:underline">Link</a>@endif</td>
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
