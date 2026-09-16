<?php

namespace App\Services;

use App\Models\Candidatura;
use Illuminate\Support\Collection;

class RelatorioCandidaturasService
{
    private const PERIODOS = [
        'regular' => 'Regular',
        'pos-laboral' => 'Pós-Laboral',
    ];

    public function estatisticas(): array
    {
        $concluidas = Candidatura::query()->where('status', 'concluida');

        return [
            'total' => (clone $concluidas)->count(),
            'blocos' => [
                'Sexo' => $this->agrupar($concluidas, 'sexo', [
                    'feminino' => 'Feminino',
                    'masculino' => 'Masculino',
                ]),
                'Faixa Etária' => $this->agruparFaixas($concluidas),
                'Curso' => $this->agrupar($concluidas, 'curso', array_combine(Candidatura::$cursos, Candidatura::$cursos)),
                'Província' => $this->agruparDinamico($concluidas, 'naturalidade_provincia'),
                'Necessidade de Ed. Especial' => $this->agrupar($concluidas, 'necessidade_especial', [
                    'Nenhuma' => 'Nenhuma',
                    'Filhos de antigos combatentes' => 'Filhos de antigos combatentes',
                    'Áreas Steam' => 'Áreas Steam',
                    'Portadores de deficiência' => 'Portadores de deficiência',
                ]),
                'Est. Financeiro' => $this->agrupar($concluidas, 'estado_financeiro', [
                    'maximo' => 'Máximo',
                    'medio' => 'Médio',
                    'minimo' => 'Mínimo',
                ]),
                'Trabalhador' => $this->agrupar($concluidas, 'trabalhador', [
                    '0' => 'Não',
                    '1' => 'Sim',
                ]),
                'Estado' => $this->agrupar(
                    Candidatura::query(),
                    'status',
                    Candidatura::$statusLabels
                ),
            ],
        ];
    }

    private function agrupar($query, string $campo, array $labels): array
    {
        $query = clone $query;
        $rows = $query
            ->selectRaw("{$campo}, periodo, COUNT(*) AS total")
            ->groupBy($campo, 'periodo')
            ->get();

        return $this->formatar($rows, $campo, $labels);
    }

    private function agruparDinamico($query, string $campo): array
    {
        $query = clone $query;
        $rows = $query
            ->selectRaw("{$campo}, periodo, COUNT(*) AS total")
            ->whereNotNull($campo)
            ->groupBy($campo, 'periodo')
            ->orderBy($campo)
            ->get();

        $labels = $rows->pluck($campo)->unique()->mapWithKeys(fn ($label) => [(string) $label => (string) $label])->all();
        return $this->formatar($rows, $campo, $labels);
    }

    private function agruparFaixas($query): array
    {
        $rows = (clone $query)->select('data_nascimento', 'periodo')->whereNotNull('data_nascimento')->get();
        $contagens = [];

        foreach ($rows as $candidatura) {
            $faixa = $candidatura->faixa_etaria;
            if ($faixa === null && $candidatura->idade !== null && $candidatura->idade < 17) {
                $faixa = 'menor-17';
            }
            if ($faixa !== null) {
                $contagens[$faixa][$candidatura->periodo] = ($contagens[$faixa][$candidatura->periodo] ?? 0) + 1;
            }
        }

        $labels = Candidatura::$faixasEtarias + ['menor-17' => 'Menores de 17 anos'];
        return $this->formatarContagens($contagens, $labels);
    }

    private function formatar(Collection $rows, string $campo, array $labels): array
    {
        $contagens = [];
        foreach ($rows as $row) {
            $chave = $campo === 'trabalhador'
                ? ($row->{$campo} ? '1' : '0')
                : (string) $row->{$campo};
            $contagens[$chave][$row->periodo] = (int) $row->total;
        }

        return $this->formatarContagens($contagens, $labels);
    }

    private function formatarContagens(array $contagens, array $labels): array
    {
        $resultado = [];
        foreach ($labels as $chave => $label) {
            $regular = $contagens[(string) $chave]['regular'] ?? 0;
            $posLaboral = $contagens[(string) $chave]['pos-laboral'] ?? 0;
            $resultado[] = [
                'label' => $label,
                'regular' => $regular,
                'pos-laboral' => $posLaboral,
                'total' => $regular + $posLaboral,
            ];
        }

        return $resultado;
    }

    public static function periodos(): array
    {
        return self::PERIODOS;
    }
}
