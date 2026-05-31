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
@page { size: A4 portrait; margin: 18mm 20mm; }
* { margin:0; padding:0; box-sizing:border-box; }
html, body { width:100%; font-family: DejaVu Sans, Arial, sans-serif; font-size:11pt; color:#000; }

.page-border {
    border: 0.5pt dotted #aaa;
    padding: 10mm;
}

/* Cabeçalho */
.header { text-align:center; margin-bottom:6mm; }
.header img { height:22mm; margin-bottom:3mm; }
.inst-name { font-size:14pt; font-weight:bold; color:#1a4e8a; letter-spacing:0.5px; }
.linha-dupla { border-top:3pt double #000; border-bottom:1pt solid #000; height:5px; margin:3mm 0; }
.header-sub  { font-size:10pt; font-weight:bold; margin-top:2mm; }
.header-exam { font-size:10pt; font-weight:bold; margin-top:1.5mm; }
.header-doc  { font-size:11pt; font-weight:bold; margin-top:1.5mm; }

/* Ficha nº — linha direita */
.ficha-row { display:table; width:100%; margin-top:3mm; margin-bottom:5mm; }
.ficha-left  { display:table-cell; width:60%; }
.ficha-right { display:table-cell; width:40%; text-align:right; vertical-align:bottom; font-size:13pt; font-weight:bold; }

/* Campos */
.campo { margin-bottom:5mm; font-weight:bold; font-size:11pt; }
.campo-linha {
    display:inline-block;
    width:80%;
    border-bottom:1pt solid #000;
    margin-left:2mm;
    vertical-align:bottom;
}

/* Checkboxes */
.chk-row { margin-bottom:5mm; font-weight:bold; font-size:11pt; }
.box {
    display:inline-block;
    width:4mm; height:4mm;
    border:1pt solid #000;
    vertical-align:middle;
    margin:0 2mm 0 3mm;
    background:#fff;
    text-align:center;
    line-height:4mm;
    font-size:8pt;
}
.box.on { background:#000; color:#fff; }

/* Linha curso + período */
.curso-row { margin-bottom:5mm; font-weight:bold; font-size:11pt; }
.curso-linha {
    display:inline-block;
    width:47%;
    border-bottom:1pt solid #000;
    margin-left:2mm;
    vertical-align:bottom;
}

/* Data */
.data-linha { font-size:11pt; margin-bottom:8mm; }
.data-u { display:inline-block; min-width:12mm; border-bottom:1pt solid #000; text-align:center; margin:0 1mm; vertical-align:bottom; }

/* Assinaturas */
.sigs { display:table; width:100%; margin-top:4mm; }
.sig  { display:table-cell; width:44%; text-align:center; }
.sig-line { border-bottom:1pt solid #000; height:9mm; margin-bottom:2mm; }
.sig-label { font-size:11pt; font-weight:bold; }
</style>
</head>
<body>
<div class="page-border">

    {{-- CABEÇALHO --}}
    <div class="header">
        @if($logoBase64)<img src="{{ $logoBase64 }}" alt="ISP-Bié"><br>@endif
        <div class="inst-name">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</div>
        <div class="linha-dupla"></div>
        <div class="header-sub">DEPARTAMENTO DOS ASSUNTOS ACADÉMICOS</div>
        <div class="header-exam">EXAME DE ACESSO 2025/2026</div>
        <div class="header-doc">FICHA DE INSCRIÇÃO</div>
    </div>

    {{-- FICHA Nº --}}
    <div class="ficha-row">
        <div class="ficha-left"></div>
        <div class="ficha-right">Ficha n.º <u>&nbsp;&nbsp;{{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}&nbsp;&nbsp;</u></div>
    </div>

    {{-- NOME --}}
    <div class="campo">
        Nome: <span class="campo-linha">{{ $candidatura->nome }}</span>
    </div>

    {{-- SEXO --}}
    <div class="chk-row">
        Sexo:
        <span class="box {{ $candidatura->sexo === 'masculino' ? 'on' : '' }}">{{ $candidatura->sexo === 'masculino' ? '✓' : '' }}</span> Masculino
        <span class="box {{ $candidatura->sexo === 'feminino' ? 'on' : '' }}">{{ $candidatura->sexo === 'feminino' ? '✓' : '' }}</span> Feminino
    </div>

    {{-- CURSO + PERÍODO --}}
    <div class="curso-row">
        Curso a se inscrever<span class="curso-linha">{{ $candidatura->curso }}</span>
        &nbsp;&nbsp;Período:
        <b>Regular</b><span class="box {{ $candidatura->periodo === 'regular' ? 'on' : '' }}">{{ $candidatura->periodo === 'regular' ? '✓' : '' }}</span>
        <b>Pós-laboral</b><span class="box {{ $candidatura->periodo === 'pos-laboral' ? 'on' : '' }}">{{ $candidatura->periodo === 'pos-laboral' ? '✓' : '' }}</span>
    </div>

    {{-- DATA --}}
    <div class="data-linha">
        Cuito, aos
        <span class="data-u">{{ $candidatura->created_at->format('d') }}</span>
        de
        <span class="data-u" style="min-width:28mm;">{{ $candidatura->created_at->translatedFormat('F') }}</span>
        de {{ $candidatura->created_at->format('Y') }}
    </div>

    {{-- ASSINATURAS --}}
    <div class="sigs">
        <div class="sig">
            <div class="sig-line"></div>
            <div class="sig-label">Conferiu</div>
        </div>
        <div style="display:table-cell;width:12%;"></div>
        <div class="sig">
            <div class="sig-line"></div>
            <div class="sig-label">Candidato (a)</div>
        </div>
    </div>

</div>
</body>
</html>
