@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Editar Concurso</h1>

        <form action="{{ route('admin.concursos.update', $concurso) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')
            <div>
                <label for="concurso_title" class="block text-sm font-medium text-gray-700">Título</label>
                <input id="concurso_title" name="title" value="{{ old('title', $concurso->title) }}" required class="mt-1 block w-full border-gray-300 rounded-md" />
            </div>
            <div>
                <label for="concurso_summary" class="block text-sm font-medium text-gray-700">Resumo</label>
                <input id="concurso_summary" name="summary" value="{{ old('summary', $concurso->summary) }}" class="mt-1 block w-full border-gray-300 rounded-md" />
            </div>
            <div>
                <label for="concurso_body" class="block text-sm font-medium text-gray-700">Descrição / Corpo</label>
                <textarea id="concurso_body" name="body" rows="6" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('body', $concurso->body) }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="concurso_status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="concurso_status" name="status" class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="draft" {{ $concurso->status==='draft'?'selected':'' }}>Rascunho</option>
                        <option value="published" {{ $concurso->status==='published'?'selected':'' }}>Publicado</option>
                    </select>
                </div>
                <div>
                    <label for="concurso_publish_at" class="block text-sm font-medium text-gray-700">Data de Publicação</label>
                    <input id="concurso_publish_at" type="datetime-local" name="publish_at" value="{{ optional($concurso->publish_at)->format('Y-m-d\TH:i') }}" class="mt-1 block w-full border-gray-300 rounded-md" />
                </div>
            </div>

            <div>
                <label for="concurso_attachments" class="block text-sm font-medium text-gray-700">Anexos (pdf, doc, docx)</label>
                <input id="concurso_attachments" type="file" name="attachments[]" multiple class="mt-1" />
            </div>

            @if($concurso->attachments->isNotEmpty())
                <div class="bg-gray-50 p-4 rounded">
                    <h4 class="font-semibold mb-2">Anexos Existentes</h4>
                    <ul class="space-y-2">
                        @foreach($concurso->attachments as $att)
                                <li class="flex items-center justify-between">
                                    <a href="{{ Storage::url($att->path) }}" target="_blank" class="text-blue-600">{{ $att->original_name }}</a>
                                    <form action="{{ route('admin.concursos.attachments.destroy', $att->id) }}" method="POST" onsubmit="return confirm('Remover anexo?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 ml-4">Remover</button>
                                    </form>
                                </li>
                            @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <button type="submit" class="px-4 py-2 bg-[#2563eb] text-white rounded">Atualizar Concurso</button>
            </div>
        </form>
    </div>
@endsection
