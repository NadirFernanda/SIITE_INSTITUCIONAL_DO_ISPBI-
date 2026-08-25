@php
    $logoPath   = public_path('images/logo.png');
    $logoBase64 = (file_exists($logoPath) && filesize($logoPath) > 0)
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
        : '';

    // Quebra manual do texto da faixa diagonal em linhas curtas: o wrap automático do
    // CSS não é fiável dentro de blocos com transform:rotate() no dompdf, por isso
    // forçamos aqui a largura máxima por linha para garantir que nada ultrapassa a página.
    //
    // O bloco de identificação tem de ficar sempre à mesma distância da linha de
    // corte, seja qual for o número de linhas (nomes/cursos compridos quebram para
    // 2 linhas) — uma margem fixa não serve porque cada linha extra "come" o espaço
    // reservado. Por isso contamos aqui quantas linhas o texto vai realmente ocupar
    // e calculamos o deslocamento (top negativo) proporcional a esse total, em vez
    // de adivinhar um valor fixo.
    $totalLinhasDiagonal = 0;
    $faixaLinha = function (string $label, $valor) use (&$totalLinhasDiagonal) {
        $texto     = trim($label . ' ' . $valor);
        $quebrado  = wordwrap($texto, 30, "\n", true);
        $totalLinhasDiagonal += substr_count($quebrado, "\n") + 1;
        return nl2br(e($quebrado));
    };

    // Pré-computar as 5 linhas primeiro (para contar o total antes de definir o
    // "top"), depois montar o offset em mm: altura por linha (~4.15mm, a 8.5pt
    // com entrelinha 1.25 + margem) × nº de linhas, mais 3mm de folga até à linha.
    $camposCanto = [
        $faixaLinha('Código de Exame:', $candidatura->codigo_exame),
        $faixaLinha('N.º BI:', $candidatura->bi),
        $faixaLinha('Ano Lectivo:', '2026/2027'),
        $faixaLinha('Curso:', $candidatura->curso),
        $faixaLinha('Nome:', mb_strtoupper($candidatura->nome, 'UTF-8')),
    ];
    $offsetCanto = -1 * round(($totalLinhasDiagonal * 4.15) + 3, 1);
@endphp
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<style>
@page { size: A4 portrait; margin: 0; }
* { margin:0; padding:0; box-sizing:border-box; }
html, body { width:100%; height:100%; font-family: Helvetica, Arial, sans-serif; font-size:11pt; color:#000; position:relative; }

.pagina { position:relative; width:210mm; padding:16mm 16mm 10mm; }

/* Logótipo e nome do instituto alinhados à esquerda (canto superior esquerdo
   da folha), conforme o modelo oficial — antes ficavam centrados dentro do
   bloco, o que não corresponde ao layout de referência. */
.cabecalho-instituto { width:105mm; text-align:left; }
.logo { width:24mm; height:auto; display:block; }

.instituto {
    display:block;
    margin-top:3mm;
    color:#1B4B9C;
    font-weight:bold;
    font-size:12.5pt;
    letter-spacing:0.01em;
}

.divisor { border-top:0.8px solid #1B4B9C; margin-top:3mm; width:105mm; }

/* Campos de identificação: rótulo e traço na MESMA linha (inline-block lado a
   lado), em vez de tabela com padding-bottom — essa abordagem colocava o traço
   por baixo do rótulo em vez de ao lado, por causa de como o dompdf resolve
   vertical-align em células vazias. Largura fixa no rótulo garante que todos
   os traços começam alinhados na mesma posição vertical. */
/* N.º BI e Curso alinhados à esquerda, por baixo do nome do instituto —
   mesmo layout do modelo oficial de referência. */
.linha-campo { width:105mm; text-align:left; margin-top:3mm; font-weight:bold; font-size:12pt; }
.linha-campo .rotulo { display:inline-block; width:22mm; text-align:left; white-space:nowrap; vertical-align:top; }
/* max-width impede que um curso com nome longo ultrapasse a largura da
   página — quebra para a linha seguinte em vez de sair do bloco de 105mm. */
.linha-campo .traco { display:inline-block; max-width:83mm; border-bottom:1px solid #000; padding-bottom:1mm; word-wrap:break-word; vertical-align:top; }
/* Campos já preenchidos automaticamente (N.º BI, Curso) não levam traço por
   baixo — o traço só faz sentido em linhas em branco para preencher à mão. */
.linha-campo .traco.preenchido { border-bottom:none; font-weight:600; }

/* Código de exame: texto simples e destacado, sem caixa pesada — só um traço
   fino por baixo, mais discreto do que uma borda grossa à volta. Alinhado à
   esquerda, na mesma margem do nome do instituto e do curso. */
.linha-codigo {
    width:105mm;
    text-align:left;
    margin-top:5mm;
    font-weight:bold;
    font-size:12pt;
    letter-spacing:0.03em;
}
.linha-codigo span { border-bottom:0.8px solid #000; padding-bottom:1.5mm; }

/* Título também alinhado à esquerda, na mesma margem do resto do cabeçalho
   (instituto, curso, código de exame) — a linha por baixo continua a
   estender-se de ponta a ponta da página. */
.titulo-exame-linha {
    margin-top:15mm;
    padding-bottom:2mm;
    border-bottom:0.8px solid #000;
}
.titulo-exame {
    width:100%;
    text-align:left;
    font-weight:bold;
    font-size:16pt;
    letter-spacing:0.02em;
}

.pagina-branca { page-break-before:always; position:relative; width:210mm; padding:16mm 16mm 10mm; }

/* Rodapé em fluxo normal (não position:absolute) — no dompdf, um bloco fixo ao
   fundo de uma página com altura explícita causa páginas fantasma quando o
   conteúdo acima é recalculado; em fluxo normal aparece sempre logo a seguir
   à pauta de respostas, de forma previsível numa única página A4. */
.rodape {
    margin-top:60mm;
    font-size:10pt;
}
.rodape table { width:100%; border-collapse:collapse; }

/* Canto destacável: recorta o canto superior direito da folha, para ser
   rasgado e arquivado à parte, garantindo o anonimato na correcção (quem
   corrige só vê o código de exame, nunca o nome). Para isto funcionar como
   um rasgão real:
   1) tem de haver uma LINHA DE CORTE desenhada que atravesse a folha de uma
      margem à outra (do topo até à direita — única orientação geometricamente
      possível para recortar o canto superior direito, desce da esquerda para
      a direita);
   2) TODO o texto de identificação tem de ficar geometricamente do lado do
      canto (o pedaço que se destaca), nunca do lado do conteúdo principal;
   3) a linha e o texto têm de ficar bem afastados do resto do cabeçalho
      (nome do instituto, título), para não os atravessar.

   A linha (.linha-de-corte) fica ancorada exactamente na origem do
   contentor rodado — por isso o seu comprimento é previsível e chega
   sempre à margem direita, independentemente do texto. O texto
   (.canto-destacavel) é posicionado à parte, deslocado para cima dessa
   mesma origem (top negativo fixo), para nunca empurrar nem tocar a linha,
   sejam quantas linhas de texto forem. Ambos rodam em conjunto porque são
   filhos do mesmo contentor — por isso ficam sempre no ângulo certo um em
   relação ao outro. Geometria e posição confirmadas visualmente por vários
   renders de teste (nome/curso longos incluídos). */
.canto-corte {
    position:absolute;
    top:38mm;
    left:150mm;
    width:170mm;
    transform:rotate(35deg);
    transform-origin:top left;
}
.canto-corte .linha-de-corte {
    border-top:1px dashed #444;
    width:100%;
}
/* O "top" (negativo) é calculado em PHP, proporcional ao número real de
   linhas do texto (ver $offsetCanto) — dompdf não posiciona de forma
   fiável um bloco position:absolute por "bottom" quando o contentor não
   tem altura definida (testado: o bloco saltava para o fundo da página),
   por isso a distância certa até à linha de corte tem de vir por "top"
   calculado antecipadamente, não por margem fixa nem por "bottom". */
.canto-destacavel {
    position:absolute;
    left:0;
    width:100%;
    font-family: Helvetica, Arial, sans-serif;
}
.canto-destacavel .campo {
    text-align:left;
    font-family: Helvetica, Arial, sans-serif;
    font-weight:bold;
    font-size:8.5pt;
    line-height:1.25;
    margin-bottom:0.4mm;
}

@media print { @page { margin:0; size:A4 portrait; } }
</style>
</head>
<body>

<div class="pagina">

    <div class="canto-corte">
        <div class="canto-destacavel" style="top:{{ $offsetCanto }}mm;">
            @foreach($camposCanto as $linhaCampo)
                <div class="campo">{!! $linhaCampo !!}</div>
            @endforeach
        </div>
        <div class="linha-de-corte"></div>
    </div>

    <div class="cabecalho-instituto">
        @if($logoBase64)
            <img src="{{ $logoBase64 }}" alt="ISP-Bié" class="logo" />
        @endif
        <span class="instituto">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</span>
    </div>
    <div class="divisor"></div>

    <div class="linha-campo">
        <span class="rotulo">CURSO</span><span class="traco preenchido">{{ $candidatura->curso }}</span>
    </div>

    <div class="linha-codigo">Código de Exame: <span>{{ $candidatura->codigo_exame ?: '' }}</span></div>

    <div class="titulo-exame-linha">
        <div class="titulo-exame">EXAME DE ACESSO 2026/2027</div>
    </div>

    <div class="rodape">
        <table>
            <tr>
                <td style="text-align:right;">Pág. 1 de 2</td>
            </tr>
        </table>
    </div>

</div>

<div class="pagina-branca">
    <div class="rodape" style="margin-top:260mm;">
        <table>
            <tr>
                <td style="text-align:right;">Pág. 2 de 2</td>
            </tr>
        </table>
    </div>
</div>

</body>
</html>
