<?php

namespace App\Services;

use App\Models\Candidatura;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    private string $baseUrl;
    private string $apiKey;
    private string $instance;
    private bool   $enabled;

    public function __construct()
    {
        $this->baseUrl  = rtrim(config('services.evolution.url', ''), '/');
        $this->apiKey   = config('services.evolution.key', '');
        $this->instance = config('services.evolution.instance', '');
        $this->enabled  = (bool) config('services.evolution.enabled', false);
    }

    public function enviar(string $telefone, string $mensagem): void
    {
        if (! $this->enabled || ! $this->baseUrl || ! $this->apiKey || ! $this->instance) {
            return;
        }

        $numero = $this->normalizarTelefone($telefone);
        if (! $numero) {
            return;
        }

        try {
            Http::timeout(10)
                ->withHeaders(['apikey' => $this->apiKey])
                ->post("{$this->baseUrl}/message/sendText/{$this->instance}", [
                    'number' => $numero,
                    'text'   => $mensagem,
                ]);
        } catch (\Throwable $e) {
            Log::error("WhatsApp: falha ao enviar para {$numero} — " . $e->getMessage());
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

        // Se começa com 0 → substituir por 244 (formato local angolano: 0XXXXXXXXX)
        if (str_starts_with($digitos, '0')) {
            $digitos = '244' . substr($digitos, 1);
        }

        // Se tem 9 dígitos e começa com 9 → adicionar prefixo 244 (Angola)
        if (strlen($digitos) === 9 && str_starts_with($digitos, '9')) {
            $digitos = '244' . $digitos;
        }

        // Validar: deve ter 12 dígitos (244 + 9 dígitos)
        if (strlen($digitos) !== 12 || ! str_starts_with($digitos, '244')) {
            Log::warning("WhatsApp: número inválido ignorado — original: {$telefone}, normalizado: {$digitos}");
            return null;
        }

        return $digitos;
    }
}
