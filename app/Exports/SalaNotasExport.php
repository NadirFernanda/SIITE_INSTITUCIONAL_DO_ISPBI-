<?php

namespace App\Exports;

use App\Models\Sala;
use App\Models\CandidaturaNota;
use App\Support\CsvSanitizer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class SalaNotasExport implements FromArray, WithTitle, WithStyles, WithColumnWidths, WithDrawings
{
    protected Sala $sala;
    protected Collection $candidaturas;
    protected int $tableRow = 5; // sempre linha 5 (estrutura fixa igual ao SalaExameExport)
    protected array $disciplines = [];

    public function __construct(Sala $sala)
    {
        $this->sala         = $sala;
        // Ordem alfabética por nome — ver App\Exports\SalaExameExport para a
        // explicação de por que a ordenação é feita em PHP, não via ORDER BY.
        $this->candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->get()
            ->sortBy(fn ($c) => strtoupper(iconv('UTF-8', 'ASCII//TRANSLIT', $c->nome)))
            ->values();

        // Buscar disciplinas definidas para ESTA SALA (não por curso)
        $this->disciplines = \App\Models\SalaDiscipline::where('sala_id', $sala->id)
            ->orderBy('id')
            ->get()
            ->map(fn($d) => ['discipline' => $d->discipline, 'weight_percent' => $d->weight_percent])
            ->toArray();
    }

    public function title(): string
    {
        // Ver App\Exports\SalaExameExport::title() — mesma necessidade de nome
        // único e dentro do limite de 31 caracteres quando várias salas são
        // combinadas num só ficheiro (impressão em lote por horário).
        $nome = preg_replace('/[\\\\\/\?\*\[\]:]/', '', $this->sala->nome);
        $sufixo = ' #' . $this->sala->id;
        $prefixo = 'Pauta - ';
        $maxNome = max(1, 31 - mb_strlen($prefixo) - mb_strlen($sufixo));
        return $prefixo . mb_substr($nome, 0, $maxNome) . $sufixo;
    }

    public function array(): array
    {
        $rows = [];

        // Linha 1 — espaço mínimo (logo está no cabeçalho de impressão)
        $rows[] = ['', ''];

        // Linha 2 — nome da instituição
        $rows[] = ['INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ', ''];

        // Linha 3 — comissão + título da pauta, combinados numa só linha
        $rows[] = ['COMISSÃO DO EXAME DE ACESSO   —   EXAME DE ACESSO 2026/2027 — PAUTA', ''];

        // Linha 4 — sala, curso(s)/período e data/horário combinados numa só
        // linha. O cabeçalho institucional inteiro fica "congelado" (freeze
        // pane) ao rolar a pauta — quanto menos linhas ocupar, mais espaço
        // sobra no ecrã para ver candidatos ao rolar.
        $grupos = $this->candidaturas
            ->groupBy(fn($c) => $c->curso . ' — ' . ($c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular'))
            ->keys()->implode(' / ');

        $dataHorario = '';
        if ($this->sala->data_exame) {
            $dataHorario .= method_exists($this->sala->data_exame, 'format') ? $this->sala->data_exame->format('d/m/Y') : (string)$this->sala->data_exame;
        }
        if ($this->sala->horario) {
            $dataHorario .= ($dataHorario ? '  |  ' : '') . $this->sala->horario . 'h';
        }
        $rows[] = [
            'Sala: ' . $this->sala->nome
                . '     |     Curso(s)/Período: ' . $grupos
                . '     |     Data/Horário: ' . ($dataHorario ?: '___________  |  ___________'),
            '',
        ];

        // Construir cabeçalho da tabela dinamicamente
        $header = ['CÓDIGO EXAME', 'NOME COMPLETO'];
        foreach ($this->disciplines as $d) {
            $header[] = mb_strtoupper($d['discipline'], 'UTF-8');
        }
        $header[] = 'NOTA FINAL (0–20)';
        $header[] = 'RESULTADO';

        // Garantir que a tabela comece na linha fixa definida
        // Preencher linhas de cabeçalho até chegar à $this->tableRow
        $currentRow = count($rows) + 1;
        while ($currentRow < $this->tableRow) {
            $rows[] = array_fill(0, count($header), '');
            $currentRow++;
        }

        $rows[] = $header;

        // Dados
        foreach ($this->candidaturas as $c) {
            $line = [];
            $line[] = $c->codigo_exame ?? 'NÃO GERADO';
            $line[] = mb_strtoupper(CsvSanitizer::safe($c->nome), 'UTF-8');

            $sum = 0.0;
            $hasAny = false;
            foreach ($this->disciplines as $d) {
                $notaRow = CandidaturaNota::where('candidatura_id', $c->id)->where('discipline', $d['discipline'])->first();
                $nota = $notaRow ? (float) $notaRow->nota : null;
                if ($nota !== null) {
                    $hasAny = true;
                    $sum += $nota;
                    $line[] = number_format($nota, 2, '.', ',');
                } else {
                    $line[] = '';
                }
            }

            // Se não houver nenhuma nota lançada, soma fica vazia
            $line[] = $hasAny ? number_format($sum, 2, '.', ',') : '';
            $line[] = ''; // Resultado em branco

            $rows[] = $line;
        }

        // Assinatura do Presidente — adicionar linhas vazias para manter layout
        $rows[] = array_fill(0, count($header), '');
        $rows[] = array_fill(0, count($header), '');
        $rows[] = array_fill(0, count($header), '');
        $rows[] = ['_________________________________', ''] + array_fill(0, max(0, count($header) - 2), '');
        $rows[] = ['Professor Doutor Fernando Maia', ''] + array_fill(0, max(0, count($header) - 2), '');
        $rows[] = ['Presidente da Comissão do Exame de Acesso', ''] + array_fill(0, max(0, count($header) - 2), '');

        return $rows;
    }

    public function columnWidths(): array
    {
        // A dynamic mapping: A = código, B = nome, next N = disciplinas, last two = Soma/Resultado
        $widths = [];
        $widths['A'] = 12;
        $widths['B'] = 50;

        $col = 'C';
        foreach ($this->disciplines as $d) {
            // Largura proporcional ao nome da disciplina (em vez de um valor fixo de 15),
            // para nomes compridos não ficarem cortados no cabeçalho da pauta. O texto
            // do cabeçalho também tem "wrapText" activo (ver styles()) como rede de
            // segurança para nomes muito longos.
            $widths[$col] = max(15, min(28, mb_strlen($d['discipline']) + 4));
            $col++;
        }
        // Soma
        $widths[$col] = 12;
        $col++;
        // Resultado
        $widths[$col] = 12;

        return $widths;
    }

    public function styles(Worksheet $sheet): array
    {
        $tr = $this->tableRow;
        $dataEnd = $tr + $this->candidaturas->count();
        $sigLinha = $dataEnd + 4;

        // Mesclar cabeçalho principal nas colunas usadas
        $lastCol = chr( ord('A') + (1 + count($this->disciplines) + 2) );
        // safe fallback if lastCol beyond 'Z' — avoid complex logic; only small number of disciplines expected
        $sheet->mergeCells("A2:{$lastCol}2");
        $sheet->mergeCells("A3:{$lastCol}3");
        $sheet->mergeCells("A4:{$lastCol}4");

        // Mesclar assinatura (traço, nome e cargo)
        $sigLinha = $dataEnd + 4;
        $sigNome = $sigLinha + 1;
        $sigCargo = $sigLinha + 2;
        $sheet->mergeCells("A{$sigLinha}:{$lastCol}{$sigLinha}");
        $sheet->mergeCells("A{$sigNome}:{$lastCol}{$sigNome}");
        $sheet->mergeCells("A{$sigCargo}:{$lastCol}{$sigCargo}");

        // Alturas e estilos básicos — cabeçalho institucional compactado ao
        // mínimo (4 linhas em vez de 9): como fica todo "congelado" (freeze
        // pane) ao rolar a pauta, quanto mais alto for, menos candidatos
        // cabem no ecrã ao rolar para baixo.
        $sheet->getRowDimension(1)->setRowHeight(48);
        $sheet->getRowDimension(2)->setRowHeight(18);
        $sheet->getRowDimension(3)->setRowHeight(16);
        $sheet->getRowDimension(4)->setRowHeight(16);
        // Cabeçalho mais alto do que o resto da tabela — dá espaço para os nomes das
        // disciplinas quebrarem em 2 linhas (wrapText) quando são compridos, em vez
        // de ficarem cortados.
        $sheet->getRowDimension($tr)->setRowHeight(34);

        $sheet->getStyle('A2')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 13, 'color' => ['rgb' => '1565C0']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('A3')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 10],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('A4')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 9, 'color' => ['rgb' => '0E5C2F']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT],
        ]);

        $lastHeaderRange = "A{$tr}:{$lastCol}{$tr}";
        $sheet->getStyle($lastHeaderRange)->applyFromArray([
            'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0E5C2F']],
            // wrapText: nomes de disciplinas compridos quebram para uma segunda linha
            // dentro da própria célula, em vez de aparecerem cortados.
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true],
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FFFFFF']]],
        ]);

        for ($r = $tr + 1; $r <= $dataEnd; $r++) {
            $bg = ($r % 2 === 0) ? 'EDF7F1' : 'FFFFFF';
            $sheet->getStyle("A{$r}:{$lastCol}{$r}")->applyFromArray([
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $bg]],
                'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CCCCCC']]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);
            $sheet->getStyle("A{$r}")->applyFromArray([
                'font'      => ['bold' => true, 'color' => ['rgb' => '0E5C2F']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
            $sheet->getRowDimension($r)->setRowHeight(22);
        }

        // Centralizar assinatura do presidente
        $sigNome = $sigLinha + 1;
        $sigCargo = $sigLinha + 2;
        $sheet->getStyle("A{$sigLinha}:{$lastCol}{$sigLinha}")->applyFromArray([
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle("A{$sigNome}:{$lastCol}{$sigNome}")->applyFromArray([
            'font'      => ['bold' => true, 'size' => 10],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle("A{$sigCargo}:{$lastCol}{$sigCargo}")->applyFromArray([
            'font'      => ['size' => 9, 'italic' => true],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // ── Imagem da assinatura digital do Presidente, por cima da linha ──
        $gdAssinatura = \App\Services\SignatureImageGenerator::generateGd('Fernando Maia');
        $imgW = imagesx($gdAssinatura);
        $imgH = imagesy($gdAssinatura);
        $assDisplayH = 28;
        $assDisplayW = (int) ($imgW * $assDisplayH / $imgH);

        $larguraTotal = array_sum($this->columnWidths());
        $assOffsetX = max(0, (int) ($larguraTotal * 8 / 2) - (int) ($assDisplayW / 2));

        $assinaturaDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing();
        $assinaturaDrawing->setName('Assinatura Presidente');
        $assinaturaDrawing->setImageResource($gdAssinatura);
        $assinaturaDrawing->setRenderingFunction(\PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::RENDERING_PNG);
        $assinaturaDrawing->setMimeType(\PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing::MIMETYPE_DEFAULT);
        $assinaturaDrawing->setHeight($assDisplayH);
        $assinaturaDrawing->setWidth($assDisplayW);
        $assinaturaDrawing->setCoordinates('A' . ($sigLinha - 2));
        $assinaturaDrawing->setOffsetX($assOffsetX);
        $assinaturaDrawing->setOffsetY(2);
        $assinaturaDrawing->setWorksheet($sheet);

        // ── Congela o cabeçalho da tabela ao rolar no ecrã ──
        $sheet->freezePane('A' . ($tr + 1));

        // Impressão A4
        $ps = $sheet->getPageSetup();
        $ps->setOrientation(PageSetup::ORIENTATION_PORTRAIT);
        $ps->setPaperSize(PageSetup::PAPERSIZE_A4);
        $ps->setFitToPage(true);
        $ps->setFitToWidth(1);
        $ps->setFitToHeight(0);
        $ps->setHorizontalCentered(true);
        // Repete a linha do cabeçalho da tabela (Código/Nome/Disciplinas/Soma/Resultado)
        // em todas as páginas impressas — sem isto, uma pauta com muitos candidatos
        // imprimia a página 2+ sem títulos, exigindo edição manual antes de imprimir.
        $ps->setRowsToRepeatAtTopByStartAndEnd($tr, $tr);
        $ps->setPrintArea("A1:{$lastCol}{$sigCargo}");

        $sheet->getPageMargins()
            ->setHeader(0.2)
            ->setTop(0.6)
            ->setBottom(0.59)
            ->setLeft(0.39)->setRight(0.39)
            ->setFooter(0.2);

        // ── Rodapé com paginação ──
        $sheet->getHeaderFooter()->setOddFooter('&LISP-Bié — Pauta&CPágina &P de &N&R' . now()->format('d/m/Y'));

        return [];
    }

    public function drawings()
    {
        $logoPath = public_path('images/logo.png');
        if (!file_exists($logoPath) || filesize($logoPath) === 0) return [];

        [$logoW, $logoH] = getimagesize($logoPath);
        $displayH = 44;
        $displayW = (int)($logoW * $displayH / $logoH);

        $centerFromB1 = (int)(((7 + 65 + 23) * 8 / 2) - (7 * 8));
        $offsetX = max(0, $centerFromB1 - (int)($displayW / 2));

        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Logo ISP-Bié');
        $drawing->setPath($logoPath);
        $drawing->setHeight($displayH);
        $drawing->setWidth($displayW);
        $drawing->setCoordinates('B1');
        $drawing->setOffsetX($offsetX);
        $drawing->setOffsetY(2);

        return [$drawing];
    }
}
