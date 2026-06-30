@extends('layouts.admin')

@section('content')
<div style="max-width:780px;margin:0 auto;padding:36px 24px 48px;">

    {{-- Header --}}
    <div style="display:flex;align-items:center;gap:16px;margin-bottom:32px;">
        <a href="{{ route('admin.noticias') }}"
           style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:#f1f5f9;border:1px solid #e2e8f0;color:#475569;text-decoration:none;"
           onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        </a>
        <div>
            <h1 style="font-size:1.6rem;font-weight:800;color:#1a202c;margin:0 0 3px;">Editar Notícia</h1>
            <p style="color:#64748b;font-size:0.9rem;margin:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:500px;">{{ $noticia->titulo }}</p>
        </div>
    </div>

    {{-- Validation errors --}}
    @if($errors->any())
    <div style="background:#fff5f5;border:1px solid #fecaca;border-radius:10px;padding:14px 18px;margin-bottom:24px;">
        <p style="font-weight:700;color:#dc2626;margin:0 0 8px;font-size:0.9rem;">Corrija os seguintes erros:</p>
        <ul style="margin:0;padding-left:18px;color:#dc2626;font-size:0.88rem;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.noticias.update', $noticia->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Card: Conteúdo --}}
        <div style="background:#fff;border-radius:14px;border:1px solid #e2e8f0;box-shadow:0 1px 6px rgba(0,0,0,0.06);margin-bottom:20px;overflow:hidden;">
            <div style="padding:14px 22px;border-bottom:1px solid #f1f5f9;background:#f8fafc;">
                <span style="font-size:0.8rem;font-weight:700;color:#64748b;letter-spacing:0.06em;text-transform:uppercase;">Conteúdo</span>
            </div>
            <div style="padding:22px;display:flex;flex-direction:column;gap:18px;">

                {{-- Título --}}
                <div>
                    <label for="titulo" style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">
                        Título <span style="color:#dc2626;">*</span>
                    </label>
                    <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $noticia->titulo) }}" required
                           style="width:100%;box-sizing:border-box;border:1px solid {{ $errors->has('titulo') ? '#fca5a5' : '#d1d5db' }};border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;outline:none;background:#fff;"
                           onfocus="this.style.borderColor='#1565c0';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                           onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                </div>

                {{-- Texto --}}
                <div>
                    <label for="texto" style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">
                        Texto <span style="color:#dc2626;">*</span>
                    </label>
                    <textarea name="texto" id="texto" rows="8" required
                              style="width:100%;box-sizing:border-box;border:1px solid {{ $errors->has('texto') ? '#fca5a5' : '#d1d5db' }};border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;resize:vertical;outline:none;background:#fff;font-family:inherit;"
                              onfocus="this.style.borderColor='#1565c0';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                              onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">{{ old('texto', $noticia->texto) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Card: Detalhes --}}
        <div style="background:#fff;border-radius:14px;border:1px solid #e2e8f0;box-shadow:0 1px 6px rgba(0,0,0,0.06);margin-bottom:20px;overflow:hidden;">
            <div style="padding:14px 22px;border-bottom:1px solid #f1f5f9;background:#f8fafc;">
                <span style="font-size:0.8rem;font-weight:700;color:#64748b;letter-spacing:0.06em;text-transform:uppercase;">Detalhes</span>
            </div>
            <div style="padding:22px;display:grid;grid-template-columns:1fr 1fr;gap:18px;">

                {{-- Data --}}
                <div>
                    <label for="data" style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">
                        Data <span style="color:#dc2626;">*</span>
                    </label>
                    <input type="date" name="data" id="data" value="{{ old('data', \Carbon\Carbon::parse($noticia->data)->format('Y-m-d')) }}" required
                           style="width:100%;box-sizing:border-box;border:1px solid {{ $errors->has('data') ? '#fca5a5' : '#d1d5db' }};border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;outline:none;background:#fff;"
                           onfocus="this.style.borderColor='#1565c0';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                           onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                </div>

                {{-- Institucional --}}
                <div>
                    <label for="institucional" style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">
                        Tipo de notícia
                    </label>
                    <select name="institucional" id="institucional"
                            style="width:100%;box-sizing:border-box;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;outline:none;background:#fff;appearance:auto;"
                            onfocus="this.style.borderColor='#1565c0';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                            onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                        <option value="0" @if(!old('institucional', $noticia->institucional)) selected @endif>Notícia geral</option>
                        <option value="1" @if(old('institucional', $noticia->institucional)) selected @endif>Institucional</option>
                    </select>
                </div>

                {{-- Publicada --}}
                <div style="grid-column:1/-1;">
                    <label style="display:inline-flex;align-items:center;gap:10px;cursor:pointer;padding:12px 16px;border:1px solid #d1d5db;border-radius:8px;background:#f8fafc;width:100%;box-sizing:border-box;"
                           onmouseover="this.style.background='#eff6ff';this.style.borderColor='#1565c0'"
                           onmouseout="this.style.background='#f8fafc';this.style.borderColor='#d1d5db'">
                        <input type="checkbox" name="publicada" value="1"
                               {{ old('publicada', $noticia->publicada ? '1' : '0') === '1' ? 'checked' : '' }}
                               style="width:18px;height:18px;accent-color:#1565c0;cursor:pointer;">
                        <span style="font-size:0.9rem;font-weight:600;color:#374151;">Publicada</span>
                        <span style="font-size:0.8rem;color:#64748b;margin-left:4px;">— visível no site público</span>
                    </label>
                </div>
            </div>
        </div>

        {{-- Card: Ficheiros --}}
        <div style="background:#fff;border-radius:14px;border:1px solid #e2e8f0;box-shadow:0 1px 6px rgba(0,0,0,0.06);margin-bottom:28px;overflow:hidden;">
            <div style="padding:14px 22px;border-bottom:1px solid #f1f5f9;background:#f8fafc;">
                <span style="font-size:0.8rem;font-weight:700;color:#64748b;letter-spacing:0.06em;text-transform:uppercase;">Ficheiros</span>
            </div>
            <div style="padding:22px;display:grid;grid-template-columns:1fr 1fr;gap:18px;">

                {{-- Imagem --}}
                <div>
                    <label for="imagem" style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">
                        Imagem de destaque
                        <span style="font-weight:400;color:#94a3b8;font-size:0.8rem;">(opcional)</span>
                    </label>
                    @if($noticia->imagem)
                    <div style="display:flex;align-items:center;gap:10px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:10px 12px;margin-bottom:10px;">
                        <img src="{{ asset('storage/' . $noticia->imagem) }}" alt="" style="width:44px;height:44px;object-fit:cover;border-radius:6px;flex-shrink:0;">
                        <div style="flex:1;min-width:0;">
                            <p style="font-size:0.8rem;color:#374151;font-weight:600;margin:0 0 2px;">Imagem atual</p>
                            <a href="{{ asset('storage/' . $noticia->imagem) }}" target="_blank" style="font-size:0.78rem;color:#1565c0;text-decoration:none;">Ver em tamanho real</a>
                        </div>
                    </div>
                    @endif
                    <label for="imagem"
                           style="display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;border:2px dashed #d1d5db;border-radius:10px;padding:18px 14px;cursor:pointer;transition:border-color 0.15s;background:#fafafa;"
                           onmouseover="this.style.borderColor='#1565c0';this.style.background='#eff6ff'"
                           onmouseout="this.style.borderColor='#d1d5db';this.style.background='#fafafa'">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        <span id="imagem-label" style="font-size:0.8rem;color:#64748b;text-align:center;">{{ $noticia->imagem ? 'Substituir imagem' : 'Selecionar imagem' }}<br><span style="color:#94a3b8;font-size:0.76rem;">JPG, PNG — máx. 2 MB</span></span>
                        <input type="file" name="imagem" id="imagem" accept="image/*" style="display:none;"
                               onchange="document.getElementById('imagem-label').innerHTML = this.files[0] ? '<strong style=\'color:#1565c0\'>' + this.files[0].name + '</strong>' : '{{ $noticia->imagem ? 'Substituir imagem' : 'Selecionar imagem' }}'">
                    </label>
                </div>

                {{-- PDF --}}
                <div>
                    <label for="pdf" style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">
                        Documento PDF
                        <span style="font-weight:400;color:#94a3b8;font-size:0.8rem;">(opcional)</span>
                    </label>
                    @if($noticia->pdf)
                    <div style="display:flex;align-items:center;gap:10px;background:#fff5f5;border:1px solid #fecaca;border-radius:8px;padding:10px 12px;margin-bottom:10px;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        <div style="flex:1;min-width:0;">
                            <p style="font-size:0.8rem;color:#374151;font-weight:600;margin:0 0 2px;">PDF atual</p>
                            <a href="{{ asset('storage/' . $noticia->pdf) }}" target="_blank" style="font-size:0.78rem;color:#dc2626;text-decoration:none;">Abrir PDF</a>
                        </div>
                    </div>
                    @endif
                    <label for="pdf"
                           style="display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;border:2px dashed #d1d5db;border-radius:10px;padding:18px 14px;cursor:pointer;transition:border-color 0.15s;background:#fafafa;"
                           onmouseover="this.style.borderColor='#dc2626';this.style.background='#fff5f5'"
                           onmouseout="this.style.borderColor='#d1d5db';this.style.background='#fafafa'">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        <span id="pdf-label" style="font-size:0.8rem;color:#64748b;text-align:center;">{{ $noticia->pdf ? 'Substituir PDF' : 'Selecionar PDF' }}<br><span style="color:#94a3b8;font-size:0.76rem;">PDF — máx. 5 MB</span></span>
                        <input type="file" name="pdf" id="pdf" accept="application/pdf" style="display:none;"
                               onchange="document.getElementById('pdf-label').innerHTML = this.files[0] ? '<strong style=\'color:#dc2626\'>' + this.files[0].name + '</strong>' : '{{ $noticia->pdf ? 'Substituir PDF' : 'Selecionar PDF' }}'">
                    </label>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div style="display:flex;align-items:center;justify-content:flex-end;gap:12px;">
            <a href="{{ route('admin.noticias') }}"
               style="padding:11px 22px;border-radius:8px;border:1px solid #d1d5db;background:#fff;color:#374151;font-weight:600;font-size:0.95rem;text-decoration:none;transition:background 0.15s;"
               onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#fff'">
                Cancelar
            </a>
            <button type="submit"
                    style="display:inline-flex;align-items:center;gap:8px;padding:11px 26px;border-radius:8px;background:#1565c0;color:#fff;font-weight:700;font-size:0.95rem;border:none;cursor:pointer;box-shadow:0 2px 8px rgba(21,101,192,0.25);transition:background 0.15s;"
                    onmouseover="this.style.background='#0d47a1'" onmouseout="this.style.background='#1565c0'">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v14a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Salvar Alterações
            </button>
@endsection
