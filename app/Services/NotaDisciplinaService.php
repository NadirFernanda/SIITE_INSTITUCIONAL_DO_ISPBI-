<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\Candidatura;
use App\Models\CandidaturaNota;
use App\Models\Sala;
use App\Models\SalaDiscipline;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class NotaDisciplinaService
{
    public function actualizarDisciplinas(Sala $sala, array $disciplinas, ?int $utilizadorId = null): void
    {
        $utilizadorId ??= Auth::id();
        $disciplinas = collect($disciplinas)
            ->map(fn ($disciplina) => [
                'discipline' => trim((string) $disciplina['discipline']),
                'weight_percent' => (int) $disciplina['weight'],
            ])
            ->filter(fn ($disciplina) => $disciplina['discipline'] !== '')
            ->values();

        if ($disciplinas->pluck('discipline')->duplicates()->isNotEmpty()) {
            throw ValidationException::withMessages([
                'disciplines' => 'Cada disciplina só pode aparecer uma vez.',
            ]);
        }

        if ($disciplinas->contains(fn ($disciplina) => $disciplina['weight_percent'] < 0 || $disciplina['weight_percent'] > 100)) {
            throw ValidationException::withMessages([
                'disciplines' => 'O peso de cada disciplina deve estar entre 0% e 100%.',
            ]);
        }

        if ($disciplinas->isNotEmpty() && $disciplinas->sum('weight_percent') !== 100) {
            throw ValidationException::withMessages([
                'disciplines' => 'A soma dos pesos das disciplinas deve ser exactamente 100%.',
            ]);
        }

        DB::transaction(function () use ($sala, $disciplinas, $utilizadorId) {
            $sala = Sala::query()->lockForUpdate()->findOrFail($sala->id);
            $anteriores = SalaDiscipline::where('sala_id', $sala->id)->orderBy('id')->get();
            $candidaturas = Candidatura::where('sala_id', $sala->id)->orderBy('id')->lockForUpdate()->get();
            $nomesSolicitados = $disciplinas->pluck('discipline');
            $notas = CandidaturaNota::whereIn('candidatura_id', $candidaturas->modelKeys())
                ->whereIn('discipline', $anteriores->pluck('discipline')->merge($nomesSolicitados))
                ->get()
                ->groupBy('candidatura_id');

            foreach ($disciplinas as $disciplina) {
                $maximo = round(20 * $disciplina['weight_percent'] / 100, 2);
                foreach ($notas as $notasDaCandidatura) {
                    $nota = $notasDaCandidatura->firstWhere('discipline', $disciplina['discipline'])?->nota;
                    if ($nota !== null && (float) $nota > $maximo) {
                        throw ValidationException::withMessages([
                            'disciplines' => "O novo peso de {$disciplina['discipline']} não comporta todas as notas já lançadas (máximo {$maximo}).",
                        ]);
                    }
                }
            }

            $notasFinaisDerivadas = [];
            foreach ($candidaturas as $candidatura) {
                if ($anteriores->isEmpty() || $candidatura->nota_exame === null) {
                    continue;
                }

                $notasDaCandidatura = $notas->get($candidatura->id, collect())->keyBy('discipline');
                $somaAnterior = 0.0;
                $completa = true;

                foreach ($anteriores as $disciplina) {
                    $nota = $notasDaCandidatura->get($disciplina->discipline)?->nota;
                    if ($nota === null) {
                        $completa = false;
                        break;
                    }
                    $somaAnterior += (float) $nota;
                }

                if ($completa && round($somaAnterior, 2) === round((float) $candidatura->nota_exame, 2)) {
                    $notasFinaisDerivadas[$candidatura->id] = $candidatura;
                }
            }

            foreach ($disciplinas as $disciplina) {
                SalaDiscipline::updateOrCreate(
                    ['sala_id' => $sala->id, 'discipline' => $disciplina['discipline']],
                    ['weight_percent' => $disciplina['weight_percent']]
                );
            }

            $nomesActuais = $disciplinas->pluck('discipline');
            SalaDiscipline::where('sala_id', $sala->id)
                ->whereNotIn('discipline', $nomesActuais)
                ->delete();

            $actuais = SalaDiscipline::where('sala_id', $sala->id)->orderBy('id')->get();
            $notasActuais = CandidaturaNota::whereIn('candidatura_id', array_keys($notasFinaisDerivadas))
                ->whereIn('discipline', $actuais->pluck('discipline'))
                ->get()
                ->groupBy('candidatura_id');

            foreach ($notasFinaisDerivadas as $candidatura) {
                $notasDaCandidatura = $notasActuais->get($candidatura->id, collect())->keyBy('discipline');
                $soma = 0.0;
                $completa = $actuais->isNotEmpty();

                foreach ($actuais as $disciplina) {
                    $nota = $notasDaCandidatura->get($disciplina->discipline)?->nota;
                    if ($nota === null) {
                        $completa = false;
                        break;
                    }
                    $soma += (float) $nota;
                }

                $candidatura->forceFill([
                    'nota_exame' => $completa ? round($soma, 2) : null,
                    'nota_lancada_por' => $completa ? $utilizadorId : null,
                    'nota_lancada_em' => $completa ? now() : null,
                ])->save();
            }
        });
    }

    public function lancarNotas(Candidatura $candidatura, array $notas, ?int $utilizadorId = null): ?float
    {
        return DB::transaction(function () use ($candidatura, $notas, $utilizadorId) {
            $candidatura = Candidatura::query()->lockForUpdate()->findOrFail($candidatura->id);
            if (! $candidatura->sala_id) {
                throw ValidationException::withMessages(['notas' => 'A candidatura não está atribuída a uma sala.']);
            }

            Sala::query()->lockForUpdate()->findOrFail($candidatura->sala_id);
            $disciplinas = SalaDiscipline::where('sala_id', $candidatura->sala_id)->get()->keyBy('discipline');
            if ($disciplinas->isEmpty()) {
                throw ValidationException::withMessages(['notas' => 'A sala não tem disciplinas configuradas.']);
            }

            $notasNormalizadas = [];
            foreach ($notas as $nome => $valor) {
                $nome = trim((string) $nome);
                if (array_key_exists($nome, $notasNormalizadas)) {
                    throw ValidationException::withMessages([
                        'notas' => 'A lista contém disciplinas repetidas.',
                    ]);
                }
                $notasNormalizadas[$nome] = $valor;
            }

            $desconhecidas = array_diff(array_keys($notasNormalizadas), $disciplinas->keys()->all());
            if ($desconhecidas !== []) {
                throw ValidationException::withMessages([
                    'notas' => 'Não é possível lançar notas para disciplinas que não estão configuradas nesta sala.',
                ]);
            }

            foreach ($notasNormalizadas as $nome => $valor) {
                $disciplina = $disciplinas->get($nome);
                $maximo = round(20 * ((int) $disciplina->weight_percent) / 100, 2);

                if ($valor === null || $valor === '') {
                    CandidaturaNota::where('candidatura_id', $candidatura->id)
                        ->where('discipline', $nome)
                        ->delete();
                    continue;
                }

                validator(['nota' => $valor], [
                    'nota' => ['required', 'numeric', 'min:0', 'max:'.$maximo],
                ], [
                    'nota.max' => "A nota de \"{$nome}\" não pode exceder {$maximo} valores (peso desta disciplina).",
                ])->validate();

                $nota = round((float) $valor, 2);
                CandidaturaNota::updateOrCreate(
                    ['candidatura_id' => $candidatura->id, 'discipline' => $nome],
                    ['nota' => $nota, 'lancada_por' => $utilizadorId, 'lancada_em' => now()]
                );

                AuditLog::registar('lancou_nota_disciplina', 'candidatura', $candidatura->id,
                    "Ficha #{$candidatura->id} — {$candidatura->nome} | Disciplina: {$nome} | Nota: {$nota}");
            }

            $notasGuardadas = CandidaturaNota::where('candidatura_id', $candidatura->id)
                ->whereIn('discipline', $disciplinas->keys())
                ->get()
                ->keyBy('discipline');
            $soma = 0.0;
            $completa = true;

            foreach ($disciplinas as $disciplina) {
                $nota = $notasGuardadas->get($disciplina->discipline)?->nota;
                if ($nota === null) {
                    $completa = false;
                    break;
                }
                $soma += (float) $nota;
            }

            $final = $completa ? round($soma, 2) : null;
            $candidatura->forceFill([
                'nota_exame' => $final,
                'nota_lancada_por' => $final !== null ? $utilizadorId : null,
                'nota_lancada_em' => $final !== null ? now() : null,
            ])->save();

            if ($final !== null) {
                AuditLog::registar('calculou_soma_disciplinas', 'candidatura', $candidatura->id,
                    "Ficha #{$candidatura->id} — soma das disciplinas calculada: {$final}");
            }

            return $final;
        });
    }
}
