@extends('layouts.admin')

@section('content')
<div style="padding:32px 24px;max-width:860px;margin:0 auto;">

    {{-- Back --}}
    <a href="{{ route('admin.candidaturas.index') }}"
       style="display:inline-flex;align-items:center;gap:6px;color:#1565c0;font-weight:600;font-size:0.9rem;text-decoration:none;margin-bottom:24px;">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Voltar à lista
    </a>

    {{-- Header --}}
    <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:28px;">
        <div>
            <h1 style="font-size:1.5rem;font-weight:700;color:#1a2332;margin:0 0 4px;">Candidatura #{{ $candidatura->id }}</h1>
            <p style="color:#64748b;font-size:0.9rem;margin:0;">Recebida em {{ $candidatura->created_at->format('d/m/Y \à\s H:i') }}</p>
        </div>
        <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
            @php $color = \App\Models\Candidatura::$statusColors[$candidatura->status] ?? '#94a3b8'; @endphp
            <span style="background:{{ $color }}20;color:{{ $color }};padding:6px 16px;border-radius:20px;font-size:0.9rem;font-weight:700;">
                {{ \App\Models\Candidatura::$statusLabels[$candidatura->status] ?? $candidatura->status }}
            </span>
            <a href="{{ route('admin.candidaturas.comprovativo', $candidatura) }}"
               style="display:inline-flex;align-items:center;gap:6px;background:#0369a1;color:#fff;border-radius:8px;padding:8px 16px;font-weight:700;font-size:0.88rem;text-decoration:none;"
               onmouseover="this.style.background='#0284c7'" onmouseout="this.style.background='#0369a1'">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Comprovativo PDF
            </a>
            <a href="{{ route('admin.candidaturas.edit', $candidatura) }}"
               style="display:inline-flex;align-items:center;gap:6px;background:#eff6ff;color:#1d4ed8;border:1px solid #bfdbfe;border-radius:8px;padding:8px 16px;font-weight:700;font-size:0.88rem;text-decoration:none;"
               onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='#eff6ff'">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Editar
            </a>
        </div>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @php
    function _campo($label, $value) {
        $v = $value ?? '—';
        echo '<div><div style="font-size:0.73rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">'.$label.'</div><div style="font-size:0.93rem;color:#1a2332;font-weight:500;">'.$v.'</div></div>';
    }
    @endphp

    {{-- Dados Pessoais --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:26px;margin-bottom:18px;">
        <h2 style="font-size:0.95rem;font-weight:700;color:#1565c0;margin:0 0 18px;padding-bottom:10px;border-bottom:1px solid #f1f5f9;">Dados Pessoais</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;">
            @php _campo('Nome Completo', $candidatura->nome); @endphp
            @php _campo('Filiação — Pai', $candidatura->filiacao_pai); @endphp
            @php _campo('Filiação — Mãe', $candidatura->filiacao_mae); @endphp
            @php _campo('Data de Nascimento', $candidatura->data_nascimento?->format('d/m/Y')); @endphp
            @php _campo('Naturalidade — Município', $candidatura->naturalidade_municipio); @endphp
            @php _campo('Naturalidade — Província', $candidatura->naturalidade_provincia); @endphp
            @php _campo('BI / Passaporte Nº', $candidatura->bi); @endphp
            @php _campo('BI Emitido em', $candidatura->bi_emitido_em); @endphp
            @php _campo('Data de Emissão BI', $candidatura->bi_data_emissao?->format('d/m/Y')); @endphp
            @php _campo('Sexo', $candidatura->sexo ? ucfirst($candidatura->sexo) : null); @endphp
            @php _campo('Estado Civil', $candidatura->estado_civil); @endphp
            @php _campo('Necessidade de Ed. Especial', $candidatura->necessidade_especial); @endphp
            @php _campo('Residência — Município', $candidatura->residencia_municipio); @endphp
            @php _campo('Residência — Rua/Bairro', $candidatura->residencia_bairro); @endphp
            @php _campo('Telefone 1', $candidatura->telefone); @endphp
            @php _campo('Telefone 2', $candidatura->telefone2); @endphp
            @php _campo('Email', $candidatura->email); @endphp
        </div>
    </div>

    {{-- Dados Académicos e Socioeconómicos --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:26px;margin-bottom:18px;">
        <h2 style="font-size:0.95rem;font-weight:700;color:#1565c0;margin:0 0 18px;padding-bottom:10px;border-bottom:1px solid #f1f5f9;">Dados Académicos e Socioeconómicos</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;">
            @php _campo('Habilitações Literárias', $candidatura->habilitacoes); @endphp
            @php _campo('Escola de Proveniência', $candidatura->escola_origem); @endphp
            @php _campo('Perfil do Curso de Origem', $candidatura->perfil); @endphp
            @php _campo('Ano de Conclusão', $candidatura->ano_conclusao); @endphp
            @php
            $ef = ['maximo'=>'Máximo','medio'=>'Médio','minimo'=>'Mínimo'];
            _campo('Estado Financeiro da Família', $candidatura->estado_financeiro ? ($ef[$candidatura->estado_financeiro] ?? $candidatura->estado_financeiro) : null);
            @endphp
            @php _campo('Trabalhador', $candidatura->trabalhador === null ? '—' : ($candidatura->trabalhador ? 'Sim' : 'Não')); @endphp
            @php _campo('Instituição Laboral', $candidatura->instituicao_laboral); @endphp
            @php _campo('Curso a Inscrever', $candidatura->curso); @endphp
            @php _campo('Período', $candidatura->periodo ? ucfirst(str_replace('-',' ',$candidatura->periodo)) : null); @endphp
        </div>
        @if($candidatura->observacoes)
        <div style="margin-top:16px;">
            <div style="font-size:0.73rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:5px;">Observações</div>
            <div style="font-size:0.9rem;color:#334155;background:#f8fafc;border-radius:8px;padding:12px 16px;line-height:1.6;">{{ $candidatura->observacoes }}</div>
        </div>
        @endif
    </div>

    {{-- Update status --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:28px;margin-bottom:22px;">
        <h2 style="font-size:1rem;font-weight:700;color:#1565c0;margin:0 0 20px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">Atualizar Estado</h2>
        <form method="POST" action="{{ route('admin.candidaturas.status', $candidatura) }}">
            @csrf
            @method('PATCH')
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                <div>
                    <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:6px;">Estado</label>
                    <select name="status" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:10px 12px;font-size:0.9rem;">
                        @foreach(\App\Models\Candidatura::$statusLabels as $val => $label)
                            <option value="{{ $val }}" {{ $candidatura->status === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div style="margin-bottom:18px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#475569;margin-bottom:6px;">Notas Internas</label>
                <textarea name="notas_admin" rows="4"
                          style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:10px 12px;font-size:0.9rem;resize:vertical;box-sizing:border-box;"
                          placeholder="Notas visíveis apenas para administradores...">{{ $candidatura->notas_admin }}</textarea>
            </div>
            <button type="submit"
                    style="background:#1565c0;color:#fff;border:none;border-radius:8px;padding:10px 24px;font-weight:700;cursor:pointer;font-size:0.9rem;"
                    onmouseover="this.style.background='#0d47a1'" onmouseout="this.style.background='#1565c0'">
                Guardar
            </button>
        </form>
    </div>

    {{-- Danger zone --}}
    <div style="background:#fff;border:1px solid #fecaca;border-radius:14px;padding:22px 28px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
        <div>
            <div style="font-weight:700;color:#b91c1c;margin-bottom:3px;">Eliminar candidatura</div>
            <div style="font-size:0.85rem;color:#64748b;">Esta ação é irreversível.</div>
        </div>
        <form method="POST" action="{{ route('admin.candidaturas.destroy', $candidatura) }}"
              onsubmit="return confirm('Tem a certeza que pretende eliminar esta candidatura?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    style="background:#ef4444;color:#fff;border:none;border-radius:8px;padding:9px 20px;font-weight:700;cursor:pointer;font-size:0.9rem;"
                    onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#ef4444'">
                Eliminar
            </button>
        </form>
    </div>

</div>
@endsection
