<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ImportacaoOcorrenciasFalhou extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $arquivo,
        public string $mensagem,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Falha na importação de ocorrências',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.importacao-ocorrencias-falhou',
        );
    }
}
