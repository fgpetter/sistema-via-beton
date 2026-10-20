<x-mail::message>
# Programada aguardando revisão

Uma Programada foi concluída pelo prestador e aguarda revisão administrativa.

<x-mail::table>
| Campo | Detalhe |
|:--|:--|
| **Requisição** | #{{ $programada->id }} |
| **Tipo** | {{ $programada->tipo->label() }} |
| **Título** | {{ $programada->titulo }} |
| **Agência** | {{ $programada->agencia }} |
| **Abertura** | {{ $programada->abertura->format('d/m/Y') }} |
</x-mail::table>

Atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>
