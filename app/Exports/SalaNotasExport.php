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
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class SalaNotasExport implements FromArray, WithTitle, WithStyles, WithColumnWidths, WithDrawings
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
        return 'Lançamento de Notas';
    }

    public function array(): array
    {
        $rows = [];

        $rows[] = ['', '', '', '', '', '', '']; // linha 1 — logo
        $rows[] = ['', 'INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ', '', '', '', '', ''];
        $rows[] = ['', 'DEPARTAMENTO DOS ASSUNTOS ACADÉMICOS', '', '', '', '', ''];
        $rows[] = ['', 'EXAME DE ACESSO 2025/2026 — LANÇAMENTO DE NOTAS', '', '', '', '', ''];
        $rows[] = ['', '', '', '', '', '', ''];

        $grupos = $this->candidaturas
            ->groupBy(fn($c) => $c->curso . ' — ' . ($c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular'))
            ->keys()->implode(' / ');

        $rows[] = ['', 'Sala:', $this->sala->nome, 'Capacidade:', $this->sala->capacidade, '', ''];
        $rows[] = ['', 'Curso(s) / Período:', $grupos, '', '', '', ''];
        $rows[] = ['', '', '', '', '', '', ''];

        // Cabeçalho da tabela
        $rows[] = ['N.º', 'Nome Completo', 'BI / Passaporte', 'Sexo', 'Nota (0–20)', 'Classificação', 'Observações'];

        // Dados
        foreach ($this->candidaturas as $c) {
            $rows[] = [
                $c->numero_lugar,
                $c->nome,
                $c->bi,
                $c->sexo ? ucfirst($c->sexo) : '',
                '', // nota — em branco para preenchimento
                '', // aprovado/reprovado
                '', // observações
            ];
        }

        $rows[] = ['', '', '', '', '', '', ''];
        $rows[] = ['', '', '', '', '', '', ''];
        $rows[] = ['', '_________________________________', '', '', '_________________________________', '', ''];
        $rows[] = ['', 'Responsável de Sala', '', '', 'Chefe de Departamento', '', ''];

        return $rows;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 38,
            'C' => 18,
            'D' => 10,
            'E' => 14,
            'F' => 16,
            'G' => 20,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        $sheet->mergeCells('B2:G2');
        $sheet->mergeCells('B3:G3');
        $sheet->mergeCells('B4:G4');
        $sheet->mergeCells('C6:G6');
        $sheet->mergeCells('C7:G7');

        $sheet->getRowDimension(1)->setRowHeight(55);
        $sheet->getRowDimension(2)->setRowHeight(22);
        $sheet->getRowDimension(3)->setRowHeight(16);
        $sheet->getRowDimension(4)->setRowHeight(18);

        // Cabeçalho tabela
        $sheet->getStyle('A9:G9')->applyFromArray([
            'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0E5C2F']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FFFFFF']]],
        ]);
        $sheet->getRowDimension(9)->setRowHeight(20);

        // Linhas de dados
        $dataEnd = 9 + $this->candidaturas->count();
        for ($r = 10; $r <= $dataEnd; $r++) {
            $bg = ($r % 2 === 0) ? 'EDF7F1' : 'FFFFFF';
            $sheet->getStyle("A{$r}:G{$r}")->applyFromArray([
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $bg]],
                'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CCCCCC']]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);
            // Coluna Nota — borda mais grossa para destacar
            $sheet->getStyle("E{$r}")->applyFromArray([
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_MEDIUM, 'color' => ['rgb' => '0E5C2F']]],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
            $sheet->getStyle("A{$r}")->applyFromArray([
                'font'      => ['bold' => true, 'color' => ['rgb' => '0E5C2F']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
            $sheet->getRowDimension($r)->setRowHeight(18);
        }

        $sheet->getStyle('B2')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 14, 'color' => ['rgb' => '1565C0']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('B3')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 11],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('B4')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 12, 'color' => ['rgb' => '0E5C2F']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('B6:B7')->applyFromArray(['font' => ['bold' => true]]);

        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT);
        $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
        $sheet->getPageSetup()->setFitToPage(true);
        $sheet->getPageSetup()->setFitToWidth(1);
        $sheet->getPageSetup()->setFitToHeight(0);
        $sheet->getPageMargins()->setTop(0.5)->setBottom(0.5)->setLeft(0.5)->setRight(0.5);

        return [];
    }

    public function drawings()
    {
        $logoPath = public_path('images/logo-ispbie.png');
        if (!file_exists($logoPath)) return [];

        $drawing = new Drawing();
        $drawing->setName('Logo ISP-Bié');
        $drawing->setPath($logoPath);
        $drawing->setHeight(50);
        $drawing->setCoordinates('B1');
        $drawing->setOffsetX(5);
        $drawing->setOffsetY(4);

        return [$drawing];
    }
}
