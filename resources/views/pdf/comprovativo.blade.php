@php
    $logoPath = public_path('images/logo.png');
    $logoBase64 = '';
    if (file_exists($logoPath) && filesize($logoPath) > 0) {
        $logoBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
    }
@endphp
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body {
    font-family: DejaVu Sans, Arial, sans-serif;
    font-size: 10pt;
    color: #1a1a1a;
    background: #fff;
}

.page { padding: 12mm 14mm; }

/* ─── CABEÇALHO ─── */
.header {
    display: table;
    width: 100%;
    margin-bottom: 4mm;
}
.header-logo {
    display: table-cell;
    width: 28mm;
    vertical-align: middle;
}
.header-logo img {
    width: 24mm;
    height: auto;
}
.header-text {
    display: table-cell;
    vertical-align: middle;
    text-align: center;
}
.inst-name {
    font-size: 13pt;
    font-weight: bold;
    color: #1a4e8a;
    letter-spacing: 0.5px;
    margin-bottom: 1mm;
}
.inst-dept {
    font-size: 9pt;
    font-weight: bold;
    margin-bottom: 0.5mm;
}
.inst-exam {
    font-size: 9pt;
    font-weight: bold;
    margin-bottom: 0.5mm;
}
.inst-title {
    font-size: 10pt;
    font-weight: bold;
}
.ficha-num-cell {
    display: table-cell;
    width: 28mm;
    vertical-align: middle;
    text-align: right;
}
.ficha-num {
    font-size: 11pt;
    font-weight: bold;
    white-space: nowrap;
}

.linha-dupla {
    border-top: 3px double #1a4e8a;
    margin: 2mm 0 3mm 0;
}

/* ─── CAMPOS ─── */
.campo {
    margin-bottom: 2.5mm;
    display: table;
    width: 100%;
}
.campo-label {
    display: table-cell;
    font-weight: bold;
    font-size: 9.5pt;
    white-space: nowrap;
    padding-right: 2mm;
    vertical-align: bottom;
}
.campo-valor {
    display: table-cell;
    width: 100%;
    border-bottom: 0.8pt solid #333;
    vertical-align: bottom;
    padding-bottom: 0.5mm;
    font-size: 9.5pt;
}

/* linha de 2 colunas */
.row2 { display: table; width: 100%; margin-bottom: 2.5mm; }
.col { display: table-cell; vertical-align: bottom; }
.col-label { font-weight: bold; font-size: 9.5pt; white-space: nowrap; padding-right: 2mm; }
.col-val { border-bottom: 0.8pt solid #333; padding-bottom: 0.5mm; font-size: 9.5pt; }

/* checkboxes */
.check-row { display: table; width: 100%; margin-bottom: 2.5mm; }
.check-label { display: table-cell; font-weight: bold; font-size: 9.5pt; padding-right: 3mm; white-space: nowrap; vertical-align: middle; }
.check-item { display: table-cell; vertical-align: middle; white-space: nowrap; padding-right: 4mm; font-size: 9.5pt; }
.box {
    display: inline-block;
    width: 3.5mm;
    height: 3.5mm;
    border: 0.8pt solid #333;
    vertical-align: middle;
    margin-right: 1mm;
    background: #fff;
    text-align: center;
    font-size: 7pt;
    line-height: 3.5mm;
}
.box.on { background: #1a4e8a; color: #fff; }

/* data */
.data-linha { font-size: 9.5pt; margin: 3mm 0 4mm 0; }

/* assinaturas */
.sigs { display: table; width: 100%; margin-top: 4mm; }
.sig { display: table-cell; width: 44%; text-align: center; }
.sig-line { border-bottom: 0.8pt solid #333; margin-bottom: 1mm; height: 7mm; }
.sig-label { font-size: 8.5pt; font-weight: bold; }

/* ─── LINHA DE CORTE ─── */
.corte {
    border-top: 1.5pt dashed #999;
    margin: 5mm 0;
    text-align: center;
    position: relative;
}
.corte-texto {
    background: #fff;
    padding: 0 3mm;
    font-size: 7pt;
    color: #999;
    position: relative;
    top: -1.5mm;
}

/* ─── SECÇÃO INFERIOR (talão candidato) ─── */
.talao-title {
    font-size: 9pt;
    font-weight: bold;
    color: #1a4e8a;
    margin-bottom: 3mm;
    text-align: center;
}
</style>
</head>
<body>
<div class="page">

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- SECÇÃO 1 — ARQUIVO (cópia completa)                     --}}
{{-- ═══════════════════════════════════════════════════════ --}}

<div class="header">
    <div class="header-logo">
        @if($logoBase64)
            <img src="{{ $logoBase64 }}" alt="ISP-Bié">
        @endif
    </div>
    <div class="header-text">
        <div class="inst-name">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</div>
        <div class="inst-dept">DEPARTAMENTO DOS ASSUNTOS ACADÉMICOS</div>
        <div class="inst-exam">EXAME DE ACESSO 2025/2026</div>
        <div class="inst-title">FICHA DE INSCRIÇÃO</div>
    </div>
    <div class="ficha-num-cell">
        <div class="ficha-num">Ficha n.º<br>{{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}</div>
    </div>
</div>

<div class="linha-dupla"></div>

{{-- Nome --}}
<div class="campo">
    <div class="campo-label">Nome:</div>
    <div class="campo-valor">{{ $candidatura->nome }}</div>
</div>

{{-- Filiação --}}
<div class="row2">
    <div class="col" style="width:auto">
        <span class="col-label">Filiação:</span>
    </div>
    <div class="col" style="width:45%">
        <div style="border-bottom:0.8pt solid #333;padding-bottom:0.5mm;font-size:9.5pt;">{{ $candidatura->filiacao_pai }}</div>
    </div>
    <div class="col" style="width:auto;padding:0 2mm;">
        <span class="col-label">e de</span>
    </div>
    <div class="col">
        <div style="border-bottom:0.8pt solid #333;padding-bottom:0.5mm;font-size:9.5pt;">{{ $candidatura->filiacao_mae }}</div>
    </div>
</div>

{{-- Data Nascimento --}}
<div class="campo">
    <div class="campo-label">Data de Nascimento:</div>
    <div class="campo-valor" style="max-width:50mm;">{{ $candidatura->data_nascimento?->format('d/m/Y') }}</div>
</div>

{{-- Naturalidade --}}
<div class="row2">
    <div class="col" style="width:auto"><span class="col-label">Naturalidade: Município de</span></div>
    <div class="col" style="width:40%"><div class="col-val">{{ $candidatura->naturalidade_municipio }}</div></div>
    <div class="col" style="width:auto;padding:0 2mm;"><span class="col-label">Província de</span></div>
    <div class="col"><div class="col-val">{{ $candidatura->naturalidade_provincia }}</div></div>
</div>

{{-- BI --}}
<div class="row2">
    <div class="col" style="width:auto"><span class="col-label">BI / Passaporte N.º</span></div>
    <div class="col" style="width:28%"><div class="col-val">{{ $candidatura->bi }}</div></div>
    <div class="col" style="width:auto;padding:0 2mm;"><span class="col-label">Emitido em</span></div>
    <div class="col" style="width:25%"><div class="col-val">{{ $candidatura->bi_emitido_em }}</div></div>
    <div class="col" style="width:auto;padding:0 2mm;"><span class="col-label">aos</span></div>
    <div class="col"><div class="col-val">{{ $candidatura->bi_data_emissao?->format('d/m/Y') }}</div></div>
</div>

{{-- Sexo + Estado Civil --}}
<div class="check-row">
    <div class="check-label">Sexo:</div>
    <div class="check-item">
        <span class="box {{ $candidatura->sexo === 'masculino' ? 'on' : '' }}">{{ $candidatura->sexo === 'masculino' ? '✓' : '' }}</span> Masculino
    </div>
    <div class="check-item">
        <span class="box {{ $candidatura->sexo === 'feminino' ? 'on' : '' }}">{{ $candidatura->sexo === 'feminino' ? '✓' : '' }}</span> Feminino
    </div>
    <div class="check-label" style="padding-left:4mm;">Estado Civil:</div>
    <div class="col-val" style="width:100%;border-bottom:0.8pt solid #333;padding-bottom:0.5mm;font-size:9.5pt;">{{ $candidatura->estado_civil }}</div>
</div>

{{-- Necessidade Especial --}}
<div class="campo">
    <div class="campo-label">Necessidade de Educação Especial:</div>
    <div class="campo-valor">{{ $candidatura->necessidade_especial }}</div>
</div>

{{-- Residência --}}
<div class="row2">
    <div class="col" style="width:auto"><span class="col-label">Residência (Município):</span></div>
    <div class="col" style="width:38%"><div class="col-val">{{ $candidatura->residencia_municipio }}</div></div>
    <div class="col" style="width:auto;padding:0 2mm;"><span class="col-label">Rua/Bairro:</span></div>
    <div class="col"><div class="col-val">{{ $candidatura->residencia_bairro }}</div></div>
</div>

{{-- Telefone + Email --}}
<div class="row2">
    <div class="col" style="width:auto"><span class="col-label">Telefone:</span></div>
    <div class="col" style="width:22%"><div class="col-val">{{ $candidatura->telefone }}</div></div>
    @if($candidatura->telefone2)
    <div class="col" style="width:auto;padding:0 2mm;">/</div>
    <div class="col" style="width:20%"><div class="col-val">{{ $candidatura->telefone2 }}</div></div>
    @endif
    <div class="col" style="width:auto;padding:0 2mm;"><span class="col-label">E-mail:</span></div>
    <div class="col"><div class="col-val">{{ $candidatura->email }}</div></div>
</div>

{{-- Habilitações + Escola --}}
<div class="row2">
    <div class="col" style="width:auto"><span class="col-label">Habilitações Literárias:</span></div>
    <div class="col" style="width:20%"><div class="col-val">{{ $candidatura->habilitacoes }}</div></div>
    <div class="col" style="width:auto;padding:0 2mm;"><span class="col-label">Escola e Curso de Proveniência:</span></div>
    <div class="col"><div class="col-val">{{ $candidatura->escola_origem }}</div></div>
</div>

{{-- Estado Financeiro --}}
@php $ef = ['maximo'=>'Máximo','medio'=>'Médio','minimo'=>'Mínimo']; @endphp
<div class="check-row">
    <div class="check-label">Estado Financeiro da Família:</div>
    @foreach($ef as $val => $label)
    <div class="check-item">
        <span class="box {{ $candidatura->estado_financeiro === $val ? 'on' : '' }}">{{ $candidatura->estado_financeiro === $val ? '✓' : '' }}</span> {{ $label }}
    </div>
    @endforeach
</div>

{{-- Trabalhador --}}
<div class="check-row">
    <div class="check-label">Trabalhador:</div>
    <div class="check-item">
        <span class="box {{ $candidatura->trabalhador ? 'on' : '' }}">{{ $candidatura->trabalhador ? '✓' : '' }}</span> Sim
    </div>
    <div class="check-item">
        <span class="box {{ !$candidatura->trabalhador ? 'on' : '' }}">{{ !$candidatura->trabalhador ? '✓' : '' }}</span> Não
    </div>
    <div class="check-label" style="padding-left:3mm;">Instituição Laboral:</div>
    <div class="col-val" style="width:100%;border-bottom:0.8pt solid #333;padding-bottom:0.5mm;font-size:9.5pt;">{{ $candidatura->instituicao_laboral ?? '' }}</div>
</div>

{{-- Curso + Período --}}
<div class="check-row">
    <div class="check-label">Curso a se inscrever:</div>
    <div class="col-val" style="width:55%;border-bottom:0.8pt solid #333;padding-bottom:0.5mm;font-size:9.5pt;padding-right:3mm;">{{ $candidatura->curso }}</div>
    <div class="check-label" style="padding-left:3mm;">Período:</div>
    <div class="check-item">
        <span class="box {{ $candidatura->periodo === 'regular' ? 'on' : '' }}">{{ $candidatura->periodo === 'regular' ? '✓' : '' }}</span> Regular
    </div>
    <div class="check-item">
        <span class="box {{ $candidatura->periodo === 'pos-laboral' ? 'on' : '' }}">{{ $candidatura->periodo === 'pos-laboral' ? '✓' : '' }}</span> Pós-laboral
    </div>
</div>

<div class="data-linha">
    Cuito, aos <u>&nbsp;&nbsp;{{ $candidatura->created_at->format('d') }}&nbsp;&nbsp;</u>
    de <u>&nbsp;&nbsp;{{ $candidatura->created_at->translatedFormat('F') }}&nbsp;&nbsp;</u>
    de {{ $candidatura->created_at->format('Y') }}.
</div>

<div class="sigs">
    <div class="sig">
        <div class="sig-line"></div>
        <div class="sig-label">Conferiu</div>
    </div>
    <div class="sig" style="width:12%;"></div>
    <div class="sig">
        <div class="sig-line"></div>
        <div class="sig-label">Candidato (a)</div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- LINHA DE CORTE                                          --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<div class="corte">
    <span class="corte-texto">✂ &nbsp; recortar aqui &nbsp; ✂</span>
</div>

{{-- ═══════════════════════════════════════════════════════ --}}
{{-- SECÇÃO 2 — TALÃO DO CANDIDATO                           --}}
{{-- ═══════════════════════════════════════════════════════ --}}

<div class="header">
    <div class="header-logo">
        @if($logoBase64)
            <img src="{{ $logoBase64 }}" alt="ISP-Bié">
        @endif
    </div>
    <div class="header-text">
        <div class="inst-name">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</div>
        <div class="inst-dept">DEPARTAMENTO DOS ASSUNTOS ACADÉMICOS</div>
        <div class="inst-exam">EXAME DE ACESSO 2025/2026</div>
        <div class="inst-title">FICHA DE INSCRIÇÃO</div>
    </div>
    <div class="ficha-num-cell">
        <div class="ficha-num">Ficha n.º<br>{{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}</div>
    </div>
</div>

<div class="linha-dupla"></div>

<div class="campo">
    <div class="campo-label">Nome:</div>
    <div class="campo-valor">{{ $candidatura->nome }}</div>
</div>

<div class="check-row" style="margin-bottom:3mm;">
    <div class="check-label">Sexo:</div>
    <div class="check-item">
        <span class="box {{ $candidatura->sexo === 'masculino' ? 'on' : '' }}">{{ $candidatura->sexo === 'masculino' ? '✓' : '' }}</span> Masculino
    </div>
    <div class="check-item">
        <span class="box {{ $candidatura->sexo === 'feminino' ? 'on' : '' }}">{{ $candidatura->sexo === 'feminino' ? '✓' : '' }}</span> Feminino
    </div>
</div>

<div class="check-row">
    <div class="check-label">Curso a se inscrever:</div>
    <div class="col-val" style="width:55%;border-bottom:0.8pt solid #333;padding-bottom:0.5mm;font-size:9.5pt;padding-right:3mm;">{{ $candidatura->curso }}</div>
    <div class="check-label" style="padding-left:3mm;">Período:</div>
    <div class="check-item">
        <span class="box {{ $candidatura->periodo === 'regular' ? 'on' : '' }}">{{ $candidatura->periodo === 'regular' ? '✓' : '' }}</span> Regular
    </div>
    <div class="check-item">
        <span class="box {{ $candidatura->periodo === 'pos-laboral' ? 'on' : '' }}">{{ $candidatura->periodo === 'pos-laboral' ? '✓' : '' }}</span> Pós-laboral
    </div>
</div>

<div class="data-linha">
    Cuito, aos <u>&nbsp;&nbsp;{{ $candidatura->created_at->format('d') }}&nbsp;&nbsp;</u>
    de <u>&nbsp;&nbsp;{{ $candidatura->created_at->translatedFormat('F') }}&nbsp;&nbsp;</u>
    de {{ $candidatura->created_at->format('Y') }}.
</div>

<div class="sigs">
    <div class="sig">
        <div class="sig-line"></div>
        <div class="sig-label">Conferiu</div>
    </div>
    <div class="sig" style="width:12%;"></div>
    <div class="sig">
        <div class="sig-line"></div>
        <div class="sig-label">Candidato (a)</div>
    </div>
</div>

</div>{{-- /page --}}
</body>
</html>
