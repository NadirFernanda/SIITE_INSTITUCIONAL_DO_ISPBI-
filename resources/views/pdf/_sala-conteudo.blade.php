{{--
    Conteúdo de uma sala (páginas manualmente divididas em blocos que cabem
    sempre numa única folha — ver comentário em pdf/sala.blade.php sobre
    porque não se usa overflow automático de tabela). Isolado num partial
    para poder ser incluído tanto isoladamente (download de uma sala) como
    concatenado com outras salas no mesmo documento (impressão em lote) sem
    duplicar <html>/<head>/<body> — múltiplos desses tornavam o HTML
    inválido e o dompdf inseria páginas em branco a mais entre salas.

    Espera: $sala, $candidaturas, $logoBase64, $primeiroDoDocumento (bool —
    true só para a primeiríssima sala do documento, que já começa na
    página 1 sem precisar de quebra de página antes).
--}}
@php
    $linhasPorPagina = 19;
    $blocos = [];
    foreach ($candidaturas->groupBy(fn ($c) => $c->curso . '|||' . $c->periodo) as $chave => $lista) {
        [$curso, $periodo] = explode('|||', $chave);
        foreach ($lista->sortBy('id')->values()->chunk($linhasPorPagina) as $i => $chunk) {
            $blocos[] = [
                'curso'        => trim($curso),
                'periodo'      => $periodo,
                'continuacao'  => $i > 0,
                'candidatos'   => $chunk,
            ];
        }
    }
    $totalBlocos = count($blocos);
@endphp

@if($candidaturas->isEmpty())
    <div class="pagina {{ $primeiroDoDocumento ? '' : 'seguinte' }}">
        <div class="header">
            @if($logoBase64)<img src="{{ $logoBase64 }}" alt="ISP-Bié">@endif
            <div class="inst">INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ</div>
            <div class="linha-dupla"></div>
            <div class="sub">COMISSÃO DO EXAME DE ACESSO — EXAME DE ACESSO 2026/2027</div>
        </div>

        <div class="sala-titulo">{{ mb_strtoupper($sala->nome, 'UTF-8') }}</div>
        <div class="sala-info">
            Capacidade: {{ $sala->capacidade }} lugares &nbsp;|&nbsp;
            Candidatos atribuídos: {{ $candidaturas->count() }}
            <br>
            <span style="margin-top:3mm;display:block;">
                Data/Horário:
                {{ $sala->data_exame ? $sala->data_exame->format('d/m/Y') : '___________' }}
                &nbsp;|&nbsp;
                {{ $sala->horario ? $sala->horario . 'h' : '___________' }}
            </span>
        </div>

        <p style="text-align:center;color:#666;margin-top:10mm;">Nenhum candidato atribuído a esta sala.</p>

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
            <div class="sub">COMISSÃO DO EXAME DE ACESSO — EXAME DE ACESSO 2026/2027</div>
        </div>

        <div class="sala-titulo">{{ mb_strtoupper($sala->nome, 'UTF-8') }}</div>
        <div class="sala-info">
            Capacidade: {{ $sala->capacidade }} lugares &nbsp;|&nbsp;
            Candidatos atribuídos: {{ $candidaturas->count() }}
            <br>
            <span style="margin-top:3mm;display:block;">
                Data/Horário:
                {{ $sala->data_exame ? $sala->data_exame->format('d/m/Y') : '___________' }}
                &nbsp;|&nbsp;
                {{ $sala->horario ? $sala->horario . 'h' : '___________' }}
            </span>
        </div>
        @endif

        <div class="grupo-header">
            {{ $bloco['curso'] }} — {{ $bloco['periodo'] === 'pos-laboral' ? 'Pós-Laboral' : 'Regular' }}{{ $bloco['continuacao'] ? ' (continuação)' : '' }}
        </div>
        <table>
            <thead>
                <tr>
                    <th style="width:70px;text-align:center;">N.º Ficha</th>
                    <th>Nome Completo</th>
                    <th style="width:70px;text-align:center;">Sexo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bloco['candidatos'] as $c)
                <tr>
                    <td style="text-align:center;font-weight:bold;color:#1a4e8a;">{{ str_pad($c->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td class="nome-col">{{ mb_strtoupper($c->nome, 'UTF-8') }}</td>
                    <td style="text-align:center;">{{ $c->sexo ? ucfirst($c->sexo) : '—' }}</td>
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
