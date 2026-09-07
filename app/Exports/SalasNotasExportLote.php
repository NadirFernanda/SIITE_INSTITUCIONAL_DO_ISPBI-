<?php

namespace App\Exports;

use App\Models\Sala;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

/**
 * Combina a Pauta (notas) de várias salas num único ficheiro Excel (uma folha
 * por sala) — usado para imprimir todas as salas de um horário de uma só vez.
 * Só a presidência (e o admin) têm acesso a esta pauta.
 */
class SalasNotasExportLote implements WithMultipleSheets
{
    protected Collection $salas;
    protected ?string $cursoFiltro;
    protected ?string $periodoFiltro;

    public function __construct(Collection $salas, ?string $cursoFiltro = null, ?string $periodoFiltro = null)
    {
        $this->salas       = $salas;
        $this->cursoFiltro = $cursoFiltro;
        $this->periodoFiltro = $periodoFiltro;
    }

    public function sheets(): array
    {
        return $this->salas
            ->map(fn(Sala $sala) => new SalaNotasExport($sala, $this->cursoFiltro, $this->periodoFiltro))
            ->all();
    }
}
