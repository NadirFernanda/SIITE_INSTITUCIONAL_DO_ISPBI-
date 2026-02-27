@extends('layouts.site')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Editar Projecto</h1>

    <form method="POST" action="{{ route('admin.projects.update', $project) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block font-semibold">Título</label>
            <input name="title" value="{{ $project->title }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Resumo</label>
            <textarea name="summary" class="w-full border rounded px-3 py-2" rows="4">{{ $project->summary }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-semibold">Estado</label>
                <select name="status" class="w-full border rounded px-3 py-2">
                    <option value="em_curso" {{ $project->status === 'em_curso' ? 'selected' : '' }}>em_curso</option>
                    <option value="em_avaliacao" {{ $project->status === 'em_avaliacao' ? 'selected' : '' }}>em_avaliacao</option>
                    <option value="concluido" {{ $project->status === 'concluido' ? 'selected' : '' }}>concluido</option>
                </select>
            </div>
            <div>
                <label class="block font-semibold">Data Início</label>
                <input type="date" name="start_date" value="{{ optional($project->start_date)->format('Y-m-d') }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="flex gap-3">
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Salvar</button>
            <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 border rounded">Cancelar</a>
        </div>
    </form>
</div>
@endsection
