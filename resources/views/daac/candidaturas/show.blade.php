@extends('layouts.daac')
@section('content')
@php
    $ef = ['maximo'=>'Máximo','medio'=>'Médio','minimo'=>'Mínimo'];
    $cor = \App\Models\Candidatura::$statusColors[$candidatura->status] ?? '#94a3b8';
@endphp
<div style="max-width:900px;margin:0 auto;">

    <a href="{{ route('daac.candidaturas.index') }}"
       style="display:inline-flex;align-items:center;gap:5px;color:#2563eb;font-weight:600;font-size:0.88rem;text-decoration:none;margin-bottom:20px;">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Voltar à lista
    </a>

    {{-- Cabeçalho --}}
    <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:10px;margin-bottom:20px;">
        <div>
            <h1 style="font-size:1.4rem;font-weight:700;color:#1a2332;margin:0 0 3px;">
                Ficha n.º {{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }} — {{ $candidatura->nome }}
            </h1>
            <p style="color:#64748b;font-size:0.88rem;margin:0;">Submetida em {{ $candidatura->created_at->format('d/m/Y \à\s H:i') }}</p>
        </div>
        <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
            <span style="background:{{ $cor }}20;color:{{ $cor }};padding:5px 14px;border-radius:20px;font-size:0.88rem;font-weight:700;">
                {{ \App\Models\Candidatura::$statusLabels[$candidatura->status] ?? $candidatura->status }}
            </span>
            <a href="{{ route('candidaturas.pdf', $candidatura) }}"
               style="display:inline-flex;align-items:center;gap:6px;background:#0369a1;color:#fff;padding:7px 16px;border-radius:8px;font-weight:600;font-size:0.85rem;text-decoration:none;">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Comprovativo PDF
            </a>
        </div>
    </div>

    @foreach(['success','error'] as $flash)
    @if(session($flash))
        <div style="background:{{ $flash==='success'?'#e8f5e9':'#fee2e2' }};border:1px solid {{ $flash==='success'?'#a5d6a7':'#fca5a5' }};color:{{ $flash==='success'?'#2e7d32':'#b91c1c' }};padding:12px 18px;border-radius:10px;margin-bottom:16px;">
            {{ session($flash) }}
        </div>
    @endif
    @endforeach

    @php
    function daac_campo($label, $value) {
        echo '<div><div style="font-size:0.7rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:2px;">'.$label.'</div>'
           . '<div style="font-size:0.92rem;color:#1a2332;font-weight:500;border-bottom:0.5px solid #f1f5f9;padding-bottom:4px;">'.e($value ?? '—').'</div></div>';
    }
    @endphp

    {{-- 1. DADOS PESSOAIS --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:22px;margin-bottom:14px;">
        <h2 style="font-size:0.8rem;font-weight:700;color:#2563eb;text-transform:uppercase;letter-spacing:0.06em;margin:0 0 16px;padding-bottom:8px;border-bottom:1px solid #f1f5f9;">1. Dados Pessoais</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;">
            @php daac_campo('Nome Completo', $candidatura->nome); @endphp
            @php daac_campo('BI / Passaporte', $candidatura->bi); @endphp
            @php daac_campo('Data de Nascimento', $candidatura->data_nascimento?->format('d/m/Y')); @endphp
            @php daac_campo('Sexo', $candidatura->sexo ? ucfirst($candidatura->sexo) : null); @endphp
            @php daac_campo('Estado Civil', $candidatura->estado_civil); @endphp
            @php daac_campo('BI Emitido em', $candidatura->bi_emitido_em); @endphp
            @php daac_campo('Data Emissão BI', $candidatura->bi_data_emissao?->format('d/m/Y')); @endphp
            @php daac_campo('Nome do Pai', $candidatura->filiacao_pai); @endphp
            @php daac_campo('Nome da Mãe', $candidatura->filiacao_mae); @endphp
            @php daac_campo('Naturalidade — Município', $candidatura->naturalidade_municipio); @endphp
            @php daac_campo('Naturalidade — Província', $candidatura->naturalidade_provincia); @endphp
            @php daac_campo('Necessidade Educação Especial', $candidatura->necessidade_especial); @endphp
        </div>
    </div>

    {{-- 2. RESIDÊNCIA E CONTACTOS --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:22px;margin-bottom:14px;">
        <h2 style="font-size:0.8rem;font-weight:700;color:#2563eb;text-transform:uppercase;letter-spacing:0.06em;margin:0 0 16px;padding-bottom:8px;border-bottom:1px solid #f1f5f9;">2. Residência e Contactos</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;">
            @php daac_campo('Município de Residência', $candidatura->residencia_municipio); @endphp
            @php daac_campo('Rua / Bairro', $candidatura->residencia_bairro); @endphp
            @php daac_campo('Telefone 1', $candidatura->telefone); @endphp
            @php daac_campo('Telefone 2', $candidatura->telefone2); @endphp
            @php daac_campo('E-mail', $candidatura->email); @endphp
        </div>
    </div>

    {{-- 3. DADOS ACADÉMICOS --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:22px;margin-bottom:14px;">
        <h2 style="font-size:0.8rem;font-weight:700;color:#2563eb;text-transform:uppercase;letter-spacing:0.06em;margin:0 0 16px;padding-bottom:8px;border-bottom:1px solid #f1f5f9;">3. Dados Académicos e Socioeconómicos</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;">
            @php daac_campo('Habilitações Literárias', $candidatura->habilitacoes); @endphp
            @php daac_campo('Escola e Curso de Proveniência', $candidatura->escola_origem); @endphp
            @php daac_campo('Ano de Conclusão', $candidatura->ano_conclusao); @endphp
            @php daac_campo('Estado Financeiro da Família', isset($ef[$candidatura->estado_financeiro]) ? $ef[$candidatura->estado_financeiro] : $candidatura->estado_financeiro); @endphp
            @php daac_campo('Trabalhador', $candidatura->trabalhador === null ? '—' : ($candidatura->trabalhador ? 'Sim' : 'Não')); @endphp
            @php daac_campo('Instituição Laboral', $candidatura->instituicao_laboral); @endphp
        </div>
    </div>

    {{-- 4. INSCRIÇÃO --}}
    <div style="background:#f0f6ff;border:1px solid #bfdbfe;border-radius:14px;padding:22px;margin-bottom:14px;">
        <h2 style="font-size:0.8rem;font-weight:700;color:#2563eb;text-transform:uppercase;letter-spacing:0.06em;margin:0 0 16px;padding-bottom:8px;border-bottom:1px solid #bfdbfe;">4. Inscrição</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;">
            @php daac_campo('Curso a se Inscrever', $candidatura->curso); @endphp
            @php daac_campo('Período', $candidatura->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular'); @endphp
        </div>
    </div>

    @if($candidatura->notas_admin)
    <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:14px;padding:18px 22px;margin-bottom:14px;">
        <div style="font-size:0.8rem;font-weight:700;color:#92400e;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Notas Internas</div>
        <div style="font-size:0.9rem;color:#78350f;white-space:pre-line;">{{ $candidatura->notas_admin }}</div>
    </div>
    @endif

    {{-- ASSINATURA EXISTENTE --}}
    @if($candidatura->isAssinada())
    <div style="background:#f5f3ff;border:2px solid #c4b5fd;border-radius:14px;padding:22px;margin-bottom:14px;">
        <h2 style="font-size:0.8rem;font-weight:700;color:#7c3aed;text-transform:uppercase;letter-spacing:0.06em;margin:0 0 16px;padding-bottom:8px;border-bottom:1px solid #ddd6fe;">✓ Assinatura Digital</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;">
            <div>
                <div style="font-size:0.7rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:2px;">Assinado por</div>
                <div style="font-size:0.95rem;font-weight:700;color:#1a2332;">{{ $candidatura->assinante?->name ?? 'DAAC' }}</div>
            </div>
            <div>
                <div style="font-size:0.7rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:2px;">Data e Hora</div>
                <div style="font-size:0.95rem;font-weight:700;color:#1a2332;">{{ $candidatura->assinado_em->format('d/m/Y \à\s H:i') }}</div>
            </div>
            <div style="grid-column:1/-1;">
                <div style="font-size:0.7rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:4px;">Código de Assinatura</div>
                <div style="font-family:monospace;font-size:1.1rem;font-weight:700;color:#7c3aed;background:#ede9fe;padding:6px 14px;border-radius:6px;display:inline-block;">{{ $candidatura->assinatura_codigo }}</div>
            </div>
        </div>
    </div>

    @else
    {{-- FORMULÁRIO DE ASSINATURA --}}
    <div style="background:#fff;border:2px solid #2563eb;border-radius:14px;padding:22px;margin-bottom:14px;">
        <h2 style="font-size:0.9rem;font-weight:700;color:#2563eb;margin:0 0 8px;">Assinar Digitalmente</h2>
        <p style="font-size:0.85rem;color:#475569;margin-bottom:4px;">
            A assinar como: <strong>{{ Auth::user()->name }}</strong>
        </p>
        <p style="font-size:0.85rem;color:#475569;margin-bottom:16px;">
            Confirme que verificou todos os dados e documentos do candidato.
        </p>
        <form method="POST" action="{{ route('daac.candidaturas.assinar', $candidatura) }}"
              onsubmit="return confirm('Confirma a assinatura digital desta candidatura em seu nome?')">
            @csrf
            <label style="display:flex;align-items:flex-start;gap:10px;margin-bottom:14px;cursor:pointer;">
                <input type="checkbox" name="confirmar" value="1" style="margin-top:2px;accent-color:#2563eb;">
                <span style="font-size:0.88rem;color:#334155;">
                    Eu, <strong>{{ Auth::user()->name }}</strong>, declaro que verifiquei os dados e documentos desta candidatura e assino digitalmente
                    em nome do DAAC — Departamento dos Assuntos Académicos do ISP-Bié.
                </span>
            </label>
            @error('confirmar')<p style="font-size:0.78rem;color:#dc2626;margin:0 0 10px;font-weight:400;">{{ $message }}</p>@enderror
            <button type="submit"
                    style="background:#2563eb;color:#fff;border:none;border-radius:8px;padding:10px 26px;font-weight:700;cursor:pointer;font-size:0.9rem;display:inline-flex;align-items:center;gap:7px;">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Assinar e Concluir
            </button>
        </form>
    </div>

    {{-- FORMULÁRIO DE REJEIÇÃO --}}
    <div style="background:#fff;border:1px solid #fca5a5;border-radius:14px;padding:22px;">
        <h2 style="font-size:0.9rem;font-weight:700;color:#b91c1c;margin:0 0 8px;">Rejeitar Candidatura</h2>
        <p style="font-size:0.85rem;color:#475569;margin-bottom:14px;">
            Se a documentação estiver incompleta ou houver irregularidades, indique o motivo abaixo.
        </p>
        <form method="POST" action="{{ route('daac.candidaturas.rejeitar', $candidatura) }}"
              onsubmit="return confirm('Tem a certeza que pretende rejeitar esta candidatura?')">
            @csrf
            <div style="margin-bottom:12px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#b91c1c;margin-bottom:5px;">Motivo da Rejeição <span style="color:#ef4444;">*</span></label>
                <textarea name="motivo_rejeicao" required maxlength="1000" rows="3"
                          style="width:100%;border:1px solid #fca5a5;border-radius:8px;padding:9px 12px;font-size:0.88rem;resize:vertical;box-sizing:border-box;"
                          placeholder="Ex: Documentação incompleta — falta o comprovativo de pagamento...">{{ old('motivo_rejeicao') }}</textarea>
                @error('motivo_rejeicao')<p style="font-size:0.78rem;color:#dc2626;margin-top:4px;font-weight:400;">{{ $message }}</p>@enderror
            </div>
            <button type="submit"
                    style="background:#ef4444;color:#fff;border:none;border-radius:8px;padding:9px 22px;font-weight:700;cursor:pointer;font-size:0.88rem;">
                Rejeitar Candidatura
            </button>
        </form>
    </div>
    @endif

</div>
@endsection
