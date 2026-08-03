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
        {--confirmar : Obrigatório para enviar a sério — sem isto, o comando só simula}
        {--limite=5 : Máximo de candidaturas a processar nesta execução (evita rajadas grandes)}
        {--pausa=45 : Segundos mínimos de pausa entre cada envio (com variação aleatória) para reduzir o risco de bloqueio pelo WhatsApp}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia por WhatsApp o comprovativo a candidaturas já assinadas pelo DAAC que nunca o receberam. Envios em massa por ferramentas não oficiais como o Evolution API podem levar o WhatsApp a restringir/bloquear temporariamente o número — este comando processa em pequenos lotes espaçados para reduzir esse risco, mas NUNCA elimina o risco por completo.';

    public function handle(WhatsAppService $whatsapp): int
    {
        $dryRun    = (bool) $this->option('dry-run');
        $confirmar = (bool) $this->option('confirmar');
        $limite    = max(1, (int) $this->option('limite'));
        $pausaMin  = max(10, (int) $this->option('pausa'));

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

        if (! $confirmar) {
            $this->warn('Nada foi enviado. Isto é uma simulação de segurança — repita o comando com --confirmar para enviar a sério.');
            $this->line('Envios em massa arriscam bloqueio do WhatsApp. Confirme que a ligação está estável e que não houve nenhuma restrição recente antes de continuar.');
            return self::SUCCESS;
        }

        $lote = $pendentes->take($limite);

        if ($lote->count() < $pendentes->count()) {
            $this->warn("A processar apenas {$lote->count()} de {$pendentes->count()} pendentes nesta execução (--limite={$limite}). Corra o comando novamente mais tarde para continuar o resto — não aumente o limite só para despachar tudo de uma vez.");
        }

        $sucesso = 0;
        $falha = 0;
        $bar = $this->output->createProgressBar($lote->count());
        $bar->start();

        foreach ($lote as $i => $c) {
            if ($whatsapp->enviarComprovativo($c)) {
                $sucesso++;
            } else {
                $falha++;
            }
            $bar->advance();

            if ($i < $lote->count() - 1) {
                // Pausa com variação aleatória (não um intervalo fixo) para não parecer um script.
                sleep(random_int($pausaMin, (int) round($pausaMin * 1.6)));
            }
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("Enviados com sucesso: {$sucesso} | Falharam: {$falha}");

        if ($falha > 0) {
            $this->warn('As candidaturas que falharam ficam marcadas em "whatsapp_comprovativo_falhou_em" e aparecem no painel DAAC em "Comprovativo não enviado" para reenvio manual.');
            $this->warn('Se TODAS falharam com o mesmo erro, pare e verifique a ligação do WhatsApp/Evolution API antes de tentar de novo — não repita o comando às cegas.');
        }

        return self::SUCCESS;
    }
}
