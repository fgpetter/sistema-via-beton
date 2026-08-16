<x-mail::message>
# Falha na importação de ocorrências

A Importação de Ocorrências falhou.

<x-mail::table>
| Campo | Detalhe |
|:------|:--------|
| **Arquivo** | {{ $arquivo }} |
| **Erro** | {{ $mensagem }} |
</x-mail::table>

Atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>
