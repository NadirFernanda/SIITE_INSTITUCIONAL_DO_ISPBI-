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
html, body { width:100%; height:100%; font-family: 'Times New Roman', serif; font-size:12pt; color:#000; position:relative; }

.pagina { position:relative; width:210mm; height:297mm; padding:15mm; overflow:hidden; }

.logo { width:28mm; height:auto; }

.instituto {
    margin-top:4mm;
    color:#1B4B9C;
    font-weight:bold;
    font-size:13pt;
    text-decoration:underline;
    display:inline-block;
}

.linha-dados { margin-top:6mm; font-weight:bold; font-size:12pt; }
.linha-dados .rotulo { white-space:nowrap; }
.linha-dados .traco { display:inline-block; border-bottom:1px solid #000; width:110mm; height:1px; margin-left:2px; }

.titulo-exame {
    text-align:center;
    font-weight:bold;
    font-size:19pt;
    margin-top:22mm;
}

/* Canto destacável: faixa diagonal com traço tracejado e campos de identificação,
   destinada a ser cortada e arquivada separadamente para garantir o anonimato na correcção. */
.canto-destacavel {
    position:absolute;
    top:1mm;
    right:-24mm;
    width:95mm;
    transform:rotate(-28deg);
    transform-origin:top right;
}
.canto-destacavel .campo {
    font-weight:bold;
    font-size:8.5pt;
    white-space:nowrap;
    padding-bottom:0.6mm;
}
.canto-destacavel .valor { font-weight:600; }
.canto-destacavel .linha-corte {
    border-bottom:1.5px dashed #000;
    margin-top:1.5mm;
    width:100%;
}

@media print { @page { margin:0; size:A4 portrait; } }
</style>
</head>
<body>

<div class="pagina">

    <div class="canto-destacavel">
        <div class="campo">N.º Ficha: <span class="valor">{{ str_pad($candidatura->id,5,'0',STR_PAD_LEFT) }}</span></div>
        <div class="campo">Nome: <span class="valor">{{ strtoupper($candidatura->nome) }}</span></div>
        <div class="campo">Curso: <span class="valor">{{ $candidatura->curso }}</span></div>
        <div class="campo">Ano Lectivo: <span class="valor">2026/2027</span></div>
        <div class="campo">N.º BI: <span class="valor">{{ $candidatura->bi }}</span></div>
        <div class="campo">Código de Exame: <span class="valor">{{ $candidatura->codigo_exame }}</span></div>
        <div class="linha-corte"></div>
    </div>

    @if($logoBase64)
        <img src="{{ $logoBase64 }}" alt="ISP-Bié" class="logo" />
    @endif

    <div><span class="instituto">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</span></div>

    <div class="linha-dados">
        <span class="rotulo">N.º BI</span><span class="traco"></span>
    </div>
    <div class="linha-dados">
        <span class="rotulo">CURSO</span><span class="traco" style="width:105mm;"></span>
    </div>

    <div class="titulo-exame">EXAME DE ACESSO 2026/2027</div>

</div>

</body>
</html>
