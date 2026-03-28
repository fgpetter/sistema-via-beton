<?php

namespace App\Mail;

use App\Actions\Ocorrencias\RenderRatPdfFromOcorrencia;
use App\Models\Ocorrencia;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RatEnviada extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public function __construct(public Ocorrencia $ocorrencia) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'RAT #'.$this->ocorrencia->id.' - '.$this->ocorrencia->titulo,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.rat-enviada',
        );
    }

    /**
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(
                fn (): string => app(RenderRatPdfFromOcorrencia::class)(
                    $this->ocorrencia->fresh(['prazo', 'colaborador', 'enderecoVinculado'])
                ),
                'RAT-'.$this->ocorrencia->id.'.pdf'
            )->withMime('application/pdf'),
        ];
    }
}
