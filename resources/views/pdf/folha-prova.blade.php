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

/* Canto destacável: faixa diagonal entre uma linha contínua e uma tracejada, com os
   campos de identificação, destinada a ser cortada e arquivada separadamente para
   garantir o anonimato na correcção. Mantida sempre dentro da margem impressa. */
.canto-destacavel {
    position:absolute;
    top:2mm;
    right:-4mm;
    width:92mm;
    transform:rotate(-27deg);
    transform-origin:top right;
}
.canto-destacavel .linha-topo {
    border-top:1.3px solid #000;
    width:100%;
    margin-bottom:2.5mm;
}
.canto-destacavel .campo {
    font-weight:bold;
    font-size:10pt;
    line-height:1.5;
}
.canto-destacavel .campo .rotulo { white-space:nowrap; }
.canto-destacavel .valor { font-weight:600; word-wrap:break-word; overflow-wrap:break-word; }
.canto-destacavel .linha-corte {
    border-top:1.3px dashed #000;
    width:100%;
    margin-top:2.5mm;
}

@media print { @page { margin:0; size:A4 portrait; } }
</style>
</head>
<body>

<div class="pagina">

    <div class="canto-destacavel">
        <div class="linha-topo"></div>
        <div class="campo"><span class="rotulo">Código de Exame:</span> <span class="valor">{{ $candidatura->codigo_exame }}</span></div>
        <div class="campo"><span class="rotulo">N.º Ficha:</span> <span class="valor">{{ str_pad($candidatura->id,5,'0',STR_PAD_LEFT) }}</span></div>
        <div class="campo"><span class="rotulo">N.º BI:</span> <span class="valor">{{ $candidatura->bi }}</span></div>
        <div class="campo"><span class="rotulo">Ano Lectivo:</span> <span class="valor">2026/2027</span></div>
        <div class="campo"><span class="rotulo">Curso:</span> <span class="valor">{{ $candidatura->curso }}</span></div>
        <div class="campo"><span class="rotulo">Nome:</span> <span class="valor">{{ strtoupper($candidatura->nome) }}</span></div>
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
