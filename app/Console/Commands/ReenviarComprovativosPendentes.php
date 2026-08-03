<?php

namespace App\Console\Commands;

use App\Models\Candidatura;
use App\Services\WhatsAppService;
use Illuminate\Console\Command;

class ReenviarComprovativosPendentes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reenviar-comprovativos-pendentes
        {--dry-run : Mostra quem receberia o comprovativo sem enviar nada}
        {--pausa=2 : Segundos de pausa entre cada envio, para não ser bloqueado pelo WhatsApp}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia por WhatsApp o comprovativo a candidaturas já assinadas pelo DAAC que nunca o receberam (tentativa falhada ou nunca sequer tentada — ex.: assinadas antes desta funcionalidade existir).';

    public function handle(WhatsAppService $whatsapp): int
    {
        $dryRun = (bool) $this->option('dry-run');
        $pausa  = max(0, (int) $this->option('pausa'));

        $pendentes = Candidatura::whereNotNull('assinado_em')
            ->whereNull('whatsapp_comprovativo_enviado_at')
            ->whereNotNull('telefone')
            ->orderBy('id')
            ->get();

        $this->info(($dryRun ? '[SIMULAÇÃO] ' : '') . "Candidaturas assinadas sem comprovativo enviado: {$pendentes->count()}");

        if ($pendentes->isEmpty()) {
            return self::SUCCESS;
        }

        if ($dryRun) {
            foreach ($pendentes as $c) {
                $this->line(sprintf('#%05d — %s (%s) — %s', $c->id, $c->nome, $c->curso, $c->telefone));
            }
            return self::SUCCESS;
        }

        $sucesso = 0;
        $falha = 0;
        $bar = $this->output->createProgressBar($pendentes->count());
        $bar->start();

        foreach ($pendentes as $c) {
            if ($whatsapp->enviarComprovativo($c)) {
                $sucesso++;
            } else {
                $falha++;
            }
            $bar->advance();

            if ($pausa > 0) {
                sleep($pausa);
            }
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("Enviados com sucesso: {$sucesso} | Falharam: {$falha}");

        if ($falha > 0) {
            $this->warn('As candidaturas que falharam ficam marcadas em "whatsapp_comprovativo_falhou_em" e aparecem no painel DAAC em "Comprovativo não enviado" para reenvio manual.');
        }

        return self::SUCCESS;
    }
}
