@php
    $logoPath   = public_path('images/logo.png');
    $logoBase64 = (file_exists($logoPath) && filesize($logoPath) > 0)
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
        : '';
    $periodoLabel = $candidatura->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular';
@endphp
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<style>
@page { size: A4 portrait; margin: 0; }
* { margin:0; padding:0; box-sizing:border-box; }
html, body { width:100%; font-family: 'Segoe UI', Arial, sans-serif; font-size:11pt; color:#1a1a2e; line-height:1.4; }

/* ════════════════════════════════════════════════════════════ */
/*                    CABEÇALHO INSTITUCIONAL                   */
/* ════════════════════════════════════════════════════════════ */
.header {
    background: linear-gradient(135deg, #1565c0 0%, #1e40af 100%);
    color: #fff;
    padding: 10mm 15mm;
    display: table;
    width: 100%;
    border-bottom: 4pt solid #fbbf24;
}
.h-logo  { display:table-cell; width:20mm; vertical-align:middle; }
.h-logo img { width:16mm; height:auto; }
.h-center { display:table-cell; vertical-align:middle; padding-left:6mm; }
.h-inst  { font-size:13.5pt; font-weight:bold; letter-spacing:0.3px; }
.h-sub   { font-size:9pt; color:#e0e7ff; margin-top:2mm; }
.h-right { display:table-cell; width:32mm; text-align:right; vertical-align:middle; }
.h-code  { font-size:8pt; background:rgba(255,255,255,0.2); padding:2px 8px; border-radius:4px; margin-bottom:2mm; }
.h-seat  { font-size:16pt; font-weight:bold; line-height:1.1; }

/* ════════════════════════════════════════════════════════════ */
/*                    CANTO RASGÁVEL (TEAR-OFF)                 */
/* ════════════════════════════════════════════════════════════ */
.tear-off-container {
    position: absolute;
    top: 20mm;
    right: -8mm; /* deslocar para compensar a rotação */
    width: 62mm; /* largura alongada para o corte diagonal */
    height: 36mm;
    border: 2pt dashed #e5e7eb;
    background: #f9fafb;
    padding: 4mm 6mm;
    box-shadow: inset 0 0 0 1pt #cbd5e1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    font-family: 'Courier New', monospace;
    transform: rotate(-18deg);
    transform-origin: top right;
}

/* manter o rótulo legível — rodar de volta */
.tear-off-container::before {
    content: '✂ DESTAQUE';
    position: absolute;
    top: -7pt;
    right: 14mm;
    font-size: 8pt;
    font-weight: bold;
    color: #ef4444;
    background: #fff;
    padding: 0 4px;
    letter-spacing: 0.1em;
    transform: rotate(18deg);
}

.tear-off-label {
    font-size: 8pt;
    font-weight: bold;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin-bottom: 2mm;
}

.tear-off-name-label {
    font-size: 8pt;
    color: #94a3b8;
    font-weight: bold;
}
.tear-off-name-value {
    font-size: 9pt;
    font-weight: bold;
    color: #1f2937;
    border-bottom: 1.5pt solid #1f2937;
    padding-bottom: 2mm;
    margin-bottom: 4mm;
    min-height: 8mm;
    display: flex;
    align-items: flex-end;
    justify-content: center;
}

.tear-off-code-label {
    font-size: 7.5pt;
    color: #94a3b8;
    font-weight: bold;
    margin-bottom: 2mm;
}
.tear-off-code-value {
    font-size: 13pt;
    font-weight: bold;
    color: #1565c0;
    letter-spacing: 0.12em;
    border: 2pt solid #1565c0;
    padding: 3mm 5mm;
    border-radius: 4px;
    background: #f0f6ff;
    min-width: 26mm;
    text-align: center;
}

/* ════════════════════════════════════════════════════════════ */
/*                       CONTEÚDO PRINCIPAL                     */
/* ════════════════════════════════════════════════════════════ */
.main-content {
    padding: 15mm 15mm 15mm 15mm;
    margin-right: 45mm; /* espaço para o canto rasgável */
    position: relative;
}

/* Título do documento */
.doc-title {
    background: linear-gradient(90deg, #f9fafb 0%, #f3f4f6 100%);
    border-left: 5pt solid #1565c0;
    border-radius: 0 4px 4px 0;
    padding: 6mm 8mm;
    margin-bottom: 6mm;
    font-size: 13pt;
    font-weight: bold;
    color: #1a1a2e;
    letter-spacing: 0.02em;
    text-align: center;
    text-transform: uppercase;
}

/* BLOCO DADOS DO CANDIDATO */
.candidate-block {
    background: linear-gradient(180deg, #f0f6ff 0%, #f9fafb 100%);
    border: 1.5pt solid #93c5fd;
    border-radius: 6px;
    padding: 6mm 8mm;
    margin-bottom: 6mm;
}

.candidate-field {
    display: table;
    width: 100%;
    margin-bottom: 4mm;
}
.candidate-field:last-child { margin-bottom: 0; }

.candidate-label {
    display: table-cell;
    width: 30mm;
    font-size: 8.5pt;
    font-weight: bold;
    color: #1565c0;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    vertical-align: middle;
}

.candidate-value {
    display: table-cell;
    font-size: 10pt;
    font-weight: bold;
    color: #1f2937;
    padding-left: 4mm;
}

/* BLOCO CURSO E INSCRIÇÃO */
.course-block {
    display: table;
    width: 100%;
    margin-bottom: 6mm;
    gap: 8mm;
}

.course-item {
    display: table-cell;
    width: 48%;
    background: #fff;
    border: 1pt solid #e5e7eb;
    border-radius: 4px;
    padding: 5mm;
}

.course-label {
    font-size: 8pt;
    font-weight: bold;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    margin-bottom: 2mm;
}

.course-value {
    font-size: 10.5pt;
    font-weight: bold;
    color: #1565c0;
}

.period-badge {
    display: inline-block;
    background: #fbbf24;
    color: #92400e;
    font-size: 8pt;
    font-weight: bold;
    padding: 3px 8px;
    border-radius: 12px;
    margin-top: 2mm;
}

/* BLOCO INSTRUÇÕES */
.instructions-block {
    background: #fef3c7;
    border: 1pt solid #fcd34d;
    border-left: 4pt solid #f59e0b;
    border-radius: 0 4px 4px 0;
    padding: 5mm 7mm;
    margin-bottom: 6mm;
    font-size: 9pt;
    line-height: 1.5;
}

.instructions-title {
    font-weight: bold;
    color: #92400e;
    text-transform: uppercase;
    font-size: 8pt;
    letter-spacing: 0.05em;
    margin-bottom: 2mm;
}

/* TABELA DE INFORMAÇÕES */
.info-grid {
    display: table;
    width: 100%;
    margin-bottom: 6mm;
}

.info-row { display: table-row; }

.info-cell {
    display: table-cell;
    padding: 4mm;
    border: 0.5pt solid #e5e7eb;
    background: #fff;
    font-size: 9pt;
}

.info-cell-header {
    background: #f3f4f6;
    font-weight: bold;
    color: #4b5563;
    text-transform: uppercase;
    font-size: 8pt;
    letter-spacing: 0.05em;
}

/* RODAPÉ */
.footer {
    margin-top: 8mm;
    padding-top: 5mm;
    border-top: 1pt solid #e5e7eb;
    text-align: center;
    font-size: 8pt;
    color: #9ca3af;
}

.footer-text {
    margin-bottom: 2mm;
}

.security-code {
    font-family: monospace;
    font-weight: bold;
    color: #1565c0;
    margin-top: 2mm;
}

/* ASSINATURA */
.signature-block {
    display: table;
    width: 100%;
    margin-top: 6mm;
}

.sig-cell {
    display: table-cell;
    text-align: center;
    width: 48%;
}

.sig-line {
    border-bottom: 1pt solid #333;
    height: 8mm;
    margin-bottom: 2mm;
}

.sig-label {
    font-size: 9pt;
    font-weight: bold;
    color: #1a1a2e;
}

.sig-sublabel {
    font-size: 8pt;
    color: #6b7280;
    margin-top: 1mm;
}

/* PADRÃO DE SEGURANÇA */
.security-pattern {
    position: absolute;
    top: 0;
    right: 0;
    width: 8mm;
    height: 100%;
    background: repeating-linear-gradient(
        45deg,
        #1565c0,
        #1565c0 2px,
        transparent 2px,
        transparent 4px
    );
    opacity: 0.05;
}

/* ════════════════════════════════════════════════════════════ */
/*                       ESTILO IMPRESSÃO                       */
/* ════════════════════════════════════════════════════════════ */
@media print {
    @page { margin: 0; size: A4 portrait; }
    body { background: #fff !important; }
    .tear-off-container { border: 2pt dashed #ccc !important; }
    * { -webkit-print-color-adjust: exact !important; color-adjust: exact !important; }
}

</style>
</head>
<body style="position: relative;">

{{-- SEGURANÇA --}}
<div class="security-pattern"></div>

{{-- CABEÇALHO --}}
<div class="header" style="padding:14mm 15mm 8mm 15mm; background:transparent; border-bottom:0;">
    <div style="display:flex;align-items:center;gap:12px;">
        <div style="width:120px;">
            @if($logoBase64)
                <img src="{{ $logoBase64 }}" alt="ISP-Bié" style="width:100%;height:auto;" />
            @endif
        </div>
        <div style="flex:1;text-align:center;">
            <div style="font-size:18pt;font-weight:800;letter-spacing:0.06em;text-transform:uppercase;color:#0b2a66;padding-bottom:6px;border-bottom:2px solid #0b2a66;display:inline-block;">
                INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ
            </div>
            <div style="margin-top:8px;font-size:12pt;color:#0b2a66;font-weight:700;">EXAME DE ACESSO 2026/2027</div>
        </div>
        <div style="width:140px;text-align:left;">
            <div style="font-size:10pt;font-weight:700;color:#111;margin-bottom:8px;">N.º Ficha: {{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}</div>
            <div style="font-size:9pt;color:#111;font-weight:700;">Código de Exame: <span style="display:inline-block;width:54px;border-bottom:1px solid #111;margin-left:6px;">&nbsp;</span></div>
        </div>
    </div>

    <div style="margin-top:12px;padding-left:6px;">
        <div style="font-size:11pt;margin-bottom:8px;"><strong>N.º BI</strong> ________________________________</div>
        <div style="font-size:11pt;margin-bottom:8px;"><strong>CURSO</strong> ________________________________</div>
    </div>
</div>

{{-- CANTO RASGÁVEL (TEAR-OFF) --}}
<div style="position:absolute;right:-20mm;top:18mm;width:90mm;transform:rotate(-32deg);transform-origin:top right;">
    <div style="border-right:2px dashed #000;padding-right:8px;">
        <div style="font-size:10pt;font-weight:700;margin-bottom:6px;">N.º BI: <span style="float:right;font-weight:600;">{{ $candidatura->bi }}</span></div>
        <div style="font-size:10pt;font-weight:700;margin-bottom:6px;">Ano Lectivo: <span style="float:right;font-weight:600;">2026/2027</span></div>
        <div style="font-size:10pt;font-weight:700;margin-bottom:6px;">Curso: <span style="float:right;font-weight:600;">{{ $candidatura->curso }}</span></div>
        <div style="font-size:10pt;font-weight:700;margin-bottom:6px;">Nome: <span style="float:right;font-weight:600;">{{ strtoupper($candidatura->nome) }}</span></div>
        <div style="font-size:10pt;font-weight:700;margin-top:6px;">Código de Exame: <span style="float:right;font-weight:600;">&nbsp;</span></div>
    </div>
</div>

{{-- CONTEÚDO PRINCIPAL --}}
<div class="main-content">

    {{-- TÍTULO --}}
    <div class="doc-title">📋 Folha de Prova — Exame de Acesso</div>

    {{-- BLOCO DADOS DO CANDIDATO --}}
    <div class="candidate-block">
        <div class="candidate-field">
            <div class="candidate-label">Nome:</div>
            <div class="candidate-value">{{ strtoupper($candidatura->nome) }}</div>
        </div>
        <div class="candidate-field">
            <div class="candidate-label">Bilhete:</div>
            <div class="candidate-value">{{ $candidatura->bi }}</div>
        </div>
        <div class="candidate-field">
            <div class="candidate-label">Sexo:</div>
            <div class="candidate-value">{{ $candidatura->sexo ? ucfirst($candidatura->sexo) : '—' }}</div>
        </div>
    </div>

    {{-- CURSO E PERÍODO --}}
    <div class="course-block">
        <div class="course-item">
            <div class="course-label">Curso Inscrito</div>
            <div class="course-value">{{ $candidatura->curso }}</div>
        </div>
        <div class="course-item">
            <div class="course-label">Período</div>
            <div class="course-value">
                <div class="period-badge">{{ $periodoLabel }}</div>
            </div>
        </div>
    </div>

    {{-- INSTRUÇÕES --}}
    <div class="instructions-block">
        <div class="instructions-title">⚠ Instruções Importantes</div>
        <div>
            • <strong>Leia com atenção todas as perguntas</strong> antes de responder.<br>
            • <strong>Use apenas caneta azul ou preta</strong> para responder.<br>
            • <strong>Não é permitida</strong> a consulta de material externo durante o exame.<br>
            • <strong>Responda com clareza</strong> e legibilidade.<br>
            • <strong>Duração do exame:</strong> 120 minutos.
        </div>
    </div>

    {{-- INFORMAÇÕES --}}
    <table class="info-grid">
        <tr class="info-row">
            <td class="info-cell info-cell-header" style="width: 25%;">Local de Exame</td>
            <td class="info-cell" style="width: 25%;">{{ $candidatura->sala?->nome ?? '—' }}</td>
            <td class="info-cell info-cell-header" style="width: 25%;">Lugar</td>
            <td class="info-cell" style="width: 25%;">{{ $candidatura->numero_lugar ?? '—' }}</td>
        </tr>
        <tr class="info-row">
            <td class="info-cell info-cell-header">Data do Exame</td>
            <td class="info-cell">{{ $candidatura->sala?->data_exame?->format('d/m/Y') ?? '—' }}</td>
            <td class="info-cell info-cell-header">Horário</td>
            <td class="info-cell">{{ $candidatura->sala?->horario ?? '—' }}</td>
        </tr>
        <tr class="info-row">
            <td class="info-cell info-cell-header">Perfil de Acesso</td>
            <td class="info-cell" colspan="3">{{ $candidatura->perfil ?? '—' }}</td>
        </tr>
    </table>

    {{-- ESPAÇO PARA RESPOSTAS --}}
    <div style="background: #f9fafb; border: 1.5pt solid #e5e7eb; border-radius: 4px; padding: 10mm; margin: 8mm 0; min-height: 100mm;">
        <div style="text-align: center; color: #9ca3af; font-style: italic; margin-bottom: 8mm;">
            [Espaço para respostas/exercícios]
        </div>
    </div>

    {{-- ASSINATURAS --}}
    <div class="signature-block">
        <div class="sig-cell">
            <div class="sig-line"></div>
            <div class="sig-label">Vigilante do Exame</div>
            <div class="sig-sublabel">ISP-Bié</div>
        </div>
        <div style="display: table-cell; width: 4%;"></div>
        <div class="sig-cell">
            <div class="sig-line"></div>
            <div class="sig-label">Candidato(a)</div>
            <div class="sig-sublabel">{{ strtoupper($candidatura->nome) }}</div>
        </div>
    </div>

    {{-- RODAPÉ --}}
    <div class="footer">
        <div class="footer-text">
            <strong>Instituto Superior Politécnico do Bié</strong> — Departamento de Assuntos Académicos
        </div>
        <div class="footer-text">
            Documento impresso em {{ now()->format('d/m/Y \à\s H:i') }} — Ficha: {{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}
        </div>
        <div class="security-code">
            SG-{{ date('Y') }}-{{ str_pad($candidatura->id, 6, '0', STR_PAD_LEFT) }}
        </div>
    </div>

</div>

</body>
</html>
