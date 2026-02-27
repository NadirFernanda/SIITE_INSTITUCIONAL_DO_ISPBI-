<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RevistaSubmissionReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $submission;

    /**
     * Create a new message instance.
     */
    public function __construct($submission)
    {
        $this->submission = $submission;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Nova submissão — Revista Científica ISP-Bié')
                    ->view('emails.revista_submission_received');
    }
}
