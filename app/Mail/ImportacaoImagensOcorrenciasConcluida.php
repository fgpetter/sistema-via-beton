<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ImportacaoImagensOcorrenciasConcluida extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @param  list<int>  $ocorrenciaIds
     */
    public function __construct(
        public array $ocorrenciaIds,
        public int $totalImagens,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Importação de fotos de atendimento concluída',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.importacao-imagens-ocorrencias-concluida',
        );
    }
}
