@extends('layouts.admin')

@section('content')
<div style="max-width:620px;margin:0 auto;padding:36px 24px 48px;">

    {{-- Header --}}
    <div style="display:flex;align-items:center;gap:16px;margin-bottom:32px;">
        <a href="{{ route('admin.carrossel.index') }}"
           style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:#f1f5f9;border:1px solid #e2e8f0;color:#475569;text-decoration:none;"
           onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        </a>
        <div>
            <h1 style="font-size:1.6rem;font-weight:800;color:#1a202c;margin:0 0 3px;">Editar Slide</h1>
            <p style="color:#64748b;font-size:0.9rem;margin:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:440px;">{{ $carrossel->titulo }}</p>
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

    <form action="{{ route('admin.carrossel.update', $carrossel->id) }}" method="POST" enctype="multipart/form-data">
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
                    <input type="text" name="titulo" value="{{ old('titulo', $carrossel->titulo) }}" required
                           style="width:100%;box-sizing:border-box;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;outline:none;"
                           onfocus="this.style.borderColor='#1e3a5f';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                           onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                </div>
                <div>
                    <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">Subtítulo <span style="font-weight:400;color:#94a3b8;font-size:0.8rem;">(opcional)</span></label>
                    <input type="text" name="subtitulo" value="{{ old('subtitulo', $carrossel->subtitulo) }}"
                           style="width:100%;box-sizing:border-box;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;outline:none;"
                           onfocus="this.style.borderColor='#1e3a5f';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                           onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div>
                        <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">Texto do Botão <span style="font-weight:400;color:#94a3b8;font-size:0.8rem;">(opcional)</span></label>
                        <input type="text" name="texto_botao" value="{{ old('texto_botao', $carrossel->texto_botao) }}"
                               style="width:100%;box-sizing:border-box;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;outline:none;"
                               onfocus="this.style.borderColor='#1e3a5f';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                               onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                    </div>
                    <div>
                        <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">Link <span style="font-weight:400;color:#94a3b8;font-size:0.8rem;">(opcional)</span></label>
                        <input type="text" name="link" value="{{ old('link', $carrossel->link) }}"
                               style="width:100%;box-sizing:border-box;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;outline:none;"
                               onfocus="this.style.borderColor='#1e3a5f';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                               onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: Configuração --}}
        <div style="background:#fff;border-radius:14px;border:1px solid #e2e8f0;box-shadow:0 1px 6px rgba(0,0,0,0.06);margin-bottom:20px;overflow:hidden;">
            <div style="padding:14px 22px;border-bottom:1px solid #f1f5f9;background:#f8fafc;">
                <span style="font-size:0.8rem;font-weight:700;color:#64748b;letter-spacing:0.06em;text-transform:uppercase;">Configuração</span>
            </div>
            <div style="padding:22px;display:flex;flex-direction:column;gap:16px;">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;align-items:end;">
                    <div>
                        <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">Ordem</label>
                        <input type="number" name="ordem" value="{{ old('ordem', $carrossel->ordem) }}" min="0"
                               style="width:100%;box-sizing:border-box;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;outline:none;"
                               onfocus="this.style.borderColor='#1e3a5f';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                               onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                    </div>
                    <div>
                        <label style="display:flex;align-items:center;gap:10px;cursor:pointer;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;background:#f8fafc;">
                            <input type="checkbox" name="publicado" value="1" {{ old('publicado', $carrossel->publicado) ? 'checked' : '' }}
                                   style="width:16px;height:16px;accent-color:#1e3a5f;cursor:pointer;">
                            <span style="font-size:0.9rem;font-weight:600;color:#374151;">Publicado</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: Imagem --}}
        <div style="background:#fff;border-radius:14px;border:1px solid #e2e8f0;box-shadow:0 1px 6px rgba(0,0,0,0.06);margin-bottom:28px;overflow:hidden;">
            <div style="padding:14px 22px;border-bottom:1px solid #f1f5f9;background:#f8fafc;">
                <span style="font-size:0.8rem;font-weight:700;color:#64748b;letter-spacing:0.06em;text-transform:uppercase;">Imagem</span>
            </div>
            <div style="padding:22px;">
                @if($carrossel->imagem)
                <div style="margin-bottom:16px;">
                    <img src="{{ asset('storage/' . $carrossel->imagem) }}" alt="Imagem atual"
                         style="width:100%;max-height:200px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0;">
                    <p style="font-size:0.78rem;color:#94a3b8;margin:6px 0 0;">Imagem atual — selecione abaixo para substituir</p>
                </div>
                @endif
                <label style="display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;border:2px dashed #cbd5e1;border-radius:10px;padding:22px;cursor:pointer;background:#f8fafc;"
                       onmouseover="this.style.borderColor='#1e3a5f'" onmouseout="this.style.borderColor='#cbd5e1'">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    <span id="img-label" style="font-size:0.88rem;color:#64748b;font-weight:500;">Clique para substituir a imagem</span>
                    <input type="file" name="imagem" accept="image/*" style="display:none;"
                           onchange="document.getElementById('img-label').textContent = this.files[0] ? this.files[0].name : 'Clique para substituir a imagem'">
                </label>
            </div>
        </div>

        <div style="display:flex;align-items:center;justify-content:flex-end;gap:12px;">
            <a href="{{ route('admin.carrossel.index') }}"
               style="padding:11px 22px;border-radius:8px;border:1px solid #d1d5db;background:#fff;color:#374151;font-weight:600;font-size:0.95rem;text-decoration:none;"
               onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#fff'">Cancelar</a>
            <button type="submit"
                    style="display:inline-flex;align-items:center;gap:8px;padding:11px 26px;border-radius:8px;background:#1e3a5f;color:#fff;font-weight:700;font-size:0.95rem;border:none;cursor:pointer;box-shadow:0 2px 8px rgba(21,101,192,0.25);"
                    onmouseover="this.style.background='#0f1f3d'" onmouseout="this.style.background='#1e3a5f'">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v14a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Salvar Alterações
            </button>
        </div>
    </form>
</div>
@endsection

