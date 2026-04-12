<x-mail::message>
# Relatório de atendimento técnico (RAT)

Segue em anexo o PDF da **RAT** referente à ocorrência **#{{ $ocorrencia->id }}** — {{ $ocorrencia->titulo }}.

Atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>
