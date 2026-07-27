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
@page { size: A4 portrait; margin: 0; }
* { margin:0; padding:0; box-sizing:border-box; }
html, body { width:100%; font-family: 'Times New Roman', serif; font-size:12pt; color:#000; }
.header { padding:20mm 15mm 8mm 15mm; }
.header .title { text-align:center; font-size:20pt; font-weight:bold; letter-spacing:0.06em; }
.header .subtitle { text-align:center; font-size:12pt; font-weight:bold; margin-top:6px; }
.header .left { float:left; width:120px; }
.header .right { float:right; width:160px; text-align:right; }
.tear-off { position:absolute; right:-20mm; top:18mm; transform:rotate(-32deg); transform-origin:top right; }

@media print { @page { margin:0; size:A4 portrait; } }
</style>
</head>
<body>

<div class="header">
    <div class="left">
        @if($logoBase64)
            <img src="{{ $logoBase64 }}" alt="ISP-Bié" style="width:110px;height:auto;" />
        @endif
    </div>
    <div class="title">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</div>
    <div class="subtitle">EXAME DE ACESSO 2026/2027</div>

    <div style="clear:both;margin-top:18mm;">
        <div style="float:left;font-weight:bold;">N.º BI ____________________________</div>
        <div style="margin-left:200px;font-weight:bold;">CURSO ____________________________</div>
        <div style="float:right;text-align:right;font-weight:bold;">N.º Ficha: {{ str_pad($candidatura->id,5,'0',STR_PAD_LEFT) }}<br/>Código de Exame: _______</div>
    </div>
</div>

<div class="tear-off">
    <div style="border-right:2px dashed #000;padding-right:8px;">
        <div style="font-weight:bold;">N.º BI: <span style="font-weight:600;">{{ $candidatura->bi }}</span></div>
        <div style="font-weight:bold;">Ano Lectivo: <span style="font-weight:600;">2026/2027</span></div>
        <div style="font-weight:bold;">Curso: <span style="font-weight:600;">{{ $candidatura->curso }}</span></div>
        <div style="font-weight:bold;">Nome: <span style="font-weight:600;">{{ strtoupper($candidatura->nome) }}</span></div>
        <div style="font-weight:bold;margin-top:6px;">Código de Exame: <span style="font-weight:600;">&nbsp;</span></div>
    </div>
</div>

</body>
</html>
