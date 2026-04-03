@extends('layouts.admin')

@section('content')
<div style="max-width:680px;margin:0 auto;padding:36px 24px 48px;">

    {{-- Header --}}
    <div style="display:flex;align-items:center;gap:16px;margin-bottom:32px;">
        <a href="{{ route('admin.concursos.index') }}"
           style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:#f1f5f9;border:1px solid #e2e8f0;color:#475569;text-decoration:none;"
           onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        </a>
        <div>
            <h1 style="font-size:1.6rem;font-weight:800;color:#1a202c;margin:0 0 3px;">Editar Concurso</h1>
            <p style="color:#64748b;font-size:0.9rem;margin:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:480px;">{{ $concurso->title }}</p>
        </div>
    </div>

    @if($errors->any())
    <div style="background:#fff5f5;border:1px solid #fecaca;border-radius:10px;padding:14px 18px;margin-bottom:24px;">
        <p style="font-weight:700;color:#dc2626;margin:0 0 8px;font-size:0.9rem;">Corrija os seguintes erros:</p>
        <ul style="margin:0;padding-left:18px;color:#dc2626;font-size:0.88rem;">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
    @endif

    @if(session('status'))
    <div style="background:#f0fdf4;border:1px solid #86efac;color:#166534;padding:12px 18px;border-radius:10px;margin-bottom:24px;font-weight:600;display:flex;align-items:center;gap:10px;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        {{ session('status') }}
    </div>
    @endif

    <form id="concurso-form" action="{{ route('admin.concursos.update', $concurso) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Card: Conteúdo --}}
        <div style="background:#fff;border-radius:14px;border:1px solid #e2e8f0;box-shadow:0 1px 6px rgba(0,0,0,0.06);margin-bottom:20px;overflow:hidden;">
            <div style="padding:14px 22px;border-bottom:1px solid #f1f5f9;background:#f8fafc;">
                <span style="font-size:0.8rem;font-weight:700;color:#64748b;letter-spacing:0.06em;text-transform:uppercase;">Conteúdo</span>
            </div>
            <div style="padding:22px;display:flex;flex-direction:column;gap:16px;">
                <div>
                    <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">Título <span style="color:#dc2626;">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $concurso->title) }}" required
                           style="width:100%;box-sizing:border-box;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;outline:none;"
                           onfocus="this.style.borderColor='#1565c0';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                           onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                </div>
                <div>
                    <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">Resumo <span style="font-weight:400;color:#94a3b8;font-size:0.8rem;">(opcional)</span></label>
                    <input type="text" name="summary" value="{{ old('summary', $concurso->summary) }}"
                           style="width:100%;box-sizing:border-box;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;outline:none;"
                           onfocus="this.style.borderColor='#1565c0';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                           onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                </div>
                <div>
                    <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">Corpo <span style="font-weight:400;color:#94a3b8;font-size:0.8rem;">(opcional)</span></label>
                    <textarea name="body" rows="6"
                              style="width:100%;box-sizing:border-box;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;outline:none;resize:vertical;"
                              onfocus="this.style.borderColor='#1565c0';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                              onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">{{ old('body', $concurso->body) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Card: Configuração --}}
        <div style="background:#fff;border-radius:14px;border:1px solid #e2e8f0;box-shadow:0 1px 6px rgba(0,0,0,0.06);margin-bottom:20px;overflow:hidden;">
            <div style="padding:14px 22px;border-bottom:1px solid #f1f5f9;background:#f8fafc;">
                <span style="font-size:0.8rem;font-weight:700;color:#64748b;letter-spacing:0.06em;text-transform:uppercase;">Configuração</span>
            </div>
            <div style="padding:22px;display:flex;flex-direction:column;gap:16px;">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div>
                        <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">Estado <span style="color:#dc2626;">*</span></label>
                        <select name="status"
                                style="width:100%;box-sizing:border-box;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;outline:none;background:#fff;"
                                onfocus="this.style.borderColor='#1565c0'" onblur="this.style.borderColor='#d1d5db'">
                            <option value="draft" {{ (old('status',$concurso->status)==='draft')?'selected':'' }}>Rascunho</option>
                            <option value="published" {{ (old('status',$concurso->status)==='published')?'selected':'' }}>Publicado</option>
                        </select>
                    </div>
                    <div>
                        <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">Data de Publicação</label>
                        <input type="datetime-local" name="publish_at" value="{{ optional($concurso->publish_at)->format('Y-m-d\TH:i') }}"
                               style="width:100%;box-sizing:border-box;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;outline:none;"
                               onfocus="this.style.borderColor='#1565c0';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                               onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                    </div>
                </div>
                <div>
                    <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">Área / Categoria</label>
                    <select name="area"
                            style="width:100%;box-sizing:border-box;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;outline:none;background:#fff;"
                            onfocus="this.style.borderColor='#1565c0'" onblur="this.style.borderColor='#d1d5db'">
                        <option value="">— Selecionar —</option>
                        <option value="Docente" {{ (old('area',$concurso->area)==='Docente')?'selected':'' }}>Docente</option>
                        <option value="Técnico Administrativo" {{ (old('area',$concurso->area)==='Técnico Administrativo')?'selected':'' }}>Técnico Administrativo</option>
                        <option value="Técnico Especializado" {{ (old('area',$concurso->area)==='Técnico Especializado')?'selected':'' }}>Técnico Especializado</option>
                        <option value="Investigação Científica" {{ (old('area',$concurso->area)==='Investigação Científica')?'selected':'' }}>Investigação Científica</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Card: Adicionar Anexos --}}
        <div style="background:#fff;border-radius:14px;border:1px solid #e2e8f0;box-shadow:0 1px 6px rgba(0,0,0,0.06);margin-bottom:20px;overflow:hidden;">
            <div style="padding:14px 22px;border-bottom:1px solid #f1f5f9;background:#f8fafc;">
                <span style="font-size:0.8rem;font-weight:700;color:#64748b;letter-spacing:0.06em;text-transform:uppercase;">Adicionar Anexos</span>
            </div>
            <div style="padding:22px;">
                <label style="display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;border:2px dashed #cbd5e1;border-radius:10px;padding:28px;cursor:pointer;background:#f8fafc;"
                       onmouseover="this.style.borderColor='#1565c0'" onmouseout="this.style.borderColor='#cbd5e1'">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    <span id="drop-text" style="font-size:0.9rem;color:#64748b;font-weight:500;">Clique ou arraste ficheiros PDF/DOC/DOCX</span>
                    <input type="file" name="attachments[]" multiple accept=".pdf,.doc,.docx" style="display:none;"
                           onchange="document.getElementById('drop-text').textContent = this.files.length ? Array.from(this.files).map(f=>f.name).join(', ') : 'Clique ou arraste ficheiros PDF/DOC/DOCX'">
                </label>
            </div>
        </div>

        <div style="display:flex;align-items:center;justify-content:flex-end;gap:12px;margin-bottom:28px;">
            <a href="{{ route('admin.concursos.index') }}"
               style="padding:11px 22px;border-radius:8px;border:1px solid #d1d5db;background:#fff;color:#374151;font-weight:600;font-size:0.95rem;text-decoration:none;"
               onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#fff'">Cancelar</a>
            <button type="submit"
                    style="display:inline-flex;align-items:center;gap:8px;padding:11px 26px;border-radius:8px;background:#1565c0;color:#fff;font-weight:700;font-size:0.95rem;border:none;cursor:pointer;box-shadow:0 2px 8px rgba(21,101,192,0.25);"
                    onmouseover="this.style.background='#0d47a1'" onmouseout="this.style.background='#1565c0'">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v14a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Salvar Alterações
            </button>
        </div>
    </form>

    {{-- Anexos existentes --}}
    @if($concurso->attachments->isNotEmpty())
    <div style="background:#fff;border-radius:14px;border:1px solid #e2e8f0;box-shadow:0 1px 6px rgba(0,0,0,0.06);overflow:hidden;">
        <div style="padding:14px 22px;border-bottom:1px solid #f1f5f9;background:#f8fafc;">
            <span style="font-size:0.8rem;font-weight:700;color:#64748b;letter-spacing:0.06em;text-transform:uppercase;">Anexos Existentes</span>
        </div>
        <div style="padding:16px 22px;display:flex;flex-direction:column;gap:10px;">
            @foreach($concurso->attachments as $att)
            <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;padding:10px 14px;background:#f8fafc;border-radius:8px;border:1px solid #e2e8f0;">
                <div style="display:flex;align-items:center;gap:10px;min-width:0;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    <a href="{{ Storage::url($att->path) }}" target="_blank"
                       style="font-size:0.88rem;color:#1565c0;text-decoration:none;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"
                       onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">{{ $att->original_name }}</a>
                </div>
                <form action="{{ route('admin.concursos.attachments.destroy', $att->id) }}" method="POST"
                      onsubmit="return confirm('Remover anexo «{{ addslashes($att->original_name) }}»?')" style="flex-shrink:0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:6px;background:#fff5f5;color:#dc2626;border:1px solid #fecaca;cursor:pointer;"
                        onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fff5f5'">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
