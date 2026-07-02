@extends('layouts.admin')

@section('content')
<div style="max-width:620px;margin:0 auto;padding:36px 24px 48px;">

    {{-- Header --}}
    <div style="display:flex;align-items:center;gap:16px;margin-bottom:32px;">
        <a href="{{ route('admin.estatisticas.index') }}"
           style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:#f1f5f9;border:1px solid #e2e8f0;color:#475569;text-decoration:none;"
           onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        </a>
        <div>
            <h1 style="font-size:1.6rem;font-weight:800;color:#1a202c;margin:0 0 3px;">Nova Estatística</h1>
            <p style="color:#64748b;font-size:0.9rem;margin:0;">Adicione um novo indicador ao painel público.</p>
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

    <form action="{{ route('admin.estatisticas.store') }}" method="POST">
        @csrf
        <div style="background:#fff;border-radius:14px;border:1px solid #e2e8f0;box-shadow:0 1px 6px rgba(0,0,0,0.06);margin-bottom:20px;overflow:hidden;">
            <div style="padding:14px 22px;border-bottom:1px solid #f1f5f9;background:#f8fafc;">
                <span style="font-size:0.8rem;font-weight:700;color:#64748b;letter-spacing:0.06em;text-transform:uppercase;">Dados</span>
            </div>
            <div style="padding:22px;display:flex;flex-direction:column;gap:16px;">

                <div>
                    <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">Título <span style="color:#dc2626;">*</span></label>
                    <input type="text" name="titulo" value="{{ old('titulo') }}" required placeholder="Ex: Estudantes Inscritos"
                           style="width:100%;box-sizing:border-box;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;outline:none;"
                           onfocus="this.style.borderColor='#1565c0';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                           onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div>
                        <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">Valor <span style="color:#dc2626;">*</span></label>
                        <input type="text" name="valor" value="{{ old('valor') }}" required placeholder="Ex: 5570 ou Variável"
                               style="width:100%;box-sizing:border-box;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;outline:none;"
                               onfocus="this.style.borderColor='#1565c0';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                               onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                    </div>
                    <div>
                        <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">Ordem</label>
                        <input type="number" name="ordem" value="{{ old('ordem', 0) }}" min="0"
                               style="width:100%;box-sizing:border-box;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;outline:none;"
                               onfocus="this.style.borderColor='#1565c0';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                               onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                    </div>
                </div>

                <div>
                    <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">Descrição <span style="font-weight:400;color:#94a3b8;font-size:0.8rem;">(opcional)</span></label>
                    <input type="text" name="descricao" value="{{ old('descricao') }}" placeholder="Ex: Ano 2026/2027"
                           style="width:100%;box-sizing:border-box;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;outline:none;"
                           onfocus="this.style.borderColor='#1565c0';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                           onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                </div>

                <div>
                    <label style="display:block;font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:6px;">Ícone <span style="font-weight:400;color:#94a3b8;font-size:0.8rem;">(opcional)</span></label>
                    <input type="text" name="icone" value="{{ old('icone') }}" placeholder="Ex: users, chart-bar, book..."
                           style="width:100%;box-sizing:border-box;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;color:#1a202c;outline:none;"
                           onfocus="this.style.borderColor='#1565c0';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                           onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                </div>
            </div>
        </div>

        <div style="display:flex;align-items:center;justify-content:flex-end;gap:12px;">
            <a href="{{ route('admin.estatisticas.index') }}"
               style="padding:11px 22px;border-radius:8px;border:1px solid #d1d5db;background:#fff;color:#374151;font-weight:600;font-size:0.95rem;text-decoration:none;"
               onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#fff'">Cancelar</a>
            <button type="submit"
                    style="display:inline-flex;align-items:center;gap:8px;padding:11px 26px;border-radius:8px;background:#1565c0;color:#fff;font-weight:700;font-size:0.95rem;border:none;cursor:pointer;box-shadow:0 2px 8px rgba(21,101,192,0.25);"
                    onmouseover="this.style.background='#0d47a1'" onmouseout="this.style.background='#1565c0'">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v14a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Salvar Estatística
            </button>
@endsection
