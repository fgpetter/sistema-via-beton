<?php

namespace App\Mail;

use App\Models\Ocorrencia;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OcorrenciaCriada extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Ocorrencia $ocorrencia) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Nova Ocorrência {$this->ocorrencia->numero_ocorrencia} - {$this->ocorrencia->titulo}",
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.ocorrencia-criada',
        );
    }
}
