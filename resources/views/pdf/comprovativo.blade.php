@php
    $logoPath   = public_path('images/logo.png');
    $logoBase64 = (file_exists($logoPath) && filesize($logoPath) > 0)
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
        : '';
    $fichaNum   = str_pad($candidatura->id, 5, '0', STR_PAD_LEFT);
    $periodoLabel = $candidatura->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular';
    $efLabels = ['maximo'=>'Máximo','medio'=>'Médio','minimo'=>'Mínimo'];
@endphp
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family: DejaVu Sans, Arial, sans-serif; font-size:9.5pt; color:#1a1a2e; background:#f4f6fb; }

.page { padding:10mm 12mm 10mm 12mm; }

/* ── TOPO ── */
.top-bar {
    background: #1565C0;
    color: #fff;
    padding: 5mm 8mm;
    border-radius: 3mm 3mm 0 0;
    display: table;
    width: 100%;
}
.top-logo { display:table-cell; width:22mm; vertical-align:middle; }
.top-logo img { height:14mm; width:auto; }
.top-text { display:table-cell; vertical-align:middle; padding-left:4mm; }
.top-inst { font-size:12pt; font-weight:bold; letter-spacing:0.3px; }
.top-sub  { font-size:8pt; opacity:0.85; margin-top:1mm; }
.top-num  { display:table-cell; vertical-align:middle; text-align:right; white-space:nowrap; }
.top-num .label { font-size:7pt; opacity:0.8; text-transform:uppercase; letter-spacing:1px; }
.top-num .num   { font-size:18pt; font-weight:bold; line-height:1; }

/* ── FAIXA DO TÍTULO ── */
.title-bar {
    background: #0d47a1;
    color: #fff;
    text-align: center;
    padding: 3mm 0;
    font-size: 10pt;
    font-weight: bold;
    letter-spacing: 2px;
    text-transform: uppercase;
}

/* ── CORPO ── */
.body-wrap {
    background: #fff;
    border: 0.5pt solid #dde3f0;
    border-top: none;
    border-radius: 0 0 3mm 3mm;
    padding: 6mm 8mm;
}

/* ── SECÇÕES ── */
.section { margin-bottom: 5mm; }
.section-title {
    font-size: 7.5pt;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #1565C0;
    border-bottom: 1.5pt solid #1565C0;
    padding-bottom: 1mm;
    margin-bottom: 3mm;
}

/* ── GRID DE CAMPOS ── */
.grid { display: table; width: 100%; border-collapse: collapse; }
.grid-row { display: table-row; }
.grid-cell {
    display: table-cell;
    padding: 1.5mm 2mm 1.5mm 0;
    vertical-align: top;
    width: 50%;
}
.field-label {
    font-size: 7pt;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin-bottom: 0.5mm;
}
.field-value {
    font-size: 9.5pt;
    font-weight: bold;
    color: #1a1a2e;
    border-bottom: 0.5pt solid #dde3f0;
    padding-bottom: 1mm;
    min-height: 5mm;
}

/* ── DESTAQUE CURSO ── */
.curso-block {
    background: #e8f0fe;
    border-left: 3pt solid #1565C0;
    border-radius: 1mm;
    padding: 3mm 4mm;
    margin: 4mm 0;
    display: table;
    width: 100%;
}
.curso-block .cb-left  { display:table-cell; vertical-align:middle; }
.curso-block .cb-right { display:table-cell; vertical-align:middle; text-align:right; white-space:nowrap; }
.curso-block .cb-label { font-size:7pt; color:#555; text-transform:uppercase; letter-spacing:0.8px; }
.curso-block .cb-value { font-size:11pt; font-weight:bold; color:#1565C0; margin-top:0.5mm; }
.periodo-badge {
    background: #1565C0;
    color: #fff;
    font-size: 8pt;
    font-weight: bold;
    padding: 1.5mm 4mm;
    border-radius: 10mm;
    display: inline-block;
}

/* ── AVISO ── */
.aviso {
    background: #fff8e1;
    border: 0.5pt solid #ffe082;
    border-radius: 2mm;
    padding: 3mm 4mm;
    margin-top: 4mm;
    font-size: 8pt;
    color: #5d4037;
}
.aviso strong { color: #e65100; }

/* ── RODAPÉ ── */
.footer-bar {
    background: #f4f6fb;
    border-top: 0.5pt solid #dde3f0;
    margin-top: 5mm;
    padding: 3mm 0 0 0;
    display: table;
    width: 100%;
}
.footer-date { display:table-cell; vertical-align:middle; font-size:8pt; color:#666; }
.footer-sig  { display:table-cell; vertical-align:middle; text-align:center; width:55mm; }
.footer-sig .sig-line { border-top: 0.8pt solid #aaa; width:50mm; margin:0 auto 1mm; padding-top:1mm; }
.footer-sig .sig-name { font-size:7.5pt; font-weight:bold; color:#333; }
.footer-sig .sig-role { font-size:7pt; color:#666; font-style:italic; }
</style>
</head>
<body>
<div class="page">

    {{-- ── TOPO AZUL ── --}}
    <div class="top-bar">
        <div class="top-logo">
            @if($logoBase64)<img src="{{ $logoBase64 }}" alt="ISP-Bié">@endif
        </div>
        <div class="top-text">
            <div class="top-inst">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</div>
            <div class="top-sub">Departamento dos Assuntos Académicos &nbsp;·&nbsp; Exame de Acesso 2025/2026</div>
        </div>
        <div class="top-num">
            <div class="label">Ficha n.º</div>
            <div class="num">{{ $fichaNum }}</div>
        </div>
    </div>

    {{-- ── TÍTULO ── --}}
    <div class="title-bar">Comprovativo de Candidatura</div>

    {{-- ── CORPO ── --}}
    <div class="body-wrap">

        {{-- Dados Pessoais --}}
        <div class="section">
            <div class="section-title">Dados Pessoais</div>
            <div class="grid">
                <div class="grid-row">
                    <div class="grid-cell" style="width:100%;">
                        <div class="field-label">Nome Completo</div>
                        <div class="field-value">{{ strtoupper($candidatura->nome) }}</div>
                    </div>
                </div>
                <div class="grid-row">
                    <div class="grid-cell">
                        <div class="field-label">Bilhete de Identidade</div>
                        <div class="field-value">{{ $candidatura->bi ?? '—' }}</div>
                    </div>
                    <div class="grid-cell">
                        <div class="field-label">Data de Nascimento</div>
                        <div class="field-value">{{ $candidatura->data_nascimento?->format('d/m/Y') ?? '—' }}</div>
                    </div>
                </div>
                <div class="grid-row">
                    <div class="grid-cell">
                        <div class="field-label">Sexo</div>
                        <div class="field-value">{{ $candidatura->sexo ? ucfirst($candidatura->sexo) : '—' }}</div>
                    </div>
                    <div class="grid-cell">
                        <div class="field-label">Estado Civil</div>
                        <div class="field-value">{{ $candidatura->estado_civil ?? '—' }}</div>
                    </div>
                </div>
                <div class="grid-row">
                    <div class="grid-cell">
                        <div class="field-label">Telefone</div>
                        <div class="field-value">{{ $candidatura->telefone }}</div>
                    </div>
                    <div class="grid-cell">
                        <div class="field-label">E-mail</div>
                        <div class="field-value">{{ $candidatura->email }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Curso --}}
        <div class="curso-block">
            <div class="cb-left">
                <div class="cb-label">Curso Inscrito</div>
                <div class="cb-value">{{ $candidatura->curso }}</div>
            </div>
            <div class="cb-right">
                <div class="cb-label" style="margin-bottom:1.5mm;">Período</div>
                <div class="periodo-badge">{{ $periodoLabel }}</div>
            </div>
        </div>

        {{-- Dados Académicos --}}
        <div class="section">
            <div class="section-title">Dados Académicos</div>
            <div class="grid">
                <div class="grid-row">
                    <div class="grid-cell">
                        <div class="field-label">Escola de Proveniência</div>
                        <div class="field-value">{{ $candidatura->escola_origem ?? '—' }}</div>
                    </div>
                    <div class="grid-cell">
                        <div class="field-label">Ano de Conclusão</div>
                        <div class="field-value">{{ $candidatura->ano_conclusao ?? '—' }}</div>
                    </div>
                </div>
                <div class="grid-row">
                    <div class="grid-cell">
                        <div class="field-label">Habilitações Literárias</div>
                        <div class="field-value">{{ $candidatura->habilitacoes ?? '—' }}</div>
                    </div>
                    <div class="grid-cell">
                        <div class="field-label">Naturalidade</div>
                        <div class="field-value">{{ $candidatura->naturalidade_municipio ?? '—' }}{{ $candidatura->naturalidade_provincia ? ', ' . $candidatura->naturalidade_provincia : '' }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Aviso --}}
        <div class="aviso">
            <strong>Importante:</strong> Apresente este comprovativo (impresso ou em formato digital) no dia do exame de acesso.
            Guarde o número da sua ficha: <strong>{{ $fichaNum }}</strong>.
            Candidatura registada em {{ $candidatura->created_at->format('d/m/Y \à\s H:i') }}.
        </div>

        {{-- Rodapé --}}
        <div class="footer-bar">
            <div class="footer-date">
                Cuito, {{ $candidatura->created_at->format('d') }} de {{ $candidatura->created_at->translatedFormat('F') }} de {{ $candidatura->created_at->format('Y') }}
            </div>
            <div class="footer-sig">
                <div class="sig-line"></div>
                <div class="sig-name">Candidato(a)</div>
                <div class="sig-role">{{ strtoupper($candidatura->nome) }}</div>
            </div>
        </div>

    </div>{{-- /body-wrap --}}
</div>{{-- /page --}}
</body>
</html>
