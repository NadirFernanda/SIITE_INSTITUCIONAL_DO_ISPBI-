<?php

namespace App\Exports;

use App\Models\Sala;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

/**
 * Ver App\Exports\SalasExameExportLote — mesma ideia, mas usando a variante
 * de exportação própria do perfil Lançamento (SalaExameExportLancamento).
 */
class SalasExameExportLoteLancamento implements WithMultipleSheets
{
    protected Collection $salas;
    protected ?string $cursoFiltro;

    public function __construct(Collection $salas, ?string $cursoFiltro = null)
    {
        $this->salas = $salas;
        $this->cursoFiltro = $cursoFiltro;
    }

    public function sheets(): array
    {
        return $this->salas
            ->map(fn(Sala $sala) => new SalaExameExportLancamento($sala, $this->cursoFiltro))
            ->all();
    }
}
