@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Concursos</h1>
            <div class="space-x-2">
                <a href="{{ route('admin.concursos.create') }}" class="px-4 py-2 bg-[#2563eb] text-white rounded">Novo Concurso</a>
                <a href="{{ route('admin.concursos.alerts') }}" class="px-4 py-2 bg-gray-100 border rounded">Assinantes</a>
            </div>
        </div>

        @if(session('status'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
        @endif

        <div class="bg-white rounded shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Título</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Resumo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Descrição</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Anexos</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Publicado</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($concursos as $c)
                        <tr>
                            <td class="px-6 py-4">{{ $c->title }}</td>
                            <td class="px-6 py-4">{{ \Illuminate\Support\Str::limit($c->summary ?? '-', 80) }}</td>
                            <td class="px-6 py-4">{{ \Illuminate\Support\Str::limit($c->body ?? '-', 120) }}</td>
                            <td class="px-6 py-4">{{ $c->attachments->count() }} @if($c->attachments->count()) <a href="{{ route('admin.concursos.edit', $c) }}#attachments" class="text-blue-600 ml-2">ver</a> @endif</td>
                            <td class="px-6 py-4">{{ $c->status }}</td>
                            <td class="px-6 py-4">{{ $c->publish_at ? \Illuminate\Support\Carbon::parse($c->publish_at)->format('Y-m-d H:i') : '-' }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.concursos.edit', $c) }}" class="text-blue-600 mr-3">Editar</a>
                                <form action="{{ route('admin.concursos.destroy', $c) }}" method="POST" class="inline" onsubmit="return confirm('Remover?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600">Remover</button>
                                </form>
                                <form action="{{ route('admin.concursos.resend-alerts', $c) }}" method="POST" class="inline ml-3" onsubmit="return confirm('Reenviar alertas deste concurso para assinantes?')">
                                    @csrf
                                    <button class="text-green-600">Reenviar Alertas</button>
                                </form>
                                <form action="{{ route('admin.concursos.resend-alerts-all', $c) }}" method="POST" class="inline ml-3" onsubmit="return confirm('Enviar alertas deste concurso para TODOS os cadastrados (ignora consentimento)?')">
                                    @csrf
                                    <button class="text-indigo-600">Enviar a Todos</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $concursos->links() }}</div>
    </div>
@endsection
