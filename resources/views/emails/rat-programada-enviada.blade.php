<x-mail::message>
# Relatório de atendimento técnico (RAT)

Segue em anexo a **RAT** da Programada **#{{ $programada->id }}** — {{ $programada->titulo }}.

Atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>
