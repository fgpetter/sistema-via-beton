<?php

namespace App\Mail;

use App\Actions\Programadas\RenderRatPdfFromProgramada;
use App\Models\Programada;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class RatProgramadaEnviada extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Programada $programada) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'RAT #'.$this->programada->id.' - '.$this->programada->titulo,
            replyTo: [new Address('fabio@vbeton.com.br')],
        );
    }

    public function content(): Content
    {
        return new Content(markdown: 'emails.rat-programada-enviada');
    }

    public function attachments(): array
    {
        $programada = $this->programada->fresh([
            'colaborador', 'enderecoVinculado', 'responsavelEngenharia', 'disciplina',
            'subdisciplina1', 'subdisciplina2', 'subdisciplina3', 'subdisciplina4', 'subdisciplina5', 'subdisciplina6',
        ]);
        $path = $programada->rat_pdf_path;
        if ($path && Storage::disk('public')->exists($path)) {
            return [Attachment::fromStorageDisk('public', $path)->as('RAT-'.$programada->id.'.pdf')->withMime('application/pdf')];
        }

        return [Attachment::fromData(
            fn (): string => app(RenderRatPdfFromProgramada::class)($programada),
            'RAT-'.$programada->id.'.pdf'
        )->withMime('application/pdf')];
    }
}
