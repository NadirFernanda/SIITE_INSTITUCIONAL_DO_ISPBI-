@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Novo Concurso</h1>

        <form id="concurso-form" action="{{ route('admin.concursos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded shadow">
            @csrf
            <div>
                <label for="concurso_title" class="block text-sm font-medium text-gray-700">Título</label>
                <input id="concurso_title" name="title" required class="mt-1 block w-full border-gray-300 rounded-md" />
            </div>
            <div>
                <label for="concurso_summary" class="block text-sm font-medium text-gray-700">Resumo</label>
                <input id="concurso_summary" name="summary" class="mt-1 block w-full border-gray-300 rounded-md" />
            </div>
            <div>
                <label for="concurso_body" class="block text-sm font-medium text-gray-700">Descrição / Corpo</label>
                <textarea id="concurso_body" name="body" rows="6" class="mt-1 block w-full border-gray-300 rounded-md"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="concurso_status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="concurso_status" name="status" class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="draft">Rascunho</option>
                        <option value="published">Publicado</option>
                    </select>
                </div>
                <div>
                    <label for="concurso_publish_at" class="block text-sm font-medium text-gray-700">Data de Publicação</label>
                    <input id="concurso_publish_at" type="datetime-local" name="publish_at" class="mt-1 block w-full border-gray-300 rounded-md" />
                </div>
            </div>

            <div>
                <label for="concurso_attachments" class="block text-sm font-medium text-gray-700">Anexos (pdf, doc, docx)</label>
                <input id="concurso_attachments" type="file" name="attachments[]" multiple class="mt-1" />
            </div>

            <div>
                <button type="submit" class="px-4 py-2 bg-[#2563eb] text-white rounded">Criar Concurso</button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const form = document.getElementById('concurso-form');
            if (!form) return;
            const btn = form.querySelector('button[type="submit"]');
            if (!btn) return;
            btn.addEventListener('click', function(e){
                form.submit();
            });
        });
    </script>
@endsection
