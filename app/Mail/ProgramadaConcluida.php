<?php

namespace App\Mail;

use App\Models\Programada;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProgramadaConcluida extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Programada $programada) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: "Programada #{$this->programada->id} encaminhada para revisão");
    }

    public function content(): Content
    {
        return new Content(markdown: 'emails.programada-concluida');
    }
}
