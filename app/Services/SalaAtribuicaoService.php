<?php

namespace App\Services;

use App\Models\Candidatura;
use App\Models\Sala;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SalaAtribuicaoService
{
    public function atribuirManual(Candidatura $candidatura, Sala $sala): int
    {
        return DB::transaction(function () use ($candidatura, $sala) {
            $sala = Sala::whereKey($sala->id)->lockForUpdate()->firstOrFail();
            $candidatura = Candidatura::whereKey($candidatura->id)->lockForUpdate()->firstOrFail();

            if (! $candidatura->pagamento_confirmado || $candidatura->status === 'rejeitada') {
                throw ValidationException::withMessages([
                    'candidatura' => 'Só é possível atribuir uma candidatura não rejeitada com pagamento confirmado.',
                ]);
            }

            $lugaresOcupados = DB::table('candidaturas')
                ->where('sala_id', $sala->id)
                ->where('id', '!=', $candidatura->id)
                ->whereNotNull('numero_lugar')
                ->pluck('numero_lugar')
                ->map(fn ($lugar) => (int) $lugar)
                ->all();

            $lugares = array_fill_keys($lugaresOcupados, true);
            $numeroLugar = 1;
            while ($numeroLugar <= $sala->capacidade && isset($lugares[$numeroLugar])) {
                $numeroLugar++;
            }

            if ($numeroLugar > $sala->capacidade) {
                $numeroLugar = $sala->capacidade + 1;
                while (isset($lugares[$numeroLugar])) {
                    $numeroLugar++;
                }
            }

            $candidatura->forceFill([
                'sala_id' => $sala->id,
                'numero_lugar' => $numeroLugar,
            ])->save();

            return $numeroLugar;
        });
    }

    public function eliminarSala(Sala $sala): void
    {
        DB::transaction(function () use ($sala) {
            $sala = Sala::whereKey($sala->id)->lockForUpdate()->firstOrFail();
            Candidatura::withTrashed()
                ->where('sala_id', $sala->id)
                ->orderBy('id')
                ->lockForUpdate()
                ->get()
                ->each(fn (Candidatura $candidatura) => $candidatura
                    ->forceFill(['sala_id' => null, 'numero_lugar' => null])
                    ->save());

            $sala->delete();
        });
    }

    public function limparTodas(): int
    {
        return DB::transaction(function () {
            Sala::orderBy('id')->lockForUpdate()->get(['id']);

            $candidaturas = Candidatura::withTrashed()
                ->whereNotNull('sala_id')
                ->orderBy('id')
                ->lockForUpdate()
                ->get();

            foreach ($candidaturas as $candidatura) {
                $candidatura->forceFill(['sala_id' => null, 'numero_lugar' => null])->save();
            }

            return $candidaturas->count();
        });
    }
}
