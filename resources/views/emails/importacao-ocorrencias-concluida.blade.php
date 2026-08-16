<x-mail::message>
# Importação de ocorrências concluída

A Importação de Ocorrências foi concluída:

<x-mail::table>
| Campo | Detalhe |
|:------|:--------|
| **Arquivo** | {{ $arquivo }} |
| **Importadas** | {{ $importadas }} |
| **Linhas ignoradas** | {{ $linhasIgnoradas }} |
</x-mail::table>

Atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>
