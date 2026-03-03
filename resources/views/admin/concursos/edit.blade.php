@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Editar Concurso</h1>

        <form id="concurso-form" action="{{ route('admin.concursos.update', $concurso) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded shadow">
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

            <div class="flex items-center space-x-3">
                <button type="button" id="concurso-submit-btn" class="px-4 py-2 bg-[#2563eb] text-white rounded cursor-pointer">Salvar</button>
                <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Cancelar</a>
            </div>
        </form>
            }, {capture:false});
        })();
    </script>
    <!-- Fallback AJAX submit: contorna handlers que bloqueiam o submit nativo -->
    <script>
        (function(){
            const form = document.getElementById('concurso-form');
            if (!form) return;

            // If any other handler prevents submission, this will perform the submit via fetch
            form.addEventListener('submit', function(e){
                // If native submit already proceeding (e.g., via form.submit()), allow it
                if (e && e.defaultPrevented && window.__concurso_native_submitting) return;
                e.preventDefault();
                // Avoid double submissions
                if (window.__concurso_submitting) return;
                window.__concurso_submitting = true;

                const submitBtn = form.querySelector('input[type="submit"], button[type="submit"]');
                if (submitBtn) submitBtn.disabled = true;

                const fd = new FormData(form);
                // Ensure method spoofing is present for Laravel (we'll use POST with _method=PUT)
                if (!fd.has('_method')) fd.append('_method','PUT');

                fetch(form.action, {
                    method: 'POST',
                    body: fd,
                    credentials: 'same-origin',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).then(async (res) => {
                    // If the app redirects, follow
                    if (res.redirected) {
                        window.location.href = res.url;
                        return;
                    }

                    // On success status, redirect to index or show message
                    if (res.ok) {
                        // Try to redirect to admin list
                        try { window.location.href = '/admin/concursos'; } catch(e){ alert('Concurso atualizado.'); }
                        return;
                    }

                    // If not ok, show response text for debugging
                    const txt = await res.text();
                    console.error('Concurso update failed', res.status, txt);
                    alert('Erro ao atualizar (código ' + res.status + '). Ver consola para detalhes.');
                }).catch(err => {
                    console.error('Network error submitting concurso', err);
                    alert('Erro de rede ao submeter o formulário.');
                }).finally(() => {
                    window.__concurso_submitting = false;
                    if (submitBtn) submitBtn.disabled = false;
                });
            }, {capture:false});
        })();
    </script>
    <script>
        // Direct click handler on the new button: triggers the same AJAX submit
        (function(){
            const form = document.getElementById('concurso-form');
            const btn = document.getElementById('concurso-submit-btn');
            if (!form || !btn) return;

            btn.addEventListener('click', function(ev){
                ev.preventDefault();
                if (window.__concurso_submitting) return;
                window.__concurso_submitting = true;
                btn.disabled = true;

                const fd = new FormData(form);
                if (!fd.has('_method')) fd.append('_method','PUT');

                fetch(form.action, {
                    method: 'POST',
                    body: fd,
                    credentials: 'same-origin',
                    headers: {'X-Requested-With':'XMLHttpRequest'}
                }).then(async (res) => {
                    if (res.redirected) { window.location.href = res.url; return; }
                    if (res.ok) { window.location.href = '/admin/concursos'; return; }
                    const txt = await res.text();
                    console.error('Concurso update failed', res.status, txt);
                    alert('Erro ao atualizar (código ' + res.status + '). Ver consola para detalhes.');
                }).catch(err=>{
                    console.error('Network error submitting concurso', err);
                    alert('Erro de rede ao submeter o formulário.');
                }).finally(()=>{ window.__concurso_submitting = false; btn.disabled = false; });
            }, {passive:false});
        })();
    </script>
                    }
                }).then(async (res) => {
                    // If the app redirects, follow
                    if (res.redirected) {
                        window.location.href = res.url;
                        return;
                    }

                    // On success status, redirect to index or show message
                    if (res.ok) {
                        // Try to redirect to admin list
                        try { window.location.href = '/admin/concursos'; } catch(e){ alert('Concurso atualizado.'); }
                        return;
                    }

                    // If not ok, show response text for debugging
                    const txt = await res.text();
                    console.error('Concurso update failed', res.status, txt);
                    alert('Erro ao atualizar (código ' + res.status + '). Ver consola para detalhes.');
                }).catch(err => {
                    console.error('Network error submitting concurso', err);
                    alert('Erro de rede ao submeter o formulário.');
                }).finally(() => {
                    window.__concurso_submitting = false;
                    if (submitBtn) submitBtn.disabled = false;
                });
            }, {capture:false});
        })();
    </script>
@endsection
