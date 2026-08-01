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

.pagina { position:relative; width:210mm; height:297mm; padding:18mm 16mm; }

.logo { width:24mm; height:auto; display:block; }

.instituto {
    display:block;
    margin-top:3mm;
    color:#1B4B9C;
    font-weight:bold;
    font-size:14pt;
    letter-spacing:0.02em;
}

.divisor { border-top:1.3pt solid #1B4B9C; margin-top:8mm; width:105mm; }

/* Campos de identificação em tabela: garante que os dois traços em branco começam
   exactamente na mesma posição, em vez de larguras improvisadas por campo. */
.campos-id { width:105mm; border-collapse:collapse; margin-top:9mm; }
.campos-id td { font-weight:bold; font-size:12pt; padding-bottom:9mm; vertical-align:bottom; }
.campos-id .campo-rotulo { width:24mm; white-space:nowrap; }
.campos-id .campo-linha { border-bottom:1px solid #000; }

.titulo-exame {
    text-align:center;
    font-weight:bold;
    font-size:20pt;
    letter-spacing:0.04em;
    margin-top:30mm;
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
    <span class="instituto">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</span>
    <div class="divisor"></div>

    <table class="campos-id">
        <tr>
            <td class="campo-rotulo">N.º BI</td>
            <td class="campo-linha"></td>
        </tr>
        <tr>
            <td class="campo-rotulo">Curso</td>
            <td class="campo-linha"></td>
        </tr>
    </table>

    <div class="titulo-exame">EXAME DE ACESSO 2026/2027</div>

</div>

</body>
</html>
