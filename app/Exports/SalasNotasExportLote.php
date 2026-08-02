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

    public function __construct(Collection $salas)
    {
        $this->salas = $salas;
    }

    public function sheets(): array
    {
        return $this->salas->map(fn(Sala $sala) => new SalaNotasExport($sala))->all();
    }
}
