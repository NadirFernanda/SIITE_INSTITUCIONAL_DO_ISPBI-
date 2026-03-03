@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Assinantes ligados ao Concurso: {{ $concurso->title }}</h1>
            <div class="space-x-2">
                <a href="{{ route('admin.concursos.index') }}" class="px-3 py-2 bg-gray-200 rounded">Voltar</a>
                <a href="{{ route('admin.concursos.subscribers.export', $concurso) }}?{{ http_build_query(request()->only('all','q')) }}" class="px-3 py-2 bg-blue-600 text-white rounded">Exportar CSV</a>
            </div>
        </div>

        <form method="GET" class="mb-4">
            <div class="flex items-center gap-3">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar por nome ou email" class="border rounded px-3 py-2 w-96" />
                <button class="px-3 py-2 bg-[#2563eb] text-white rounded">Buscar</button>
            </div>
        </form>

        <div class="bg-white rounded shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Telefone</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Interesses</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Consentimento</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Criado</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($subscribers as $a)
                        <tr>
                            <td class="px-6 py-4">{{ $a->id }}</td>
                            <td class="px-6 py-4">{{ $a->name }}</td>
                            <td class="px-6 py-4">{{ $a->email }}</td>
                            <td class="px-6 py-4">{{ $a->phone ?? '-' }}</td>
                            <td class="px-6 py-4">{{ is_array($a->interests) ? implode(', ', $a->interests) : ($a->interests ?? '-') }}</td>
                            <td class="px-6 py-4">{{ $a->consent ? 'Sim' : 'Nao' }}</td>
                            <td class="px-6 py-4">{{ optional($a->created_at)->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $subscribers->links() }}</div>
    </div>
@endsection
