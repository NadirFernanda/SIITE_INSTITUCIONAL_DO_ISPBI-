@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Assinantes - Alertas de Concursos</h1>
            <a href="{{ route('admin.concursos.index') }}" class="px-4 py-2 bg-gray-200 rounded">Voltar</a>
        </div>

        <div class="bg-white rounded shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Telefone</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Interesses</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Consentimento</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Criado em</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($alerts as $a)
                        <tr>
                            <td class="px-6 py-4">{{ $a->name }}</td>
                            <td class="px-6 py-4">{{ $a->email }}</td>
                            <td class="px-6 py-4">{{ $a->phone ?? '-' }}</td>
                            <td class="px-6 py-4">{{ is_array($a->interests) ? implode(', ', $a->interests) : ($a->interests ?? '-') }}</td>
                            <td class="px-6 py-4">{{ $a->consent ? 'Sim' : 'Não' }}</td>
                            <td class="px-6 py-4">{{ $a->created_at ? $a->created_at->format('Y-m-d H:i') : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $alerts->links() }}</div>
    </div>
@endsection
