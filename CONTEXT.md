# Sistema Via Beton

Sistema de gestão de ocorrências e atendimentos de campo para prestadores e administradores.

## Language

**Ocorrência**:
Registro de um chamado ou serviço em uma agência, com ciclo de vida (aberto, em andamento, revisão, concluído).
_Avoid_: Ticket, chamado (em documentação de domínio)

**Atendimento**:
Período em que o prestador executa o serviço na agência, a partir do registro de chegada até a conclusão.
_Avoid_: Visita (quando ambíguo com deslocamento apenas)

**Foto de atendimento**:
Imagem vinculada a um par Antes/Depois de uma Ocorrência em andamento.
_Avoid_: Imagem, anexo (genéricos demais no fluxo do prestador)

**Par Antes/Depois**:
Conjunto de duas fotos de atendimento (estado anterior e posterior) que compõem um registro fotográfico do serviço.
_Avoid_: Par de imagens (sem o significado de negócio)

**Preventiva**:
Registro de vistoria ou manutenção preventiva em agência, com fotografias e relatórios PDF (técnico e executivo). Não possui **Disciplina** nem **Subdisciplina**.
_Avoid_: Vistoria (quando ambíguo com outros tipos de visita)

**Disciplina**:
Item de catálogo que classifica o tipo principal de serviço de uma **Ocorrência** (ex.: Elétrica, Hidráulica). Uma Ocorrência pode ter no máximo uma Disciplina, escolhida entre itens cadastrados pelo administrador.
_Avoid_: Categoria (reservada ao prazo/categoria de manutenção da Ocorrência)

**Subdisciplina**:
Item de catálogo que detalha o escopo do serviço em uma **Ocorrência** (ex.: Tomada, Interruptor). Uma Ocorrência pode ter até três Subdisciplinas, opcionais e independentes da Disciplina escolhida.
_Avoid_: Subcategoria genérica sem o vínculo com Ocorrência

**Descrição (da Preventiva)**:
Texto livre obrigatório para gerar os relatórios PDF; exibido integralmente no relatório, acima das fotografias.
_Avoid_: Comentários (campo distinto na preventiva)

**Fonte da captura**:
Origem da imagem no dispositivo do prestador — **Câmera** (foto nova no local) ou **Galeria** (arquivo já existente no aparelho).
_Avoid_: Upload (como termo de negócio quando o usuário fala de escolher da galeria)

## Relationships

- Uma **Ocorrência** pode ter zero ou uma **Disciplina** e zero a três **Subdisciplinas**
- Um **Atendimento** pertence a exatamente uma **Ocorrência**
- Uma **Ocorrência** em andamento pode ter um ou mais **Pares Antes/Depois**
- Cada slot de **Foto de atendimento** (Antes ou Depois) é preenchido com uma imagem de uma **Fonte da captura** escolhida pelo prestador

## Example dialogue

> **Dev:** "No mobile, o prestador escolhe a **Fonte da captura** antes de enviar a **Foto de atendimento**?"
> **Domain expert:** "Sim — **Câmera** para tirar na hora no local, **Galeria** se a foto já estava no celular."

## Flagged ambiguities

- "Adicionar foto" no botão inferior adiciona um novo **Par Antes/Depois**, não dispara captura por si só.
