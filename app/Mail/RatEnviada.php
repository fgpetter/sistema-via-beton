<?php

namespace App\Mail;

use App\Actions\Ocorrencias\RenderRatPdfFromOcorrencia;
use App\Models\Ocorrencia;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class RatEnviada extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public function __construct(public Ocorrencia $ocorrencia) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'RAT #'.$this->ocorrencia->id.' - '.$this->ocorrencia->titulo,
            replyTo: [
                new Address('fabio@vbeton.com.br'),
            ],
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
        $ocorrencia = $this->ocorrencia->fresh(['prazo', 'colaborador', 'enderecoVinculado']);
        $path = $ocorrencia->rat_pdf_path;

        if ($path !== null && Storage::disk('public')->exists($path)) {
            return [
                Attachment::fromStorageDisk('public', $path)
                    ->as('RAT-'.$ocorrencia->id.'.pdf')
                    ->withMime('application/pdf'),
            ];
        }

        return [
            Attachment::fromData(
                fn (): string => app(RenderRatPdfFromOcorrencia::class)($ocorrencia),
                'RAT-'.$ocorrencia->id.'.pdf'
            )->withMime('application/pdf'),
        ];
    }
}
