<?php

namespace App\Exports;

use App\Models\Sala;
use App\Models\CandidaturaNota;
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
    protected int $tableRow = 10; // sempre linha 10 (estrutura fixa igual ao SalaExameExport)
    protected array $disciplines = [];

    public function __construct(Sala $sala)
    {
        $this->sala         = $sala;
        $this->candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->orderBy('id')
            ->get();

        // Buscar disciplinas definidas para ESTA SALA (não por curso)
        $this->disciplines = \App\Models\SalaDiscipline::where('sala_id', $sala->id)
            ->orderBy('id')
            ->get()
            ->map(fn($d) => ['discipline' => $d->discipline, 'weight_percent' => $d->weight_percent])
            ->toArray();
    }

    public function title(): string
    {
        return 'Pauta';
    }

    public function array(): array
    {
        $rows = [];

        // Linha 1 — espaço mínimo (logo está no cabeçalho de impressão)
        $rows[] = ['', ''];

        // Cabeçalho (linhas 2-4) — mescladas A:.., centradas
        $rows[] = ['INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ', ''];
        $rows[] = ['DEPARTAMENTO DOS ASSUNTOS ACADÉMICOS', ''];
        $rows[] = ['EXAME DE ACESSO 2026/2027 — PAUTA', ''];

        // Linha 5 — vazia
        $rows[] = ['', ''];

        // Linhas 6-7 — info da sala
        $grupos = $this->candidaturas
            ->groupBy(fn($c) => $c->curso . ' — ' . ($c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular'))
            ->keys()->implode(' / ');

        $rows[] = ['Sala: ' . $this->sala->nome, ''];
        $rows[] = ['Curso(s) / Período: ' . $grupos, ''];

        // Linha 8 — data/horário
        $dataHorario = '';
        if ($this->sala->data_exame) {
            $dataHorario .= method_exists($this->sala->data_exame, 'format') ? $this->sala->data_exame->format('d/m/Y') : (string)$this->sala->data_exame;
        }
        if ($this->sala->horario) {
            $dataHorario .= ($dataHorario ? '  |  ' : '') . $this->sala->horario . 'h';
        }
        $rows[] = $dataHorario ? ['Data / Horário: ' . $dataHorario, ''] : ['', ''];

        // Linha vazia
        $rows[] = ['', ''];

        // Construir cabeçalho da tabela dinamicamente
        $header = ['CÓDIGO EXAME', 'NOME COMPLETO'];
        foreach ($this->disciplines as $d) {
            $header[] = strtoupper($d['discipline']);
        }
        $header[] = 'SOMA (0–20)';
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
            $line[] = strtoupper($c->nome);

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
        $rows[] = ['Presidente da Instituição', ''] + array_fill(0, max(0, count($header) - 2), '');

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
            $widths[$col] = 15;
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
        $sheet->mergeCells("A6:{$lastCol}6");
        $sheet->mergeCells("A7:{$lastCol}7");
        $sheet->mergeCells("A8:{$lastCol}8");
        $sheet->mergeCells("A{$sigLinha}:{$lastCol}{$sigLinha}");

        // Alturas e estilos básicos (similar ao anterior)
        $sheet->getRowDimension(1)->setRowHeight(55);
        $sheet->getRowDimension(2)->setRowHeight(22);
        $sheet->getRowDimension(3)->setRowHeight(16);
        $sheet->getRowDimension(4)->setRowHeight(18);
        $sheet->getRowDimension(5)->setRowHeight(8);
        $sheet->getRowDimension(9)->setRowHeight(8);
        $sheet->getRowDimension($tr)->setRowHeight(22);

        $sheet->getStyle('A2')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 14, 'color' => ['rgb' => '1565C0']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('A3')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 11],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('A4')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 12, 'color' => ['rgb' => '0E5C2F']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        $lastHeaderRange = "A{$tr}:{$lastCol}{$tr}";
        $sheet->getStyle($lastHeaderRange)->applyFromArray([
            'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0E5C2F']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
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

        // Impressão A4
        $ps = $sheet->getPageSetup();
        $ps->setOrientation(PageSetup::ORIENTATION_PORTRAIT);
        $ps->setPaperSize(PageSetup::PAPERSIZE_A4);
        $ps->setFitToPage(true);
        $ps->setFitToWidth(1);
        $ps->setFitToHeight(0);
        $ps->setHorizontalCentered(true);

        $sheet->getPageMargins()
            ->setHeader(0.2)
            ->setTop(0.6)
            ->setBottom(0.59)
            ->setLeft(0.39)->setRight(0.39)
            ->setFooter(0.2);

        return [];
    }

    public function drawings()
    {
        $logoPath = public_path('images/logo.png');
        if (!file_exists($logoPath) || filesize($logoPath) === 0) return [];

        [$logoW, $logoH] = getimagesize($logoPath);
        $displayH = 55;
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
        $drawing->setOffsetY(3);

        return [$drawing];
    }
}
