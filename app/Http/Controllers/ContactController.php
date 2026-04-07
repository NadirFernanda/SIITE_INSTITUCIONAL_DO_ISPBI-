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

        try {
            Mail::send([], [], function ($message) use ($to, $subject, $body, $data) {
                $message->to($to)
                    ->subject($subject)
                    ->from('noreply@isp-bie.ao', 'ISP-Bié Website')
                    ->replyTo($data['email'], $data['nome'])
                    ->setBody($body, 'text/html');
            });
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Ocorreu um erro ao enviar a mensagem. Tente novamente mais tarde.');
        }

        return back()->with('success', 'Mensagem enviada com sucesso. Obrigado pelo seu contacto.');
    }
}
