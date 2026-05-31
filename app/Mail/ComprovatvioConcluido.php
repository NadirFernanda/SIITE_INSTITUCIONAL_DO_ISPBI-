<?php

namespace App\Mail;

use App\Models\Candidatura;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComprovatvioConcluido extends Mailable
{
    use Queueable, SerializesModels;

    public Candidatura $candidatura;

    public function __construct(Candidatura $candidatura)
    {
        $this->candidatura = $candidatura;
    }

    public function build()
    {
        return $this->subject('Candidatura Concluída — ISP-Bié (Ficha n.º ' . str_pad($this->candidatura->id, 5, '0', STR_PAD_LEFT) . ')')
                    ->view('emails.comprovativo_concluido');
    }
}
