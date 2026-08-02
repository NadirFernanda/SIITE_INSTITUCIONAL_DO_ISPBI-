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

    public function __construct(Collection $salas)
    {
        $this->salas = $salas;
    }

    public function sheets(): array
    {
        return $this->salas->map(fn(Sala $sala) => new SalaExameExportLancamento($sala))->all();
    }
}
