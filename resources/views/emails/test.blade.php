<x-mail::message>
# Teste de E-mail

{{ $mensagem }}

**Data/Hora:** {{ now()->format('d/m/Y H:i:s') }}

**Ambiente:** {{ config('app.env') }}

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>
