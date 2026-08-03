<?php

namespace App\Jobs;

use App\Models\Candidatura;
use App\Services\WhatsAppService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyWhatsAppAssinatura implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $candidatura;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Candidatura $candidatura)
    {
        $this->candidatura = $candidatura;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            app(WhatsAppService::class)->notificarAssinaturaDAAC($this->candidatura);
        } catch (\Throwable $e) {
            \Log::error('Erro na job NotifyWhatsAppAssinatura: ' . $e->getMessage());
        }

        try {
            app(WhatsAppService::class)->enviarComprovativo($this->candidatura);
        } catch (\Throwable $e) {
            \Log::error('Erro ao enviar comprovativo via WhatsApp após assinatura: ' . $e->getMessage());
            $this->candidatura->forceFill(['whatsapp_comprovativo_falhou_em' => now()])->save();
        }
    }
}
