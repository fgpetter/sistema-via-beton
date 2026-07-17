# Comando `imagens:reprocessar`

Reprocessa imagens armazenadas em `storage/app/public/ocorrencias` ou `storage/app/public/preventivas`, enfileirando jobs para redimensionar e converter as imagens para JPEG.

## Sintaxe

```bash
vendor/bin/sail artisan imagens:reprocessar {pasta} [--step=N]
```

## Argumentos

| Argumento | Valores | Descrição |
|-----------|---------|-----------|
| `pasta` | `ocorrencias` ou `preventivas` | Define qual diretório será varrido recursivamente |

## Opções

| Opção | Descrição |
|-------|-----------|
| `--step=N` | Limita a quantidade de imagens enfileiradas. Útil para testar antes de processar tudo. Ex.: `--step=1` enfileira apenas a primeira imagem elegível |

## Exemplos

Testar com uma única imagem de ocorrências:

```bash
vendor/bin/sail artisan imagens:reprocessar ocorrencias --step=1
```

Reprocessar todas as imagens de preventivas:

```bash
vendor/bin/sail artisan imagens:reprocessar preventivas
```

## Comportamento

1. Varre recursivamente a pasta escolhida no disco `public`.
2. Considera apenas arquivos com extensão `.png`, `.jpg` ou `.jpeg` (case-insensitive).
3. Para cada arquivo, busca o registro correspondente no banco pelo campo `path`:
   - `ocorrencias` → `OcorrenciaImagem` → job `ProcessarImagemOcorrencia`
   - `preventivas` → `PreventivaImagem` → job `ProcessarImagemPreventiva`
4. Se existir registro, enfileira o job com **delayed dispatching**:
   - 1ª imagem: execução imediata (`delay(0)`)
   - 2ª imagem: `delay(1)` segundo
   - 3ª imagem: `delay(2)` segundos
   - e assim por diante (intervalo de 1 segundo entre execuções)
5. Se não existir registro no banco, o arquivo é registrado como órfão e o processamento continua.

O enfileiramento é instantâneo; o atraso afeta apenas quando o worker executará cada job.

## Saída no terminal

Ao final, o comando exibe:

```
Arquivos lidos: {total}
Enfileirados: {enfileirados}
Órfãos: {orfaos}
```

## Logs gerados

| Arquivo | Quando é escrito |
|---------|------------------|
| `storage/logs/images_proc.log` | A cada job enfileirado (uma linha com o `path` da imagem) |
| `storage/logs/images_to_prune.log` | Quando um arquivo existe no disco mas não possui registro no banco |

## Pré-requisitos

- Worker de fila em execução para processar os jobs enfileirados:

```bash
vendor/bin/sail artisan queue:work
```

- Link simbólico do storage público configurado (se ainda não existir):

```bash
vendor/bin/sail artisan storage:link
```

## Observações

- Arquivos com extensões diferentes de `.png`, `.jpg` e `.jpeg` são ignorados e não entram nos logs.
- O comando não altera arquivos diretamente; o processamento é feito pelos jobs na fila.
- Órfãos não interrompem a execução do comando.
