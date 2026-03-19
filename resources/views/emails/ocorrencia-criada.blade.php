<x-mail::message>
# Nova Ocorrência Atribuída

Olá, **{{ $ocorrencia->colaborador->nome }}**.

Uma nova ocorrência foi atribuída a você:

<x-mail::table>
| Campo       | Detalhe                                          |
|:------------|:-------------------------------------------------|
| **Nº OC**   | {{ $ocorrencia->numero_ocorrencia }}              |
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
