<?php

namespace App\Console\Commands;

use App\Models\Candidatura;
use App\Models\CandidaturaNota;
use App\Models\SalaDiscipline;
use Illuminate\Console\Command;

class RecalcularNotasDisciplinas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:recalcular-notas-disciplinas {--dry-run : Mostra o que mudaria sem gravar nada}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalcula nota_exame (soma das disciplinas) para candidaturas com notas por disciplina completas — corrige registos gravados com a fórmula antiga (média ponderada), que produzia valores errados como 0.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');

        // Só interessam candidaturas cuja sala tem disciplinas definidas
        $salaIds = SalaDiscipline::distinct()->pluck('sala_id');

        $candidaturas = Candidatura::whereIn('sala_id', $salaIds)->get();

        $corrigidas = 0;
        $inalteradas = 0;
        $incompletas = 0;

        foreach ($candidaturas as $candidatura) {
            $salaDiscs = SalaDiscipline::where('sala_id', $candidatura->sala_id)->get();
            if ($salaDiscs->isEmpty()) {
                continue;
            }

            $sum = 0.0;
            $complete = true;
            foreach ($salaDiscs as $sd) {
                $notaRow = CandidaturaNota::where('candidatura_id', $candidatura->id)
                    ->where('discipline', $sd->discipline)
                    ->first();
                if (! $notaRow || $notaRow->nota === null) {
                    $complete = false;
                    break;
                }
                $sum += (float) $notaRow->nota;
            }

            if (! $complete) {
                $incompletas++;
                continue;
            }

            $final = round($sum, 2);

            if ((float) $candidatura->nota_exame === $final) {
                $inalteradas++;
                continue;
            }

            $this->line(sprintf(
                'Ficha #%05d — %s: %s -> %s',
                $candidatura->id,
                $candidatura->nome,
                $candidatura->nota_exame === null ? '(vazio)' : number_format((float) $candidatura->nota_exame, 2),
                number_format($final, 2)
            ));

            if (! $dryRun) {
                $candidatura->update(['nota_exame' => $final]);
            }

            $corrigidas++;
        }

        $this->newLine();
        $this->info(($dryRun ? '[SIMULAÇÃO] ' : '') . "Corrigidas: {$corrigidas} | Já correctas: {$inalteradas} | Incompletas (ignoradas): {$incompletas}");

        return self::SUCCESS;
    }
}
