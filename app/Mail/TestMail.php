<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class TestMail extends Mailable
{
    public function __construct(public string $mensagem = 'E-mail de teste enviado com sucesso!') {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Teste de E-mail - Via Beton',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.test',
        );
    }
}
