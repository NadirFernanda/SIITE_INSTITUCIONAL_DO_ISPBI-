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

/**
 * Exportação de pauta para o perfil LANÇAMENTO
 * Mostra APENAS códigos (sem dados dos candidatos)
 * Coluna 2 (NOME) fica oculta visualmente
 */
class SalaNotasExportLancamento implements FromArray, WithTitle, WithStyles, WithColumnWidths, WithDrawings
{
    protected Sala $sala;
    protected Collection $candidaturas;
    protected int $tableRow = 10;

    public function __construct(Sala $sala)
    {
        $this->sala         = $sala;
        $this->candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->orderBy('id')
            ->get();
    }

    public function title(): string
    {
        return 'Pauta';
    }

    public function array(): array
    {
        $rows = [];

        // Linha 1 — espaço para logo
        $rows[] = ['', '', ''];

        // Cabeçalho
        $rows[] = ['INSTITUTO SUPERIOR POLITÉCNICO DO BIÉ', '', ''];
        $rows[] = ['DEPARTAMENTO DOS ASSUNTOS ACADÉMICOS', '', ''];
        $rows[] = ['EXAME DE ACESSO 2026/2027 — PAUTA', '', ''];

        // Linha 5 — vazia
        $rows[] = ['', '', ''];

        // Info da sala
        $grupos = $this->candidaturas
            ->groupBy(fn($c) => $c->curso . ' — ' . ($c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular'))
            ->keys()->implode(' / ');

        $rows[] = ['Sala: ' . $this->sala->nome, '', ''];
        $rows[] = ['Curso(s) / Período: ' . $grupos, '', ''];

        $dataHorario = '';
        if ($this->sala->data_exame) {
            $dataHorario .= $this->sala->data_exame->format('d/m/Y');
        }
        if ($this->sala->horario) {
            $dataHorario .= ($dataHorario ? '  |  ' : '') . $this->sala->horario . 'h';
        }
        $rows[] = $dataHorario ? ['Data / Horário: ' . $dataHorario, '', ''] : ['', '', ''];

        // Linha 9 — vazia
        $rows[] = ['', '', ''];

        // Linha 10 — cabeçalho da tabela (4 colunas: Código, [OCULTO], Nota, Nota Jovem)
        $rows[] = ['CÓDIGO', 'NOME COMPLETO', 'NOTA (0–20)', 'NOTA JOVEM'];

        // Dados — CÓDIGO + NOTA (nome oculto via coluna width) + campo adicional para "Nota Jovem"
        foreach ($this->candidaturas as $c) {
            $rows[] = [
                $c->codigo_exame ?? 'NÃO GERADO',
                '',  // Nome totalmente vazio no lançamento
                $c->nota_exame !== null ? number_format($c->nota_exame, 1) : '',  // Nota lançada (se existir)
                '',  // Nota Jovem (campo adicional)
            ];
        }

        // Assinatura
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
        // Match presidência proportions but hide name (B small): Código(7), Nome(65 -> hidden 0.1), Nota(23), Nota Jovem(15)
        return ['A' => 7, 'B' => 0.1, 'C' => 23, 'D' => 15];
    }

    public function styles(Worksheet $sheet): array
    {
        $tr      = $this->tableRow;
        $dataEnd = $tr + $this->candidaturas->count();
        $sigLinha = $dataEnd + 4;
        $sigNome  = $sigLinha + 1;
        $sigCargo = $sigLinha + 2;

        // Mesclar cabeçalho A:D
        $sheet->mergeCells('A2:D2');
        $sheet->mergeCells('A3:D3');
        $sheet->mergeCells('A4:D4');
        $sheet->mergeCells('A6:D6');
        $sheet->mergeCells('A7:D7');
        $sheet->mergeCells('A8:D8');
        $sheet->mergeCells("A{$sigLinha}:D{$sigLinha}");
        $sheet->mergeCells("A{$sigNome}:D{$sigNome}");
        $sheet->mergeCells("A{$sigCargo}:D{$sigCargo}");

        // Alturas
        $sheet->getRowDimension(1)->setRowHeight(55);
        $sheet->getRowDimension(2)->setRowHeight(22);
        $sheet->getRowDimension(3)->setRowHeight(16);
        $sheet->getRowDimension(4)->setRowHeight(18);
        $sheet->getRowDimension(5)->setRowHeight(8);
        $sheet->getRowDimension(9)->setRowHeight(8);
        $sheet->getRowDimension($tr)->setRowHeight(22);

        // Estilos cabeçalho
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
        $sheet->getStyle('A6:A8')->applyFromArray(['font' => ['bold' => true, 'size' => 10]]);

        // Cabeçalho da tabela (verde)
        $sheet->getStyle("A{$tr}:D{$tr}")->applyFromArray([
            'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0E5C2F']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FFFFFF']]],
        ]);

        // Linhas de dados
        for ($r = $tr + 1; $r <= $dataEnd; $r++) {
            $bg = ($r % 2 === 0) ? 'EDF7F1' : 'FFFFFF';
            $sheet->getStyle("A{$r}:D{$r}")->applyFromArray([
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $bg]],
                'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'CCCCCC']]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);
            $sheet->getStyle("A{$r}")->applyFromArray([
                'font'      => ['bold' => true, 'color' => ['rgb' => '0E5C2F']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
            $sheet->getStyle("C{$r}")->applyFromArray([
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
            $sheet->getStyle("D{$r}")->applyFromArray([
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
            $sheet->getRowDimension($r)->setRowHeight(22);
        }

        // Assinatura
        $sheet->getStyle("A{$sigLinha}")->applyFromArray([
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getRowDimension($sigLinha)->setRowHeight(18);
        $sheet->getStyle("A{$sigNome}")->applyFromArray([
            'font'      => ['bold' => true, 'size' => 10],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle("A{$sigCargo}")->applyFromArray([
            'font'      => ['size' => 9, 'italic' => true],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

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
        // Repete a linha do cabeçalho da tabela em todas as páginas impressas.
        $ps->setRowsToRepeatAtTopByStartAndEnd($tr, $tr);
        $ps->setPrintArea("A1:D{$sigCargo}");

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
        $displayH = 55;
        $displayW = (int)($logoW * $displayH / $logoH);

        // Center calculation from B1: use character widths (approx 8px per char)
        // Columns: A(7), B(0.1), C(23), D(15)
        $centerFromB1 = (int)(((7 + 0.1 + 23 + 15) * 8 / 2) - (7 * 8));
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
