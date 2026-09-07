<?php

namespace App\Exports;

use App\Models\Sala;
use App\Models\Candidatura;
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
        return $this->salas->flatMap(function (Sala $sala) {
            $query = $sala->candidaturas()->where('pagamento_confirmado', true);
            if ($this->cursoFiltro !== null) {
                $query->whereRaw('LOWER(TRIM(curso)) = LOWER(?)', [trim($this->cursoFiltro)]);
            }
            if ($this->periodoFiltro !== null) {
                $query->where('periodo', $this->periodoFiltro);
            }
            $candidaturas = $query->get();
            $categorias = $candidaturas
                ->filter(fn ($c) => $this->categoriaPermitida($c))
                ->pluck('necessidade_especial')
                ->unique(fn ($cat) => mb_strtolower(trim((string) $cat), 'UTF-8'))
                ->values();

            $folhas = [new SalaNotasExport($sala, $this->cursoFiltro, $this->periodoFiltro, null, true)];
            foreach ($categorias as $categoria) {
                $folhas[] = new SalaNotasExport($sala, $this->cursoFiltro, $this->periodoFiltro, $categoria, false);
            }
            return $folhas;
        })->all();
    }

    private function categoriaPermitida($candidatura): bool
    {
        return Candidatura::categoriaEspecialAplicavel(
            $candidatura->necessidade_especial,
            $candidatura->curso,
            $candidatura->sexo
        );
    }
}
