<?php

namespace App\Console\Commands;

use App\Models\Candidatura;
use App\Services\WhatsAppService;
use Illuminate\Console\Command;

class ReenviarNotificacoesPendentes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reenviar-notificacoes-pendentes
        {tipo : recebida (candidatura recebida) ou pagamento (pagamento confirmado)}
        {--dry-run : Mostra quem receberia a mensagem sem enviar nada}
        {--confirmar : Obrigatório para enviar a sério — sem isto, o comando só simula}
        {--limite=5 : Máximo de candidaturas a processar nesta execução (evita rajadas grandes)}
        {--pausa=45 : Segundos mínimos de pausa entre cada envio (com variação aleatória) para reduzir o risco de bloqueio pelo WhatsApp}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reenvia por WhatsApp a mensagem de "candidatura recebida" ou "pagamento confirmado" a quem nunca a recebeu. Mesmas precauções anti-spam do comando de comprovativos: lotes pequenos, pausas longas e variáveis, exige --confirmar.';

    public function handle(WhatsAppService $whatsapp): int
    {
        $tipo      = $this->argument('tipo');
        $dryRun    = (bool) $this->option('dry-run');
        $confirmar = (bool) $this->option('confirmar');
        $limite    = max(1, (int) $this->option('limite'));
        $pausaMin  = max(10, (int) $this->option('pausa'));

        if (! in_array($tipo, ['recebida', 'pagamento'], true)) {
            $this->error("Tipo inválido: {$tipo}. Use 'recebida' ou 'pagamento'.");
            return self::FAILURE;
        }

        if ($tipo === 'recebida') {
            $pendentes = Candidatura::whereNull('whatsapp_recebida_enviado_at')
                ->whereNotNull('telefone')
                ->orderBy('id')->get();
            $enviarFn = fn ($c) => $whatsapp->notificarCandidaturaRecebida($c);
            $campoEnviado = 'whatsapp_recebida_enviado_at';
            $campoFalhou  = 'whatsapp_recebida_falhou_em';
            $rotulo = 'candidatura recebida';
        } else {
            $pendentes = Candidatura::where('pagamento_confirmado', true)
                ->whereNull('whatsapp_pagamento_enviado_at')
                ->whereNotNull('telefone')
                ->orderBy('id')->get();
            $enviarFn = fn ($c) => $whatsapp->notificarPagamentoConfirmado($c);
            $campoEnviado = 'whatsapp_pagamento_enviado_at';
            $campoFalhou  = 'whatsapp_pagamento_falhou_em';
            $rotulo = 'pagamento confirmado';
        }

        $this->info(($dryRun ? '[SIMULAÇÃO] ' : '') . "Candidaturas sem mensagem de \"{$rotulo}\" enviada: {$pendentes->count()}");

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
            $this->warn("A processar apenas {$lote->count()} de {$pendentes->count()} pendentes nesta execução (--limite={$limite}). Corra o comando novamente mais tarde para continuar o resto.");
        }

        $sucesso = 0;
        $falha = 0;
        $bar = $this->output->createProgressBar($lote->count());
        $bar->start();

        foreach ($lote as $i => $c) {
            if ($enviarFn($c)) {
                $c->forceFill([$campoEnviado => now(), $campoFalhou => null])->save();
                $sucesso++;
            } else {
                $c->forceFill([$campoFalhou => now()])->save();
                $falha++;
            }
            $bar->advance();

            if ($i < $lote->count() - 1) {
                sleep(random_int($pausaMin, (int) round($pausaMin * 1.6)));
            }
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("Enviados com sucesso: {$sucesso} | Falharam: {$falha}");

        return self::SUCCESS;
    }
}
