<?php

namespace App\Mail;

use App\Models\Candidatura;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CandidaturaReceived extends Mailable
{
    use Queueable, SerializesModels;

    public Candidatura $candidatura;

    public function __construct(Candidatura $candidatura)
    {
        $this->candidatura = $candidatura;
    }

    public function build()
    {
        return $this->subject('Nova candidatura recebida — ISP-Bié')
                    ->view('emails.candidatura_received');
    }
}
