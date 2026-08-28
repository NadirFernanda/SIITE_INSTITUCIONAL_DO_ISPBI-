{{--
    Conteúdo de uma sala para a Lista de Exame ANÓNIMA (só N.º Ficha, sem
    nome) — usado exclusivamente pelo perfil Lançamento, que lança notas por
    código sem ver os nomes dos candidatos (garantia de anonimato na
    correcção). Não confundir com pdf/_sala-exame-conteudo.blade.php, que
    mostra nome e assinatura para os restantes perfis.

    Espera: $sala, $candidaturas, $logoBase64, $primeiroDoDocumento (bool).
--}}
@php
    // Testado empiricamente: até 16 candidatos cabem numa única página com
    // cabeçalho + rodapé; 17 já transborda para uma 2ª página.
    $linhasPorPagina = 16;
    $blocos = $candidaturas->values()->chunk($linhasPorPagina);
    $totalBlocos = $blocos->count();
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

        <table>
            <thead>
                <tr>
                    <th style="text-align:left;font-weight:700;">N.º Ficha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bloco as $c)
                <tr>
                    <td style="font-weight:700;letter-spacing:0.08em;">{{ str_pad($c->id, 5, '0', STR_PAD_LEFT) }}</td>
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
