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
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class SalaExameExport implements FromArray, WithTitle, WithStyles, WithColumnWidths, WithDrawings
{
    protected Sala $sala;
    protected Collection $candidaturas;

    public function __construct(Sala $sala)
    {
        $this->sala         = $sala;
        $this->candidaturas = $sala->candidaturas()->orderBy('numero_lugar')->get();
    }

    public function title(): string
    {
        return 'Lista de Exame';
    }

    public function array(): array
    {
        $rows = [];

        // 2 colunas: A = N.º, B = Nome Completo
        $rows[] = ['', ''];  // linha 1 — logo

        $rows[] = ['INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ', ''];
        $rows[] = ['DEPARTAMENTO DOS ASSUNTOS ACADÉMICOS', ''];
        $rows[] = ['EXAME DE ACESSO 2025/2026 — LISTA DE EXAME', ''];
        $rows[] = ['', ''];

        $grupos = $this->candidaturas
            ->groupBy(fn($c) => $c->curso . ' — ' . ($c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular'))
            ->keys()->implode(' / ');

        $dataHorario = '';
        if ($this->sala->data_exame) {
            $dataHorario .= $this->sala->data_exame->format('d/m/Y');
        }
        if ($this->sala->horario) {
            $dataHorario .= ($dataHorario ? '  |  ' : '') . $this->sala->horario . 'h';
        }

        $rows[] = ['Sala: ' . $this->sala->nome, ''];
        $rows[] = ['Curso(s) / Período: ' . $grupos, ''];
        if ($dataHorario) {
            $rows[] = ['Data / Horário: ' . $dataHorario, ''];
        }
        $rows[] = ['', ''];

        // Cabeçalho da tabela — apenas N.º e Nome
        $rows[] = ['N.º', 'NOME COMPLETO'];

        foreach ($this->candidaturas as $c) {
            $rows[] = [$c->numero_lugar, strtoupper($c->nome)];
        }

        // Assinatura do Presidente (centrada)
        $rows[] = ['', ''];
        $rows[] = ['', ''];
        $rows[] = ['', ''];
        $rows[] = ['', '_________________________________'];
        $rows[] = ['', 'Professor Doutor Fernando Maia'];
        $rows[] = ['', 'Presidente da Instituição'];

        return $rows;
    }

    public function columnWidths(): array
    {
        // A4 portrait com margens 0.5" ≈ 105 unidades → 2 colunas
        return ['A' => 6, 'B' => 99];
    }

    public function styles(Worksheet $sheet): array
    {
        // Mesclar cabeçalho A:B (2 colunas)
        $sheet->mergeCells('A2:B2');
        $sheet->mergeCells('A3:B3');
        $sheet->mergeCells('A4:B4');
        $sheet->mergeCells('A6:B6');
        $sheet->mergeCells('A7:B7');

        $sheet->getRowDimension(1)->setRowHeight(60);
        $sheet->getRowDimension(2)->setRowHeight(22);
        $sheet->getRowDimension(3)->setRowHeight(16);
        $sheet->getRowDimension(4)->setRowHeight(18);
        $sheet->getRowDimension(5)->setRowHeight(6);
        $sheet->getRowDimension(9)->setRowHeight(22);

        // Títulos — centrados
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
        $sheet->getStyle('A6:A7')->applyFromArray(['font' => ['bold' => true, 'size' => 10]]);

        // Cabeçalho tabela (A:B)
        $sheet->getStyle('A9:B9')->applyFromArray([
            'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1565C0']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FFFFFF']]],
        ]);

        // Linhas de dados
        $dataEnd = 9 + $this->candidaturas->count();
        for ($r = 10; $r <= $dataEnd; $r++) {
            $bg = ($r % 2 === 0) ? 'EBF3FD' : 'FFFFFF';
            $sheet->getStyle("A{$r}:B{$r}")->applyFromArray([
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

        // Assinatura do Presidente — centrada em B
        $sigStart = $dataEnd + 4;
        $sigNome  = $sigStart + 1;
        $sigCargo = $sigStart + 2;
        $sheet->mergeCells("A{$sigStart}:B{$sigStart}");
        $sheet->mergeCells("A{$sigNome}:B{$sigNome}");
        $sheet->mergeCells("A{$sigCargo}:B{$sigCargo}");
        $sheet->getStyle("A{$sigStart}")->applyFromArray([
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

        // ── Configuração de impressão A4 com paginação natural ──
        // setFitToPage(false) + scale(100) = Excel pagina normalmente.
        // Página 1: cabeçalho + dados. Página 2+: apenas dados (sem repetir cabeçalho).
        $ps = $sheet->getPageSetup();
        $ps->setOrientation(PageSetup::ORIENTATION_PORTRAIT);
        $ps->setPaperSize(PageSetup::PAPERSIZE_A4);
        $ps->setFitToPage(false);
        $ps->setScale(100);
        $ps->setHorizontalCentered(true);

        $sheet->getPageMargins()
            ->setTop(0.59)     // ~15mm
            ->setBottom(0.59)
            ->setLeft(0.39)    // ~10mm
            ->setRight(0.39)
            ->setHeader(0.2)
            ->setFooter(0.2);

        return [];
    }

    public function drawings()
    {
        $logoPath = public_path('images/logo.png');
        if (!file_exists($logoPath) || filesize($logoPath) === 0) return [];

        [$logoW, $logoH] = getimagesize($logoPath);
        $displayH = 52;
        $displayW = (int)($logoW * $displayH / $logoH);

        // Centrar em coluna B (99 chars × 7px = 693px)
        $colBPx  = 99 * 7;
        $offsetX = max(0, (int)(($colBPx - $displayW) / 2));

        $drawing = new Drawing();
        $drawing->setName('Logo ISP-Bié');
        $drawing->setPath($logoPath);
        $drawing->setHeight($displayH);
        $drawing->setWidth($displayW);
        $drawing->setCoordinates('B1');
        $drawing->setOffsetX($offsetX);
        $drawing->setOffsetY(4);

        return [$drawing];
    }
}
