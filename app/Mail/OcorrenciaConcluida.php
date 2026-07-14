<?php

namespace App\Mail;

use App\Models\Ocorrencia;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OcorrenciaConcluida extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Ocorrencia $ocorrencia) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Ocorrência #{$this->ocorrencia->id} concluída pelo prestador",
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.ocorrencia-concluida',
        );
    }
}
