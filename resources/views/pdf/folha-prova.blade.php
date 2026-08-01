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
html, body { width:100%; height:100%; font-family: Helvetica, Arial, sans-serif; font-size:11pt; color:#000; position:relative; }

.pagina { position:relative; width:210mm; padding:16mm 16mm 10mm; }

/* Logótipo e nome do instituto centrados dentro da mesma largura da linha
   divisória (105mm), em vez de alinhados à esquerda. */
.cabecalho-instituto { width:105mm; text-align:center; }
.logo { width:24mm; height:auto; margin:0 auto; display:block; }

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
/* N.º BI, Curso e Código de Exame centrados na mesma largura (105mm) e
   posição do logótipo/título do instituto, para ficarem consistentes. */
.linha-campo { width:105mm; text-align:center; margin-top:3mm; font-weight:bold; font-size:12pt; }
.linha-campo .rotulo { display:inline-block; width:22mm; text-align:left; white-space:nowrap; }
.linha-campo .traco { display:inline-block; border-bottom:1px solid #000; padding-bottom:1mm; }
/* Campos já preenchidos automaticamente (N.º BI, Curso) não levam traço por
   baixo — o traço só faz sentido em linhas em branco para preencher à mão. */
.linha-campo .traco.preenchido { border-bottom:none; font-weight:600; }

/* Código de exame: texto simples e destacado, sem caixa pesada — só um traço
   fino por baixo, mais discreto do que uma borda grossa à volta. */
.linha-codigo {
    width:105mm;
    text-align:center;
    margin-top:5mm;
    font-weight:bold;
    font-size:12pt;
    letter-spacing:0.03em;
}
.linha-codigo span { border-bottom:0.8px solid #000; padding-bottom:1.5mm; }

/* O texto do título fica centrado no mesmo eixo (105mm) do resto do
   cabeçalho — a centrar na largura toda da página ficava desalinhado com o
   resto e parecia torto — mas a linha por baixo estende-se de ponta a
   ponta da página. */
.titulo-exame-linha {
    margin-top:15mm;
    padding-bottom:2mm;
    border-bottom:0.8px solid #000;
}
.titulo-exame {
    width:105mm;
    text-align:center;
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

/* Canto destacável: faixa diagonal com os campos de identificação do candidato,
   destinada a ser rasgada e arquivada em separado para garantir o anonimato na
   correcção (quem corrige só vê o código de exame, não o nome). Todo o texto é
   alinhado à esquerda dentro do bloco — cada linha começa no mesmo ponto e lê-se
   da esquerda para a direita — e o bloco inteiro é rodado em conjunto, mantendo
   todas as linhas paralelas na diagonal, tal como numa folha de prova real.
   Largura de 60mm é o máximo que cabe sem tocar no nome do instituto (que é o
   elemento mais largo do cabeçalho); geometria confirmada por render de teste.
   "top" afastado do canto real da página para deixar margem de papel entre a
   linha de corte e a borda — sem isso, a ponta fica rente ao canto e não dá
   para agarrar para rasgar. */
.canto-destacavel {
    position:absolute;
    top:18mm;
    left:137mm;
    width:58mm;
    font-family: Helvetica, Arial, sans-serif;
    transform:rotate(-12deg);
    transform-origin:top right;
}
.canto-destacavel .campo {
    text-align:left;
    font-family: Helvetica, Arial, sans-serif;
    font-weight:bold;
    font-size:9pt;
    line-height:1.3;
    margin-bottom:0.4mm;
}

@media print { @page { margin:0; size:A4 portrait; } }
</style>
</head>
<body>

<div class="pagina">

    <div class="canto-destacavel">
        <div class="campo">{!! $faixaLinha('Código de Exame:', $candidatura->codigo_exame) !!}</div>
        <div class="campo">{!! $faixaLinha('N.º BI:', $candidatura->bi) !!}</div>
        <div class="campo">{!! $faixaLinha('Ano Lectivo:', '2026/2027') !!}</div>
        <div class="campo">{!! $faixaLinha('Curso:', $candidatura->curso) !!}</div>
        <div class="campo">{!! $faixaLinha('Nome:', mb_strtoupper($candidatura->nome, 'UTF-8')) !!}</div>
    </div>

    <div class="cabecalho-instituto">
        @if($logoBase64)
            <img src="{{ $logoBase64 }}" alt="ISP-Bié" class="logo" />
        @endif
        <span class="instituto">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</span>
    </div>
    <div class="divisor"></div>

    <div class="linha-campo">
        <span class="rotulo">Curso:</span><span class="traco preenchido">{{ $candidatura->curso }}</span>
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
