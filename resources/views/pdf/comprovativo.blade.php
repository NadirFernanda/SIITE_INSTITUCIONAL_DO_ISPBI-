@php
    $logoPath   = public_path('images/logo.png');
    $logoBase64 = (file_exists($logoPath) && filesize($logoPath) > 0)
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
        : '';
    $periodoLabel = $candidatura->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular';
    $efMap = ['maximo' => 'Máximo', 'medio' => 'Médio', 'minimo' => 'Mínimo'];
@endphp
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<style>
@page { size: A4 portrait; margin: 14mm 16mm; }
* { margin:0; padding:0; box-sizing:border-box; }
html, body { width:100%; font-family: DejaVu Sans, Arial, sans-serif; font-size:9.5pt; color:#1a1a2e; }

/* ── CABEÇALHO ── */
.header { display:table; width:100%; border-bottom:2.5pt solid #1a4e8a; padding-bottom:5mm; margin-bottom:5mm; }
.header-logo { display:table-cell; width:22mm; vertical-align:middle; }
.header-logo img { width:18mm; height:auto; }
.header-center { display:table-cell; vertical-align:middle; text-align:center; }
.header-right { display:table-cell; width:34mm; vertical-align:middle; text-align:right; }
.inst-name { font-size:11pt; font-weight:bold; color:#1a4e8a; letter-spacing:0.3px; }
.inst-sub  { font-size:8pt; font-weight:bold; color:#333; margin-top:1.5mm; }
.inst-doc  { font-size:8.5pt; font-weight:bold; color:#555; margin-top:1mm; }
.ficha-box { background:#1a4e8a; color:#fff; padding:4px 10px; border-radius:4px; display:inline-block; font-size:9pt; font-weight:bold; }

/* ── SECÇÃO ── */
.section { margin-bottom:4mm; }
.section-title {
    font-size:7.5pt; font-weight:bold; color:#fff;
    background:#1a4e8a; padding:2.5px 8px;
    text-transform:uppercase; letter-spacing:0.06em;
    margin-bottom:2mm;
}
.grid { display:table; width:100%; }
.grid-row { display:table-row; }
.cell { display:table-cell; padding:2px 4px 4px; vertical-align:top; }
.cell-label { font-size:7pt; font-weight:bold; color:#888; text-transform:uppercase; letter-spacing:0.04em; }
.cell-val   { font-size:9pt; color:#1a1a2e; font-weight:500; border-bottom:0.5pt solid #ddd; padding-bottom:1px; min-height:5mm; }

/* checklist */
.chk-row { display:table; width:100%; margin-bottom:1.5mm; }
.chk-item { display:table-cell; white-space:nowrap; padding-right:6mm; font-size:9pt; vertical-align:middle; }
.chk-box { display:inline-block; width:3.5mm; height:3.5mm; border:0.8pt solid #555; vertical-align:middle; margin-right:1.5mm; background:#fff; text-align:center; line-height:3.5mm; font-size:6pt; }
.chk-box.on { background:#1a4e8a; border-color:#1a4e8a; color:#fff; }
.chk-label { display:table-cell; font-weight:bold; font-size:8.5pt; padding-right:4mm; vertical-align:middle; white-space:nowrap; }
.chk-val   { display:table-cell; font-size:9pt; vertical-align:middle; border-bottom:0.5pt solid #ddd; width:100%; padding-bottom:1px; }

/* ── ASSINATURA ── */
.sig-block { text-align:center; margin-top:6mm; }
.sig-line { border-bottom:0.8pt solid #555; width:65mm; margin:0 auto 1.5mm; height:7mm; }
.sig-name  { font-size:8.5pt; font-weight:bold; }
.sig-title { font-size:7.5pt; color:#555; margin-top:1mm; }

/* ── RODAPÉ ── */
.footer { text-align:center; font-size:7pt; color:#aaa; margin-top:5mm; border-top:0.5pt solid #eee; padding-top:2.5mm; }

.badge {
    display:inline-block; background:#e8f4fd; color:#1a4e8a;
    border:0.8pt solid #b3d4f0; border-radius:3px;
    font-size:8pt; font-weight:bold; padding:1px 7px;
}
</style>
</head>
<body>

{{-- CABEÇALHO --}}
<div class="header">
    <div class="header-logo">
        @if($logoBase64)<img src="{{ $logoBase64 }}" alt="ISP-Bié">@endif
    </div>
    <div class="header-center">
        <div class="inst-name">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</div>
        <div class="inst-sub">DEPARTAMENTO DOS ASSUNTOS ACADÉMICOS</div>
        <div class="inst-doc">COMPROVATIVO DE CANDIDATURA — EXAME DE ACESSO 2025/2026</div>
    </div>
    <div class="header-right">
        <div class="ficha-box">N.º {{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}</div>
    </div>
</div>

{{-- DADOS PESSOAIS --}}
<div class="section">
    <div class="section-title">Dados Pessoais</div>

    <div class="grid">
        <div class="grid-row">
            <div class="cell" style="width:55%">
                <div class="cell-label">Nome Completo</div>
                <div class="cell-val">{{ $candidatura->nome }}</div>
            </div>
            <div class="cell" style="width:22%">
                <div class="cell-label">BI / Passaporte</div>
                <div class="cell-val">{{ $candidatura->bi }}</div>
            </div>
            <div class="cell" style="width:23%">
                <div class="cell-label">Data de Nascimento</div>
                <div class="cell-val">{{ $candidatura->data_nascimento?->format('d/m/Y') ?? '—' }}</div>
            </div>
        </div>
        <div class="grid-row">
            <div class="cell" style="width:50%">
                <div class="cell-label">Nome do Pai</div>
                <div class="cell-val">{{ $candidatura->filiacao_pai ?? '—' }}</div>
            </div>
            <div class="cell" style="width:50%">
                <div class="cell-label">Nome da Mãe</div>
                <div class="cell-val">{{ $candidatura->filiacao_mae ?? '—' }}</div>
            </div>
        </div>
        <div class="grid-row">
            <div class="cell" style="width:30%">
                <div class="cell-label">Naturalidade — Município</div>
                <div class="cell-val">{{ $candidatura->naturalidade_municipio }}</div>
            </div>
            <div class="cell" style="width:30%">
                <div class="cell-label">Naturalidade — Província</div>
                <div class="cell-val">{{ $candidatura->naturalidade_provincia }}</div>
            </div>
            <div class="cell" style="width:20%">
                <div class="cell-label">BI Emitido em</div>
                <div class="cell-val">{{ $candidatura->bi_emitido_em }}</div>
            </div>
            <div class="cell" style="width:20%">
                <div class="cell-label">Data de Emissão BI</div>
                <div class="cell-val">{{ $candidatura->bi_data_emissao?->format('d/m/Y') ?? '—' }}</div>
            </div>
        </div>
    </div>

    {{-- Sexo + Estado Civil --}}
    <div class="chk-row" style="margin-top:2mm;">
        <div class="chk-label">Sexo:</div>
        <div class="chk-item"><span class="chk-box {{ $candidatura->sexo === 'masculino' ? 'on' : '' }}">{{ $candidatura->sexo === 'masculino' ? '✓' : '' }}</span> Masculino</div>
        <div class="chk-item"><span class="chk-box {{ $candidatura->sexo === 'feminino' ? 'on' : '' }}">{{ $candidatura->sexo === 'feminino' ? '✓' : '' }}</span> Feminino</div>
        <div class="chk-label" style="padding-left:6mm;">Estado Civil:</div>
        <div class="chk-val">{{ $candidatura->estado_civil }}</div>
    </div>
    <div style="margin-top:2mm;">
        <div class="cell-label">Necessidade de Educação Especial</div>
        <div class="cell-val">{{ $candidatura->necessidade_especial }}</div>
    </div>
</div>

{{-- RESIDÊNCIA E CONTACTOS --}}
<div class="section">
    <div class="section-title">Residência e Contactos</div>
    <div class="grid">
        <div class="grid-row">
            <div class="cell" style="width:30%">
                <div class="cell-label">Município de Residência</div>
                <div class="cell-val">{{ $candidatura->residencia_municipio }}</div>
            </div>
            <div class="cell" style="width:35%">
                <div class="cell-label">Rua / Bairro</div>
                <div class="cell-val">{{ $candidatura->residencia_bairro }}</div>
            </div>
            <div class="cell" style="width:17%">
                <div class="cell-label">Telefone 1</div>
                <div class="cell-val">{{ $candidatura->telefone }}</div>
            </div>
            <div class="cell" style="width:18%">
                <div class="cell-label">Telefone 2</div>
                <div class="cell-val">{{ $candidatura->telefone2 ?? '—' }}</div>
            </div>
        </div>
        <div class="grid-row">
            <div class="cell" style="width:50%">
                <div class="cell-label">E-mail</div>
                <div class="cell-val">{{ $candidatura->email }}</div>
            </div>
        </div>
    </div>
</div>

{{-- DADOS ACADÉMICOS --}}
<div class="section">
    <div class="section-title">Dados Académicos e Socioeconómicos</div>
    <div class="grid">
        <div class="grid-row">
            <div class="cell" style="width:22%">
                <div class="cell-label">Habilitações Literárias</div>
                <div class="cell-val">{{ $candidatura->habilitacoes }}</div>
            </div>
            <div class="cell" style="width:48%">
                <div class="cell-label">Escola e Curso de Proveniência</div>
                <div class="cell-val">{{ $candidatura->escola_origem }}</div>
            </div>
            <div class="cell" style="width:15%">
                <div class="cell-label">Ano de Conclusão</div>
                <div class="cell-val">{{ $candidatura->ano_conclusao }}</div>
            </div>
            <div class="cell" style="width:15%">
                <div class="cell-label">Estado Financeiro</div>
                <div class="cell-val">{{ $efMap[$candidatura->estado_financeiro] ?? '—' }}</div>
            </div>
        </div>
    </div>

    <div class="chk-row" style="margin-top:2mm;">
        <div class="chk-label">Trabalhador:</div>
        <div class="chk-item"><span class="chk-box {{ $candidatura->trabalhador ? 'on' : '' }}">{{ $candidatura->trabalhador ? '✓' : '' }}</span> Sim</div>
        <div class="chk-item"><span class="chk-box {{ !$candidatura->trabalhador ? 'on' : '' }}">{{ !$candidatura->trabalhador ? '✓' : '' }}</span> Não</div>
        @if($candidatura->instituicao_laboral)
        <div class="chk-label" style="padding-left:6mm;">Instituição:</div>
        <div class="chk-val">{{ $candidatura->instituicao_laboral }}</div>
        @endif
    </div>
</div>

{{-- INSCRIÇÃO --}}
<div class="section">
    <div class="section-title">Inscrição</div>
    <div class="chk-row">
        <div class="chk-label">Curso:</div>
        <div class="chk-val" style="font-weight:bold;">{{ $candidatura->curso }}</div>
        <div class="chk-label" style="padding-left:8mm;">Período:</div>
        <div class="chk-item"><span class="chk-box {{ $candidatura->periodo === 'regular' ? 'on' : '' }}">{{ $candidatura->periodo === 'regular' ? '✓' : '' }}</span> Regular</div>
        <div class="chk-item"><span class="chk-box {{ $candidatura->periodo === 'pos-laboral' ? 'on' : '' }}">{{ $candidatura->periodo === 'pos-laboral' ? '✓' : '' }}</span> Pós-Laboral</div>
    </div>
    <div style="margin-top:2.5mm;">
        <span class="badge">Estado: {{ \App\Models\Candidatura::$statusLabels[$candidatura->status] ?? $candidatura->status }}</span>
        &nbsp;&nbsp;
        <span style="font-size:8pt;color:#666;">Submetido em {{ $candidatura->created_at->format('d/m/Y \à\s H:i') }}</span>
    </div>
</div>

{{-- DATA --}}
<div style="font-size:9pt; margin-top:3mm;">
    Cuito, aos <u>&nbsp;&nbsp;{{ $candidatura->created_at->format('d') }}&nbsp;&nbsp;</u>
    de <u>&nbsp;&nbsp;{{ $candidatura->created_at->translatedFormat('F') }}&nbsp;&nbsp;</u>
    de {{ $candidatura->created_at->format('Y') }}.
</div>

{{-- ASSINATURAS --}}
<div style="display:table;width:100%;margin-top:6mm;">
    <div style="display:table-cell;width:42%;text-align:center;vertical-align:bottom;">
        <div style="border-bottom:0.8pt solid #555;height:7mm;margin-bottom:1.5mm;"></div>
        <div style="font-size:8.5pt;font-weight:bold;">Conferiu</div>
        <div style="font-size:7.5pt;color:#777;margin-top:0.5mm;">(Funcionário da Instituição)</div>
    </div>
    <div style="display:table-cell;width:16%;"></div>
    <div style="display:table-cell;width:42%;text-align:center;vertical-align:bottom;">
        <div style="border-bottom:0.8pt solid #555;height:7mm;margin-bottom:1.5mm;"></div>
        <div style="font-size:8.5pt;font-weight:bold;">Professor Doutor Fernando Maia</div>
        <div style="font-size:7.5pt;color:#777;margin-top:0.5mm;">Presidente da Instituição</div>
    </div>
</div>

<div class="footer">
    Comprovativo gerado em {{ now()->format('d/m/Y H:i') }} &mdash; ISP-Bié &mdash; Documento válido para apresentação no dia do exame
</div>

</body>
</html>
