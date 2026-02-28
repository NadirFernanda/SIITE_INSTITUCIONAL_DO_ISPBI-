@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Novo Concurso</h1>

        <form action="{{ route('admin.concursos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded shadow">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Título</label>
                <input name="title" required class="mt-1 block w-full border-gray-300 rounded-md" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Resumo</label>
                <input name="summary" class="mt-1 block w-full border-gray-300 rounded-md" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Descrição / Corpo</label>
                <textarea name="body" rows="6" class="mt-1 block w-full border-gray-300 rounded-md"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="draft">Rascunho</option>
                        <option value="published">Publicado</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Data de Publicação</label>
                    <input type="datetime-local" name="publish_at" class="mt-1 block w-full border-gray-300 rounded-md" />
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Anexos (pdf, doc, docx)</label>
                <input type="file" name="attachments[]" multiple class="mt-1" />
            </div>

            <div>
                <button type="submit" class="px-4 py-2 bg-[#2563eb] text-white rounded">Criar Concurso</button>
            </div>
        </form>
    </div>
@endsection
