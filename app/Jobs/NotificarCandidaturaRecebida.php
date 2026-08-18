<?php

namespace App\Jobs;

use App\Mail\CandidaturaReceived;
use App\Models\Candidatura;
use App\Services\WhatsAppService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NotificarCandidaturaRecebida implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $candidatura;

    public function __construct(Candidatura $candidatura)
    {
        $this->candidatura = $candidatura;
    }

    public function handle()
    {
        try {
            Mail::to('geral@isp-bie.ao')->send(new CandidaturaReceived($this->candidatura));
        } catch (\Throwable $e) {
            \Log::error('Falha ao enviar email de candidatura: ' . $e->getMessage());
        }

        try {
            if (app(WhatsAppService::class)->notificarCandidaturaRecebida($this->candidatura)) {
                $this->candidatura->forceFill([
                    'whatsapp_recebida_enviado_at' => now(),
                    'whatsapp_recebida_falhou_em'  => null,
                ])->save();
            } else {
                $this->candidatura->forceFill(['whatsapp_recebida_falhou_em' => now()])->save();
            }
        } catch (\Throwable $e) {
            \Log::error('WhatsApp candidatura recebida: ' . $e->getMessage());
            $this->candidatura->forceFill(['whatsapp_recebida_falhou_em' => now()])->save();
        }
    }
}
