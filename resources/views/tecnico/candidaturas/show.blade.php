@extends('layouts.tecnico')

@section('content')
<div style="max-width:820px;margin:0 auto;">

    <a href="{{ route('tecnico.candidaturas.index') }}"
       style="display:inline-flex;align-items:center;gap:5px;color:#0e5c2f;font-weight:600;font-size:0.88rem;text-decoration:none;margin-bottom:22px;">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Voltar à lista
    </a>

    <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:10px;margin-bottom:24px;">
        <div>
            <h1 style="font-size:1.4rem;font-weight:700;color:#1a2332;margin:0 0 3px;">Candidatura #{{ $candidatura->id }}</h1>
            <p style="color:#64748b;font-size:0.88rem;margin:0;">Recebida em {{ $candidatura->created_at->format('d/m/Y \à\s H:i') }}</p>
        </div>
        <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
            @php $cor = \App\Models\Candidatura::$statusColors[$candidatura->status] ?? '#94a3b8'; @endphp
            <span style="background:{{ $cor }}20;color:{{ $cor }};padding:5px 14px;border-radius:20px;font-size:0.88rem;font-weight:700;">
                {{ \App\Models\Candidatura::$statusLabels[$candidatura->status] ?? $candidatura->status }}
            </span>
            <a href="{{ route('tecnico.candidaturas.comprovativo', $candidatura) }}"
               style="display:inline-flex;align-items:center;gap:5px;background:#0369a1;color:#fff;border-radius:8px;padding:7px 14px;font-weight:700;font-size:0.84rem;text-decoration:none;"
               onmouseover="this.style.background='#0284c7'" onmouseout="this.style.background='#0369a1'">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Comprovativo PDF
            </a>
            <a href="{{ route('tecnico.candidaturas.edit', $candidatura) }}"
               style="display:inline-flex;align-items:center;gap:5px;background:#f0fdf4;color:#15803d;border:1px solid #86efac;border-radius:8px;padding:7px 14px;font-weight:700;font-size:0.84rem;text-decoration:none;"
               onmouseover="this.style.background='#dcfce7'" onmouseout="this.style.background='#f0fdf4'">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Editar
            </a>
            <form method="POST" action="{{ route('tecnico.candidaturas.destroy', $candidatura) }}"
                  onsubmit="return confirm('Tem a certeza que pretende eliminar esta candidatura?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        style="display:inline-flex;align-items:center;gap:5px;background:#fff5f5;color:#dc2626;border:1px solid #fecaca;border-radius:8px;padding:7px 14px;font-weight:700;font-size:0.84rem;cursor:pointer;"
                        onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fff5f5'">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                    Eliminar
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:11px 16px;border-radius:10px;margin-bottom:18px;display:flex;align-items:center;gap:9px;">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @php
    function _tc($label, $value) {
        $v = $value ?? '—';
        echo '<div><div style="font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">'.$label.'</div><div style="font-size:0.92rem;color:#1a2332;font-weight:500;">'.$v.'</div></div>';
    }
    @endphp

    {{-- Dados Pessoais --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;margin-bottom:18px;">
        <h2 style="font-size:0.88rem;font-weight:700;color:#0e5c2f;margin:0 0 16px;padding-bottom:10px;border-bottom:1px solid #f1f5f9;text-transform:uppercase;letter-spacing:0.04em;">Dados Pessoais</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:14px;">
            @php _tc('Nome Completo', $candidatura->nome); @endphp
            @php _tc('Filiação — Pai', $candidatura->filiacao_pai); @endphp
            @php _tc('Filiação — Mãe', $candidatura->filiacao_mae); @endphp
            @php _tc('Data de Nascimento', $candidatura->data_nascimento?->format('d/m/Y')); @endphp
            @php _tc('Naturalidade — Município', $candidatura->naturalidade_municipio); @endphp
            @php _tc('Naturalidade — Província', $candidatura->naturalidade_provincia); @endphp
            @php _tc('BI / Passaporte Nº', $candidatura->bi); @endphp
            @php _tc('BI Emitido em', $candidatura->bi_emitido_em); @endphp
            @php _tc('Data de Emissão BI', $candidatura->bi_data_emissao?->format('d/m/Y')); @endphp
            @php _tc('Sexo', $candidatura->sexo ? ucfirst($candidatura->sexo) : null); @endphp
            @php _tc('Estado Civil', $candidatura->estado_civil); @endphp
            @php _tc('Necessidade de Ed. Especial', $candidatura->necessidade_especial); @endphp
            @php _tc('Residência — Município', $candidatura->residencia_municipio); @endphp
            @php _tc('Residência — Rua/Bairro', $candidatura->residencia_bairro); @endphp
            @php _tc('Telefone 1', $candidatura->telefone); @endphp
            @php _tc('Telefone 2', $candidatura->telefone2); @endphp
            @php _tc('Email', $candidatura->email); @endphp
        </div>
    </div>

    {{-- Dados Académicos e Socioeconómicos --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;margin-bottom:18px;">
        <h2 style="font-size:0.88rem;font-weight:700;color:#0e5c2f;margin:0 0 16px;padding-bottom:10px;border-bottom:1px solid #f1f5f9;text-transform:uppercase;letter-spacing:0.04em;">Dados Académicos e Socioeconómicos</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:14px;">
            @php _tc('Habilitações Literárias', $candidatura->habilitacoes); @endphp
            @php _tc('Escola e Curso de Proveniência', $candidatura->escola_origem); @endphp
            @php _tc('Ano de Conclusão', $candidatura->ano_conclusao); @endphp
            @php
            $ef = ['maximo'=>'Máximo','medio'=>'Médio','minimo'=>'Mínimo'];
            _tc('Estado Financeiro', $candidatura->estado_financeiro ? ($ef[$candidatura->estado_financeiro] ?? $candidatura->estado_financeiro) : null);
            @endphp
            @php _tc('Trabalhador', $candidatura->trabalhador === null ? '—' : ($candidatura->trabalhador ? 'Sim' : 'Não')); @endphp
            @php _tc('Instituição Laboral', $candidatura->instituicao_laboral); @endphp
            @php _tc('Curso a Inscrever', $candidatura->curso); @endphp
            @php _tc('Período', $candidatura->periodo ? ucfirst(str_replace('-',' ',$candidatura->periodo)) : null); @endphp
        </div>
        @if($candidatura->observacoes)
        <div style="margin-top:14px;">
            <div style="font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:4px;">Observações</div>
            <div style="font-size:0.9rem;color:#334155;background:#f8fafc;border-radius:8px;padding:11px 14px;line-height:1.6;">{{ $candidatura->observacoes }}</div>
        </div>
        @endif
    </div>

    {{-- Atualizar Estado --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;">
        <h2 style="font-size:0.9rem;font-weight:700;color:#0e5c2f;margin:0 0 18px;padding-bottom:10px;border-bottom:1px solid #f1f5f9;text-transform:uppercase;letter-spacing:0.04em;">Atualizar Estado</h2>
        <form method="POST" action="{{ route('tecnico.candidaturas.status', $candidatura) }}">
            @csrf
            @method('PATCH')
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;">
                <div>
                    <label style="display:block;font-size:0.78rem;font-weight:600;color:#475569;margin-bottom:5px;">Estado</label>
                    <select name="status" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:9px 11px;font-size:0.88rem;">
                        @foreach(['pendente' => 'Pendente', 'em_analise' => 'Em Análise', 'aprovada' => 'Aprovada'] as $val => $label)
                            <option value="{{ $val }}" {{ $candidatura->status === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:0.78rem;font-weight:600;color:#475569;margin-bottom:5px;">Notas Internas</label>
                <textarea name="notas_admin" rows="4"
                          style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:9px 11px;font-size:0.88rem;resize:vertical;box-sizing:border-box;"
                          placeholder="Notas visíveis apenas para a equipa técnica...">{{ $candidatura->notas_admin }}</textarea>
            </div>
            <button type="submit"
                    style="background:#0e5c2f;color:#fff;border:none;border-radius:8px;padding:9px 22px;font-weight:700;cursor:pointer;font-size:0.88rem;"
                    onmouseover="this.style.background='#14532d'" onmouseout="this.style.background='#0e5c2f'">
                Guardar
            </button>
        </form>
    </div>

</div>
@endsection
