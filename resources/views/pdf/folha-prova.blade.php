@php
    $logoPath   = public_path('images/logo.png');
    $logoBase64 = (file_exists($logoPath) && filesize($logoPath) > 0)
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
        : '';

    // Quebra manual do texto da faixa diagonal em linhas curtas: o wrap automático do
    // CSS não é fiável dentro de blocos com transform:rotate() no dompdf, por isso
    // forçamos aqui a largura máxima por linha para garantir que nada ultrapassa a página.
    $faixaLinha = function (string $label, $valor) {
        $texto     = trim($label . ' ' . $valor);
        $quebrado  = wordwrap($texto, 30, "\n", true);
        return nl2br(e($quebrado));
    };
@endphp
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<style>
@page { size: A4 portrait; margin: 0; }
* { margin:0; padding:0; box-sizing:border-box; }
html, body { width:100%; height:100%; font-family: 'Times New Roman', serif; font-size:12pt; color:#000; position:relative; }

.pagina { position:relative; width:210mm; height:297mm; padding:15mm; }

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
    margin-top:32mm;
}

/* Canto destacável: faixa diagonal entre uma linha contínua e uma tracejada, com os
   campos de identificação, destinada a ser cortada e arquivada separadamente para
   garantir o anonimato na correcção. Geometria calculada a partir da matriz de rotação
   (usando "left", não "right" — o dompdf posiciona mal blocos rodados ancorados por
   "right") para nunca ultrapassar a página nem colidir com o cabeçalho ou o título,
   mesmo no pior caso de nomes/cursos longos que quebram em várias linhas. */
.canto-destacavel {
    position:absolute;
    top:-2mm;
    left:119mm;
    width:60mm;
    transform:rotate(-12deg);
    transform-origin:top right;
}
.canto-destacavel .linha-topo {
    border-top:1.3px solid #000;
    width:100%;
    margin-bottom:2mm;
}
.canto-destacavel .campo {
    font-weight:bold;
    font-size:9pt;
    line-height:1.4;
    margin-bottom:0.6mm;
}
.canto-destacavel .linha-corte {
    border-top:1.3px dashed #000;
    width:100%;
    margin-top:2mm;
}

@media print { @page { margin:0; size:A4 portrait; } }
</style>
</head>
<body>

<div class="pagina">

    <div class="canto-destacavel">
        <div class="linha-topo"></div>
        <div class="campo">{!! $faixaLinha('Código de Exame:', $candidatura->codigo_exame) !!}</div>
        <div class="campo">{!! $faixaLinha('N.º Ficha:', str_pad($candidatura->id,5,'0',STR_PAD_LEFT)) !!}</div>
        <div class="campo">{!! $faixaLinha('N.º BI:', $candidatura->bi) !!}</div>
        <div class="campo">{!! $faixaLinha('Ano Lectivo:', '2026/2027') !!}</div>
        <div class="campo">{!! $faixaLinha('Curso:', $candidatura->curso) !!}</div>
        <div class="campo">{!! $faixaLinha('Nome:', strtoupper($candidatura->nome)) !!}</div>
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
