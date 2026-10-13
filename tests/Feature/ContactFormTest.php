<?php

use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Envelope;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\TransportInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\RawMessage;

it('envia o conteúdo HTML pelo transportador simulado com os cabeçalhos institucionais', function () {
    $transport = Mail::mailer('array')->getSymfonyTransport();
    $transport->flush();

    $this->from(route('contactos'))->post(route('contact.send'), [
        'nome' => 'Ana Silva',
        'email' => 'ana@example.test',
        'assunto' => 'Pedido de informação',
        'mensagem' => "Olá <script>alert('x')</script>\nPreciso de ajuda.",
    ])->assertRedirect(route('contactos'))->assertSessionHas('success');

    expect($transport->messages())->toHaveCount(1);
    $email = $transport->messages()->first()->getOriginalMessage();

    expect($email)->toBeInstanceOf(Email::class)
        ->and($email->getTo()[0]->getAddress())->toBe('geral@isp-bie.ao')
        ->and($email->getFrom()[0]->getAddress())->toBe('noreply@isp-bie.ao')
        ->and($email->getFrom()[0]->getName())->toBe('ISP-Bié Website')
        ->and($email->getReplyTo()[0]->getAddress())->toBe('ana@example.test')
        ->and($email->getReplyTo()[0]->getName())->toBe('Ana Silva')
        ->and($email->getSubject())->toBe('Contacto via site - Pedido de informação')
        ->and($email->getHtmlBody())->toContain('Ana Silva', 'ana@example.test', 'Pedido de informação', 'Preciso de ajuda.', '&lt;script&gt;')
        ->and($email->getHtmlBody())->not->toContain('<script>');
});

it('valida os campos e não envia mensagens inválidas', function () {
    $transport = Mail::mailer('array')->getSymfonyTransport();
    $transport->flush();

    $this->from(route('contactos'))->post(route('contact.send'), [
        'nome' => '',
        'email' => 'invalido',
        'mensagem' => '',
    ])->assertRedirect(route('contactos'))->assertSessionHasErrors(['nome', 'email', 'mensagem']);

    expect($transport->messages())->toHaveCount(0);
});

it('impede injecção de cabeçalhos por assunto nome ou endereço de resposta', function () {
    $transport = Mail::mailer('array')->getSymfonyTransport();
    $transport->flush();

    $this->from(route('contactos'))->post(route('contact.send'), [
        'nome' => "Ana\r\nBcc: intruso@example.test",
        'email' => 'ana@example.test',
        'assunto' => "Assunto\r\nBcc: intruso@example.test",
        'mensagem' => 'Mensagem de teste',
    ])->assertSessionHas('success');

    $email = $transport->messages()->first()->getOriginalMessage();
    expect($email->getSubject())->toBe('Contacto via site - Assunto Bcc: intruso@example.test')
        ->and($email->getReplyTo()[0]->getName())->toBe('Ana Bcc: intruso@example.test')
        ->and($email->getBcc())->toBe([]);

    $this->from(route('contactos'))->post(route('contact.send'), [
        'nome' => 'Ana',
        'email' => "ana@example.test\r\nBcc: intruso@example.test",
        'mensagem' => 'Mensagem de teste',
    ])->assertSessionHasErrors(['email']);

    expect($transport->messages())->toHaveCount(1);
});

it('mostra erro sem expor detalhes quando o transportador falha', function () {
    Mail::mailer('array')->setSymfonyTransport(new class implements TransportInterface
    {
        public function send(RawMessage $message, ?Envelope $envelope = null): ?SentMessage
        {
            throw new TransportException('Falha SMTP reservada ao servidor');
        }

        public function __toString(): string
        {
            return 'smtp-simulado';
        }
    });

    $this->from(route('contactos'))->post(route('contact.send'), [
        'nome' => 'Ana Silva',
        'email' => 'ana@example.test',
        'mensagem' => 'Pedido de ajuda',
    ])->assertRedirect(route('contactos'))
        ->assertSessionHas('error', 'Ocorreu um erro ao enviar a mensagem. Tente novamente mais tarde.')
        ->assertSessionHasInput('nome', 'Ana Silva');
});
