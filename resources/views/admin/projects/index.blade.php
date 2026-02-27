@extends('layouts.site')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Projectos</h1>
        <a href="{{ route('admin.projects.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Novo Projecto</a>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <div class="bg-white/90 dark:bg-gray-800 rounded-lg p-4">
        <table class="w-full table-auto">
            <thead>
                <tr class="text-left">
                    <th>Título</th>
                    <th>Estado</th>
                    <th>Início</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $p)
                    <tr class="border-t">
                        <td class="py-3">{{ $p->title }}</td>
                        <td>{{ $p->status }}</td>
                        <td>{{ optional($p->start_date)->format('Y-m-d') }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.projects.edit', $p) }}" class="mr-2 text-blue-600">Editar</a>
                            <form action="{{ route('admin.projects.destroy', $p) }}" method="POST" class="inline-block" onsubmit="return confirm('Eliminar?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $projects->links() }}</div>
    </div>
</div>
@endsection
