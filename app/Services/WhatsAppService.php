<?php

namespace App\Services;

use App\Models\Candidatura;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    private string $baseUrl = '';
    private string $apiKey = '';
    private string $instance = '';
    private bool   $enabled = false;

    public function __construct()
    {
        $this->baseUrl  = rtrim(config('services.evolution.url', ''), '/');
        $this->apiKey   = config('services.evolution.key', '');
        $this->instance = config('services.evolution.instance', '');
        $this->enabled  = (bool) config('services.evolution.enabled', false);
    }

    public function enviar(string $telefone, string $mensagem): bool
    {
        if (! $this->enabled || ! $this->baseUrl || ! $this->apiKey || ! $this->instance) {
            return false;
        }

        $numero = $this->normalizarTelefone($telefone);
        if (! $numero) {
            return false;
        }

        try {
            $response = Http::timeout(10)
                ->withHeaders([
                    'apikey' => $this->apiKey,
                    'Content-Type' => 'application/json',
                ])
                ->post(
                    "{$this->baseUrl}/message/sendText/" . rawurlencode($this->instance),
                    [
                        'number' => $numero,
                        'text'   => $mensagem,
                    ]
                );

            Log::info('Evolution WhatsApp resposta', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            if (! $response->successful()) {
                Log::error("WhatsApp: resposta inválida ao enviar para {$numero}", [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return false;
            }

            return true;
        } catch (\Throwable $e) {
            Log::error("WhatsApp: falha ao enviar para {$numero} — " . $e->getMessage());
            return false;
        }
    }

    // ── Mensagens predefinidas ──────────────────────────────────────────────

    public function notificarCandidaturaRecebida(Candidatura $c): void
    {
        $ficha = str_pad($c->id, 5, '0', STR_PAD_LEFT);
        $this->enviar($c->telefone,
            "✅ *ISP-Bié — Candidatura Recebida*\n\n" .
            "Olá *{$c->nome}*,\n" .
            "A sua ficha de inscrição foi registada com sucesso.\n\n" .
            "📋 *Nº de Ficha:* {$ficha}\n" .
            "📚 *Curso:* {$c->curso}\n" .
            "🕐 *Período:* " . ucfirst(str_replace('-', ' ', $c->periodo)) . "\n\n" .
            "Aguarde a confirmação do pagamento RUP pela Secretaria.\n" .
            "— Instituto Superior Politécnico do Bié"
        );
    }

    public function notificarPagamentoConfirmado(Candidatura $c): void
    {
        $ficha = str_pad($c->id, 5, '0', STR_PAD_LEFT);
        $this->enviar($c->telefone,
            "💳 *ISP-Bié — Pagamento Confirmado*\n\n" .
            "Olá *{$c->nome}*,\n" .
            "O pagamento RUP da sua candidatura foi confirmado.\n\n" .
            "📋 *Nº de Ficha:* {$ficha}\n" .
            "📚 *Curso:* {$c->curso}\n\n" .
            "A sua candidatura segue agora para análise pelo DAAC.\n" .
            "— Instituto Superior Politécnico do Bié"
        );
    }

    public function notificarAssinaturaDAAC(Candidatura $c): void
    {
        $ficha = str_pad($c->id, 5, '0', STR_PAD_LEFT);
        $this->enviar($c->telefone,
            "🖊️ *ISP-Bié — Candidatura Concluída*\n\n" .
            "Olá *{$c->nome}*,\n" .
            "A sua candidatura foi analisada e assinada pelo DAAC.\n\n" .
            "📋 *Nº de Ficha:* {$ficha}\n" .
            "📚 *Curso:* {$c->curso}\n" .
            "📌 *Estado:* Concluída\n\n" .
            "Fique atento aos próximos avisos sobre o Exame de Acesso.\n" .
            "— Instituto Superior Politécnico do Bié"
        );
    }

    public function notificarNotaLancada(Candidatura $c): void
    {
        $ficha     = str_pad($c->id, 5, '0', STR_PAD_LEFT);
        $nota      = number_format($c->nota_exame, 1);
        $resultado = $c->nota_exame >= 10 ? '✅ APROVADO' : '❌ REPROVADO';
        $this->enviar($c->telefone,
            "📝 *ISP-Bié — Resultado do Exame de Acesso*\n\n" .
            "Olá *{$c->nome}*,\n" .
            "O resultado do seu exame de acesso foi publicado.\n\n" .
            "📋 *Nº de Ficha:* {$ficha}\n" .
            "📚 *Curso:* {$c->curso}\n" .
            "🎯 *Nota:* {$nota}/20\n" .
            "🏆 *Resultado:* {$resultado}\n\n" .
            "— Instituto Superior Politécnico do Bié"
        );
    }

    public function notificarEstadoAlterado(Candidatura $c, string $estadoAnterior): void
    {
        $ficha    = str_pad($c->id, 5, '0', STR_PAD_LEFT);
        $labels   = Candidatura::$statusLabels;
        $novoLabel = $labels[$c->status] ?? $c->status;
        $anteLabel = $labels[$estadoAnterior] ?? $estadoAnterior;

        $emoji = match($c->status) {
            'aprovada'   => '✅',
            'rejeitada'  => '❌',
            'em_analise' => '🔍',
            'concluida'  => '🖊️',
            default      => '📋',
        };

        $this->enviar($c->telefone,
            "{$emoji} *ISP-Bié — Atualização da Candidatura*\n\n" .
            "Olá *{$c->nome}*,\n" .
            "O estado da sua candidatura foi actualizado.\n\n" .
            "📋 *Nº de Ficha:* {$ficha}\n" .
            "📚 *Curso:* {$c->curso}\n" .
            "🔄 *Estado anterior:* {$anteLabel}\n" .
            "📌 *Novo estado:* {$novoLabel}\n\n" .
            "— Instituto Superior Politécnico do Bié"
        );
    }

    // ── Utilitários ─────────────────────────────────────────────────────────

    private function normalizarTelefone(string $telefone): ?string
    {
        // Remover tudo excepto dígitos
        $digitos = preg_replace('/\D/', '', $telefone);

        if (! $digitos) {
            return null;
        }

        // Remover prefixos comuns '+' e '00'
        $digitos = preg_replace('/^\++/', '', $digitos);
        if (str_starts_with($digitos, '00')) {
            $digitos = preg_replace('/^0+/', '', $digitos);
        }

        // Se começa com 0 → substituir por 244 (formato local angolano: 0XXXXXXXXX)
        if (str_starts_with($digitos, '0')) {
            $digitos = '244' . substr($digitos, 1);
        }

        // Se tem 9 dígitos e começa com 9 → adicionar prefixo 244 (Angola)
        if (strlen($digitos) === 9 && str_starts_with($digitos, '9')) {
            $digitos = '244' . $digitos;
        }

        // Se começa com '244' e tiver mais que 12 dígitos, tentar remover prefixo '00' já tratado; aceitar também +244 formats
        if (str_starts_with($digitos, '244') && strlen($digitos) > 12) {
            // reduzir a últimos 12 dígitos se for algo como 00244xxxx... ou similar
            $digitos = substr($digitos, -12);
        }

        // Validar: deve ter 12 dígitos (244 + 9 dígitos)
        if (strlen($digitos) !== 12 || ! str_starts_with($digitos, '244')) {
            Log::warning("WhatsApp: número inválido ignorado — original: {$telefone}, normalizado: {$digitos}");
            return null;
        }

        return $digitos;
    }

    public function enviarDocumento(string $telefone, string $arquivoBase64, string $nome, ?string $caption = null): bool
    {
        if (! $this->enabled || ! $this->baseUrl || ! $this->apiKey || ! $this->instance) {
            return false;
        }

        $numero = $this->normalizarTelefone($telefone);
        if (! $numero) {
            return false;
        }

        try {
            $response = Http::timeout(30)
                ->withHeaders([
                    'apikey' => $this->apiKey,
                    'Content-Type' => 'application/json',
                ])
                ->post(
                    "{$this->baseUrl}/message/sendMedia/" . rawurlencode($this->instance),
                    [
                        'number'    => $numero,
                        'mediatype' => 'document',
                        'mimetype'  => 'application/pdf',
                        'caption'   => $caption ?? '📄 Comprovativo de candidatura ISP-Bié',
                        'media'     => $arquivoBase64,
                        'fileName'  => $nome,
                    ]
                );

            Log::info('Evolution WhatsApp sendMedia resposta', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);

            if (! $response->successful()) {
                Log::error("WhatsApp: falha sendMedia para {$numero}", [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                return false;
            }

            return true;
        } catch (\Throwable $e) {
            Log::error("WhatsApp: falha sendMedia para {$numero} — " . $e->getMessage());
            return false;
        }
    }

    /**
     * Envia o comprovativo (texto + PDF) ao candidato via WhatsApp e regista o resultado
     * na própria candidatura. Não reenvia se já tiver sido enviado com sucesso antes.
     */
    public function enviarComprovativo(Candidatura $candidatura): bool
    {
        if ($candidatura->whatsapp_comprovativo_enviado_at) {
            return true;
        }

        $pdf = Pdf::loadView('pdf.comprovativo', ['candidatura' => $candidatura])->setPaper('a4', 'portrait');
        $filename = 'comprovativo-' . str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) . '.pdf';

        $mensagem = "📄 *ISP-Bié — Comprovativo de Candidatura*\n\n" .
            "Olá *{$candidatura->nome}*,\n\n" .
            "Segue em anexo o comprovativo da sua candidatura.\n\n" .
            "📋 *Nº de Ficha:* " . str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) . "\n" .
            "📚 *Curso:* {$candidatura->curso}\n" .
            "📌 *Estado:* " . (Candidatura::$statusLabels[$candidatura->status] ?? $candidatura->status) . "\n\n" .
            "Guarde este documento para consultas futuras.\n\n" .
            "— Instituto Superior Politécnico do Bié";

        $this->enviar($candidatura->telefone, $mensagem);

        $sucesso = $this->enviarDocumento(
            $candidatura->telefone,
            base64_encode($pdf->output()),
            $filename,
            '📄 Comprovativo de candidatura — ISP-Bié'
        );

        if ($sucesso) {
            $candidatura->forceFill([
                'whatsapp_comprovativo_enviado_at' => now(),
                'whatsapp_comprovativo_falhou_em'  => null,
            ])->save();
        } else {
            $candidatura->forceFill([
                'whatsapp_comprovativo_falhou_em' => now(),
            ])->save();
        }

        return $sucesso;
    }
}
