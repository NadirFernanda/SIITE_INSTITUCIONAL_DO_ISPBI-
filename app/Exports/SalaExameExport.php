<?php

namespace App\Exports;

use App\Models\Sala;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooter;
use PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooterDrawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class SalaExameExport implements FromArray, WithTitle, WithStyles, WithColumnWidths, WithDrawings
{
    protected Sala $sala;
    protected Collection $candidaturas;
    protected int $tableRow; // linha onde começa a tabela (depende de existir data/horário)

    public function __construct(Sala $sala)
    {
        $this->sala         = $sala;
        $this->candidaturas = $sala->candidaturas()->orderBy('numero_lugar')->get();
    }

    public function title(): string
    {
        return 'Lista de Presença';
    }

    public function array(): array
    {
        $rows = [];

        // Linha 1 — espaço para logo (Drawing)
        $rows[] = ['', '', ''];

        // Cabeçalho (linhas 2-4) — mescladas A:B, centradas
        $rows[] = ['INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ', '', ''];
        $rows[] = ['DEPARTAMENTO DOS ASSUNTOS ACADÉMICOS', '', ''];
        $rows[] = ['EXAME DE ACESSO 2026/2027 — LISTA DE PRESENÇA', '', ''];

        // Linha 5 — vazia
        $rows[] = ['', '', ''];

        // Linhas 6-7 — info da sala
        $grupos = $this->candidaturas
            ->groupBy(fn($c) => $c->curso . ' — ' . ($c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular'))
            ->keys()->implode(' / ');

        $rows[] = ['Sala: ' . $this->sala->nome, '', ''];
        $rows[] = ['Curso(s) / Período: ' . $grupos, '', ''];

        // Linha 8 — data/horário (sempre, para manter estrutura fixa)
        $dataHorario = '';
        if ($this->sala->data_exame) {
            $dataHorario .= $this->sala->data_exame->format('d/m/Y');
        }
        if ($this->sala->horario) {
            $dataHorario .= ($dataHorario ? '  |  ' : '') . $this->sala->horario . 'h';
        }
        $rows[] = ['Data / Horário: ' . ($dataHorario ?: '___________  |  ___________'), '', ''];

        // Linha 9 — vazia
        $rows[] = ['', '', ''];

        // Linha 10 — cabeçalho da tabela (SEMPRE na linha 10)
        $this->tableRow = 10;
        $rows[] = ['N.º', 'NOME COMPLETO', 'ASSINATURA'];

        // Linhas de dados
        foreach ($this->candidaturas as $c) {
            $rows[] = [$c->numero_lugar, strtoupper($c->nome), ''];
        }

        // Assinatura do Presidente — centrada (merge A:B)
        $rows[] = ['', '', ''];
        $rows[] = ['', '', ''];
        $rows[] = ['', '', ''];
        $rows[] = ['_________________________________', '', ''];
        $rows[] = ['Professor Doutor Fernando Maia', '', ''];
        $rows[] = ['Presidente da Instituição', '', ''];

        return $rows;
    }

    public function columnWidths(): array
    {
        // A4 portrait, 3 colunas: N.º(6) + Nome(65) + Assinatura(34) ≈ 105
        return ['A' => 6, 'B' => 65, 'C' => 34];
    }

    public function styles(Worksheet $sheet): array
    {
        $dataEnd = $this->tableRow + $this->candidaturas->count();
        $sigLinha = $dataEnd + 4;
        $sigNome  = $sigLinha + 1;
        $sigCargo = $sigLinha + 2;

        // ── Mesclar cabeçalho ──
        $sheet->mergeCells('A2:C2');
        $sheet->mergeCells('A3:C3');
        $sheet->mergeCells('A4:C4');
        $sheet->mergeCells('A6:C6');
        $sheet->mergeCells('A7:C7');
        $sheet->mergeCells('A8:C8');
        $sheet->mergeCells("A{$sigLinha}:C{$sigLinha}");
        $sheet->mergeCells("A{$sigNome}:C{$sigNome}");
        $sheet->mergeCells("A{$sigCargo}:C{$sigCargo}");

        // ── Alturas ──
        $sheet->getRowDimension(1)->setRowHeight(55); // espaço para o logo (Drawing)
        $sheet->getRowDimension(2)->setRowHeight(22);
        $sheet->getRowDimension(3)->setRowHeight(16);
        $sheet->getRowDimension(4)->setRowHeight(18);
        $sheet->getRowDimension(5)->setRowHeight(8);
        $sheet->getRowDimension(9)->setRowHeight(8);
        $sheet->getRowDimension($this->tableRow)->setRowHeight(22);

        // ── Estilos do cabeçalho ──
        $sheet->getStyle('A2')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 14, 'color' => ['rgb' => '1565C0']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('A3')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 11],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('A4')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 12],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('A6:A8')->applyFromArray(['font' => ['bold' => true, 'size' => 10]]);

        // ── Cabeçalho da tabela ──
        $tr = $this->tableRow;
        $sheet->getStyle("A{$tr}:C{$tr}")->applyFromArray([
            'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1565C0']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FFFFFF']]],
        ]);

        // ── Linhas de dados ──
        for ($r = $tr + 1; $r <= $dataEnd; $r++) {
            $bg = ($r % 2 === 0) ? 'EBF3FD' : 'FFFFFF';
            $sheet->getStyle("A{$r}:C{$r}")->applyFromArray([
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $bg]],
                'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'DDDDDD']]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);
            $sheet->getStyle("A{$r}")->applyFromArray([
                'font'      => ['bold' => true, 'color' => ['rgb' => '1565C0']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
            $sheet->getRowDimension($r)->setRowHeight(22);
        }

        // ── Assinatura do Presidente ──
        $sheet->getStyle("A{$sigLinha}")->applyFromArray([
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'borders'   => ['bottom' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']]],
        ]);
        $sheet->getStyle("A{$sigNome}")->applyFromArray([
            'font'      => ['bold' => true, 'size' => 10],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle("A{$sigCargo}")->applyFromArray([
            'font'      => ['size' => 9, 'italic' => true],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // ── Sem header de impressão — logo só na página 1 via Drawing ──
        // Página 2+ fica limpa (só lista + assinatura, sem repetição do logo/cabeçalho)

        // ── Impressão A4 ──
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

        // Centrar logo across colunas A(6)+B(65)+C(34)=105 chars.
        // Ancoramos em B1 para evitar que offsets grandes sejam ignorados pelo Excel.
        // Centro total (a 8px/char): (105*8)/2 = 420px desde a esquerda.
        // Offset desde A1 até B1 = 6*8 = 48px.
        // => Offset desde B1 até ao centro = 420 - 48 = 372px.
        $centerFromB1 = (int)(((6 + 65 + 34) * 8 / 2) - (6 * 8));
        $offsetX = max(0, $centerFromB1 - (int)($displayW / 2));

        $drawing = new Drawing();
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
