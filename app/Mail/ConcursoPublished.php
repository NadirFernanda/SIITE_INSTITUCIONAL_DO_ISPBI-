<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Concurso;

class ConcursoPublished extends Mailable
{
    use Queueable, SerializesModels;

    public $concurso;

    public function __construct(Concurso $concurso)
    {
        $this->concurso = $concurso;
    }

    public function build()
    {
        return $this->subject('Novo Concurso Publicado: '.$this->concurso->title)
            ->view('emails.concurso_published');
    }
}
