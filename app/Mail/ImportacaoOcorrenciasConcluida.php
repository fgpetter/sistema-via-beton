<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ImportacaoOcorrenciasConcluida extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @param  list<int>  $ocorrenciaIds
     */
    public function __construct(
        public string $arquivo,
        public int $importadas,
        public int $linhasIgnoradas,
        public array $ocorrenciaIds = [],
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Importação de ocorrências concluída',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.importacao-ocorrencias-concluida',
        );
    }
}
