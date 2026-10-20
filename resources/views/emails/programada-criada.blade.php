<x-mail::message>
# Nova Programada Atribuída

Olá, **{{ $programada->colaborador->nome }}**.

Uma Programada foi atribuída a você:

<x-mail::table>
| Campo | Detalhe |
|:--|:--|
| **Requisição** | #{{ $programada->id }} |
| **Tipo** | {{ $programada->tipo->label() }} |
| **Título** | {{ $programada->titulo }} |
| **Status** | {{ $programada->status->label() }} |
| **Agência** | {{ $programada->agencia }} |
| **Abertura** | {{ $programada->abertura->format('d/m/Y') }} |
</x-mail::table>

Atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>
