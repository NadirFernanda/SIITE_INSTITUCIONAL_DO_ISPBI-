@php
    $logoPath   = public_path('images/logo.png');
    $logoBase64 = (file_exists($logoPath) && filesize($logoPath) > 0)
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
        : '';
@endphp
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<style>
@page { margin: 15mm; size: A4 portrait; }
* { margin:0; padding:0; box-sizing:border-box; }
html, body { width:100%; font-family: DejaVu Sans, Arial, sans-serif; font-size:10pt; color:#000; }

/* ── Cabeçalho (aparece só na 1.ª página por estar no fluxo normal) ── */
.header {
    text-align: center;
    margin-bottom: 5mm;
    padding-bottom: 3mm;
    border-bottom: 2pt solid #1a4e8a;
}
.header img { height: 20mm; margin-bottom: 2mm; }
.inst  { font-size:13pt; font-weight:bold; color:#1a4e8a; letter-spacing:0.5px; }
.dept  { font-size:9pt;  font-weight:bold; margin-top:1mm; }
.title { font-size:10pt; font-weight:bold; margin-top:1mm; }

.info-sala {
    margin-bottom: 4mm;
    font-size: 9.5pt;
}
.info-sala strong { font-weight: bold; }

/* ── Grupo por curso/período ── */
.grupo-header {
    background: #1a4e8a;
    color: #fff;
    font-weight: bold;
    font-size: 9.5pt;
    padding: 3px 8px;
    margin-top: 5mm;
    margin-bottom: 0;
}

/* ── Tabela ── */
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 9.5pt;
}
thead tr { background: #dce6f5; }
th {
    padding: 5px 8px;
    font-weight: bold;
    border: 0.5pt solid #aaa;
    text-align: left;
}
td {
    padding: 5px 8px;
    border: 0.5pt solid #ccc;
}
tr:nth-child(even) td { background: #f4f8ff; }
.num { width: 28pt; text-align: center; font-weight: bold; color: #1a4e8a; }
.nome { width: auto; }
.ass  { width: 75mm; }

/* ── Assinaturas no final ── */
.sigs {
    margin-top: 14mm;
    width: 100%;
}
.sigs table { border: none; }
.sigs td { border: none; padding: 0 8px; text-align: center; }
.sig-line { border-bottom: 0.5pt solid #000; height: 10mm; margin-bottom: 2mm; }
.sig-label { font-size: 8.5pt; font-weight: bold; }

.footer {
    margin-top: 8mm;
    text-align: center;
    font-size: 7.5pt;
    color: #888;
    border-top: 0.5pt solid #ddd;
    padding-top: 3mm;
}
</style>
</head>
<body>

{{-- ── CABEÇALHO (só na 1.ª página) ── --}}
<div class="header">
    @if($logoBase64)
        <img src="{{ $logoBase64 }}" alt="ISP-Bié"><br>
    @endif
    <div class="inst">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</div>
    <div class="dept">DEPARTAMENTO DOS ASSUNTOS ACADÉMICOS &nbsp;|&nbsp; EXAME DE ACESSO 2025/2026</div>
    <div class="title">LISTA DE EXAME</div>
</div>

{{-- ── INFO DA SALA ── --}}
<div class="info-sala">
    <strong>Sala:</strong> {{ $sala->nome }} &nbsp;&nbsp;
    <strong>Capacidade:</strong> {{ $sala->capacidade }} &nbsp;&nbsp;
    <strong>Candidatos:</strong> {{ $candidaturas->count() }}
</div>

{{-- ── TABELA POR GRUPO (curso + período) ── --}}
@if($candidaturas->isEmpty())
    <p style="color:#888;text-align:center;margin-top:10mm;">Nenhum candidato atribuído a esta sala.</p>
@else
    @foreach($candidaturas->groupBy(fn($c) => $c->curso . '|||' . $c->periodo) as $chave => $lista)
    @php [$curso, $periodo] = explode('|||', $chave); @endphp

    <div class="grupo-header">
        {{ $curso }} &mdash; {{ $periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular' }}
        &nbsp;({{ $lista->count() }} candidatos)
    </div>

    <table>
        <thead>
            <tr>
                <th class="num">N.º</th>
                <th class="nome">Nome Completo</th>
                <th class="ass">Assinatura</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lista->sortBy('numero_lugar') as $c)
            <tr>
                <td class="num">{{ $c->numero_lugar }}</td>
                <td class="nome">{{ $c->nome }}</td>
                <td class="ass">&nbsp;</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach

    {{-- ── ASSINATURAS ── --}}
    <div class="sigs">
        <table>
            <tr>
                <td style="width:45%;">
                    <div class="sig-line"></div>
                    <div class="sig-label">Responsável de Sala</div>
                </td>
                <td style="width:10%;"></td>
                <td style="width:45%;">
                    <div class="sig-line"></div>
                    <div class="sig-label">Chefe de Departamento</div>
                </td>
            </tr>
        </table>
    </div>
@endif

<div class="footer">
    Documento gerado em {{ now()->format('d/m/Y H:i') }} &nbsp;&mdash;&nbsp; ISP-Bié &nbsp;&mdash;&nbsp; Uso interno
</div>

</body>
</html>
