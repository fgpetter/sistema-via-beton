<x-mail::message>
# Ocorrência concluída pelo prestador

Uma ocorrência foi concluída:

<x-mail::table>
| Campo       | Detalhe                                          |
|:------------|:-------------------------------------------------|
| **ID**      | #{{ $ocorrencia->id }}                           |
| **Título**  | {{ $ocorrencia->titulo }}                        |
| **Status**  | {{ $ocorrencia->status->label() }}               |
| **Agência** | {{ $ocorrencia->agencia }}                       |
| **Abertura**| {{ $ocorrencia->abertura->format('d/m/Y') }}     |
</x-mail::table>

@if ($ocorrencia->descricao)
**Descrição:**
{{ $ocorrencia->descricao }}
@endif

@if ($ocorrencia->comentarios)
**Comentários:**
{{ $ocorrencia->comentarios }}
@endif

Atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>
