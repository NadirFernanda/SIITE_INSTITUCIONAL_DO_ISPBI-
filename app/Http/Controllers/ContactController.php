<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Handle contact form submission and send email to geral@isp-bie.ao
     */
    public function send(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'assunto' => 'nullable|string|max:255',
            'mensagem' => 'required|string|max:10000',
        ]);

        $to = 'geral@isp-bie.ao';

        // Strip CR/LF to prevent email header injection (defense-in-depth;
        // Symfony Mailer also encodes headers, but explicit stripping is safer).
        $subject = 'Contacto via site';
        if (!empty($data['assunto'])) {
            $subject .= ' - ' . preg_replace('/[\r\n]+/', ' ', $data['assunto']);
        }

        $body = "<p><strong>Nome:</strong> " . e($data['nome']) . "</p>";
        $body .= "<p><strong>Email:</strong> " . e($data['email']) . "</p>";
        $body .= "<p><strong>Assunto:</strong> " . e($data['assunto'] ?? '-') . "</p>";
        $body .= "<p><strong>Mensagem:</strong></p><p>" . nl2br(e($data['mensagem'])) . "</p>";

        // Defesa em profundidade contra CVE-2026-48019 (bypass da validação
        // 'email' do Laravel que permite injecção de cabeçalhos) — revalida o
        // endereço antes de o usar no cabeçalho Reply-To.
        $replyToEmail = \App\Support\MailAddressSanitizer::clean($data['email']);
        $replyToNome  = preg_replace('/[\r\n\x00]+/', ' ', $data['nome']);

        try {
            Mail::send([], [], function ($message) use ($to, $subject, $body, $replyToEmail, $replyToNome) {
                $message->to($to)
                    ->subject($subject)
                    ->from('noreply@isp-bie.ao', 'ISP-Bié Website')
                    ->setBody($body, 'text/html');

                if ($replyToEmail) {
                    $message->replyTo($replyToEmail, $replyToNome);
                }
            });
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Ocorreu um erro ao enviar a mensagem. Tente novamente mais tarde.');
        }

        return back()->with('success', 'Mensagem enviada com sucesso. Obrigado pelo seu contacto.');
    }
}
