{{--
    Conteúdo de uma sala/categoria para a Lista de Exame em PDF — mesma
    informação e ordenação do Excel Exame (App\Exports\SalaExameExport), só
    muda o formato do ficheiro: N.º Ficha, Nome Completo e Assinatura,
    ordenados alfabeticamente, com a mesma indicação de curso(s)/período.
    Ver pdf/_sala-conteudo.blade.php para a explicação da paginação manual.

    Espera: $sala, $candidaturas, $logoBase64, $primeiroDoDocumento (bool),
    $necessidadeEspecial (string|null — título da lista, tal como no Excel:
    null = "LISTA GERAL", ou o nome da categoria).
--}}
@php
    $necessidadeEspecial = $necessidadeEspecial ?? null;

    // Ordem alfabética por nome — ver App\Exports\SalaExameExport para a
    // explicação de por que a ordenação é feita em PHP, não via ORDER BY.
    $candidatosOrdenados = $candidaturas
        ->sortBy(fn ($c) => strtoupper(iconv('UTF-8', 'ASCII//TRANSLIT', $c->nome)))
        ->values();

    // Testado empiricamente: até 19 candidatos cabem numa única página com
    // cabeçalho + rodapé (mesmo limite de pdf/_sala-conteudo.blade.php, já
    // que a tabela tem o mesmo número de colunas/altura de linha).
    $linhasPorPagina = 19;
    $blocos = $candidatosOrdenados->chunk($linhasPorPagina);
    $totalBlocos = $blocos->count();

    $grupos = $candidaturas
        ->groupBy(fn ($c) => trim($c->curso) . ' — ' . ($c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular'))
        ->keys()->implode(' / ');

    $tituloLista = $necessidadeEspecial
        ? 'EXAME DE ACESSO 2026/2027 — LISTA: ' . mb_strtoupper($necessidadeEspecial, 'UTF-8')
        : 'EXAME DE ACESSO 2026/2027 — LISTA GERAL';
@endphp

@if($candidaturas->isEmpty())
    <div class="pagina {{ $primeiroDoDocumento ? '' : 'seguinte' }}">
        <div class="header">
            @if($logoBase64)<img src="{{ $logoBase64 }}" alt="ISP-Bié">@endif
            <div class="inst">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</div>
            <div class="linha-dupla"></div>
            <div class="sub">COMISSÃO DO EXAME DE ACESSO — {{ $tituloLista }}</div>
        </div>

        <div class="sala-titulo">{{ mb_strtoupper($sala->nome, 'UTF-8') }}</div>
        <div class="sala-info">
            Data/Horário:
            {{ $sala->data_exame ? $sala->data_exame->format('d/m/Y') : '___________' }}
            &nbsp;|&nbsp;
            {{ $sala->horario ? $sala->horario . 'h' : '___________' }}
        </div>

        <p style="text-align:center;color:#666;margin-top:10mm;">Nenhum candidato nesta lista.</p>

        <div class="assinatura-unica">
            <img class="assinatura-img" src="{{ \App\Services\SignatureImageGenerator::generate('Fernando Maia') }}" alt="Assinatura">
            <div class="linha"></div>
            <div class="label">Professor Doutor Fernando Maia</div>
            <div class="sublabel">Presidente da Comissão do Exame de Acesso</div>
        </div>

        <div class="footer">
            Documento gerado em {{ now()->format('d/m/Y H:i') }} — ISP-Bié — Uso interno
        </div>
    </div>
@else
    @foreach($blocos as $idx => $bloco)
    @php $forcarQuebra = ! ($primeiroDoDocumento && $idx === 0); @endphp
    <div class="pagina {{ $forcarQuebra ? 'seguinte' : '' }}">

        @if($idx === 0)
        <div class="header">
            @if($logoBase64)<img src="{{ $logoBase64 }}" alt="ISP-Bié">@endif
            <div class="inst">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</div>
            <div class="linha-dupla"></div>
            <div class="sub">COMISSÃO DO EXAME DE ACESSO — {{ $tituloLista }}</div>
        </div>

        <div class="sala-titulo">{{ mb_strtoupper($sala->nome, 'UTF-8') }}</div>
        <div class="sala-info">
            Curso(s)/Período: {{ $grupos }}
            <br>
            <span style="margin-top:2mm;display:block;">
                Data/Horário:
                {{ $sala->data_exame ? $sala->data_exame->format('d/m/Y') : '___________' }}
                &nbsp;|&nbsp;
                {{ $sala->horario ? $sala->horario . 'h' : '___________' }}
            </span>
        </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th style="width:12%;text-align:center;">N.º Ficha</th>
                    <th style="width:42%;">Nome Completo</th>
                    <th style="width:46%;text-align:center;">Assinatura</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bloco as $c)
                <tr>
                    <td style="text-align:center;font-weight:bold;color:#1a4e8a;">{{ str_pad($c->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td class="nome-col">{{ mb_strtoupper($c->nome, 'UTF-8') }}</td>
                    <td>&nbsp;</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($idx === $totalBlocos - 1)
        <div class="assinatura-unica">
            <img class="assinatura-img" src="{{ \App\Services\SignatureImageGenerator::generate('Fernando Maia') }}" alt="Assinatura">
            <div class="linha"></div>
            <div class="label">Professor Doutor Fernando Maia</div>
            <div class="sublabel">Presidente da Comissão do Exame de Acesso</div>
        </div>

        <div class="footer">
            Documento gerado em {{ now()->format('d/m/Y H:i') }} — ISP-Bié — Uso interno
        </div>
        @endif
    </div>
    @endforeach
@endif
