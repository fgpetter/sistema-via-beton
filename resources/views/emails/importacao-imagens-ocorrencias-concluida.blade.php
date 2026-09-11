<x-mail::message>
# Importação de fotos de atendimento concluída

A Importação de Fotos de Atendimento foi concluída:

<x-mail::table>
| Campo | Detalhe |
|:------|:--------|
| **Ocorrências** | {{ count($ocorrenciaIds) }} |
| **Imagens processadas** | {{ $totalImagens }} |
| **IDs** | {{ empty($ocorrenciaIds) ? '—' : implode(', ', $ocorrenciaIds) }} |
</x-mail::table>

Atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>
