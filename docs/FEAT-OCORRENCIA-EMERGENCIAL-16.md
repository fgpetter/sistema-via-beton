# [FEAT/OCORRENCIA-EMERGENCIAL-16] Ocorrência Emergencial

## Objetivo

Adicionar condição para ocorrências com categoria **"Engenharia.Emergencial"**:
- A linha na tabela de ocorrências deve ficar **visualmente destacada** (fundo vermelho + borda lateral)
- O item emergencial deve **aparecer no topo** da listagem, independente da data de abertura

---

## Contexto (antes da implementação)

O model `Ocorrencia` não possuía nenhum vínculo com a tabela `prazos`, que contém as categorias do sistema (ex: `Engenharia.Emergencial`, `Engenharia.Inspeção`, etc.). Sem esse vínculo, não era possível identificar qual ocorrência era emergencial.

### Estrutura anterior da tabela `ocorrencias`

| Coluna               | Tipo         | Descrição                     |
|----------------------|--------------|-------------------------------|
| id                   | bigint (PK)  | Identificador                 |
| status               | string       | Enum: aberto, andamento, etc. |
| titulo               | string(255)  | Resumo da ocorrência          |
| descricao            | text (null)  | Descrição detalhada           |
| abertura             | date         | Data de abertura              |
| colaborador_id       | FK (null)    | Responsável                   |
| agencia              | string(255)  | Agência afetada               |
| endereco             | string (null)| Endereço do local             |
| email_enviado        | datetime (null) | Data do envio do e-mail    |
| email_rat            | string (null)| E-mail RAT                    |
| email_rat_enviado    | datetime (null) | Data do envio do e-mail RAT|
| comentarios          | text (null)  | Comentários internos          |
| comentarios_prestador| text (null)  | Comentários do prestador      |

### Tabela `prazos` (já existente)

| nome                                    | prazo_valor | prazo_unidade |
|-----------------------------------------|-------------|---------------|
| **Engenharia.Emergencial**              | 6           | hora          |
| Engenharia.Inspeção                     | 5           | dia           |
| Engenharia.Vistoria e confecção         | 5           | dia           |
| Engenharia.Validação de orçamento       | 5           | dia           |
| Engenharia.Manutenção Corretiva         | 20          | dia           |
| Engenharia.Adequação de espaços físicos | 60          | dia           |

---

## Alterações realizadas

### 1. Migration — `2026_03_06_182319_add_prazo_id_to_ocorrencias_table.php`

Adicionou a coluna `prazo_id` como foreign key nullable na tabela `ocorrencias`, vinculando cada ocorrência a um prazo/categoria.

```php
$table->foreignId('prazo_id')
    ->nullable()
    ->after('colaborador_id')
    ->constrained('prazos')
    ->onDelete('set null');
```

**Rollback**: remove a FK e a coluna.

---

### 2. Model `Prazo` — `app/Models/Prazo.php`

| Alteração | Descrição |
|-----------|-----------|
| `const EMERGENCIAL` | Constante `'Engenharia.Emergencial'` para evitar strings hardcoded em todo o projeto |
| `isEmergencial(): bool` | Retorna `true` se `$this->nome === self::EMERGENCIAL` |

---

### 3. Model `Ocorrencia` — `app/Models/Ocorrencia.php`

| Alteração | Descrição |
|-----------|-----------|
| `$fillable` | Adicionado `'prazo_id'` |
| `prazo(): BelongsTo` | Relacionamento com o model `Prazo` |
| `isEmergencial(): bool` | Retorna `true` se o prazo relacionado for emergencial (`$this->prazo?->nome === Prazo::EMERGENCIAL`) |
| `scopeEmergenciaisFirst(Builder)` | Scope que ordena as ocorrências emergenciais no topo usando subquery SQL |

#### Detalhes do scope `emergenciaisFirst`

```php
public function scopeEmergenciaisFirst(Builder $query): Builder
{
    return $query->orderByRaw(
        'EXISTS (SELECT 1 FROM prazos WHERE prazos.id = ocorrencias.prazo_id AND prazos.nome = ?) DESC',
        [Prazo::EMERGENCIAL]
    );
}
```

Usa uma subquery `EXISTS` para criar uma coluna booleana virtual: `true` para emergenciais, `false` para as demais. O `DESC` garante que `true` (1) vem antes de `false` (0).

---

### 4. Livewire Form — `app/Livewire/Admin/Forms/OcorrenciaForm.php`

| Alteração | Descrição |
|-----------|-----------|
| `public ?int $prazoId = null` | Nova propriedade para o ID do prazo selecionado |
| `rules()` | Adicionada regra `'prazoId' => ['nullable', 'exists:prazos,id']` |
| `messages()` | Mensagem customizada: `'A categoria selecionada não existe.'` |
| `setFromOcorrencia()` | Carrega `$this->prazoId = $ocorrencia->prazo_id` ao editar |
| `toData()` | Inclui `'prazo_id' => $this->prazoId` na saída |

---

### 5. Livewire Component — `app/Livewire/Admin/OcorrenciasList.php`

| Alteração | Descrição |
|-----------|-----------|
| Eager loading | `->with(['colaborador', 'prazo'])` (antes era só `'colaborador'`) |
| Ordenação | Adicionado `->emergenciaisFirst()` antes do `->orderByDesc('abertura')` |
| `prazos(): array` (Computed) | Lista todos os prazos ordenados por nome para popular o select do formulário |

#### Query resultante

```php
Ocorrencia::query()
    ->with(['colaborador', 'prazo'])
    ->when($this->search, ...)
    ->when($this->statusFilter, ...)
    ->emergenciaisFirst()      // emergenciais primeiro
    ->orderByDesc('abertura')  // depois por data
    ->paginate(10);
```

---

### 6. Blade Admin — `resources/views/livewire/admin/ocorrencias-list.blade.php`

#### 6.1 Nova coluna "Categoria" no header da tabela

Adicionada entre "Status" e "Título". `colspan` do estado vazio ajustado de 8 para 9.

#### 6.2 Destaque visual na linha emergencial

```blade
<tr class="... {{ $ocorrencia->isEmergencial() ? 'bg-danger/10 border-l-4 border-l-danger' : '' }}">
```

| Classe Tailwind | Efeito visual |
|-----------------|---------------|
| `bg-danger/10` | Fundo vermelho claro (10% opacidade) |
| `border-l-4` | Borda esquerda de 4px |
| `border-l-danger` | Borda na cor de perigo (vermelho) |

#### 6.3 Badge da categoria na célula

- **Emergencial**: badge vermelho com fonte bold (`bg-danger/15 text-danger font-bold`)
- **Outras categorias**: texto simples cinza (`text-default-600`)
- **Sem categoria**: travessão (`—`)

#### 6.4 Campo select de Categoria no modal de criação/edição

Adicionado antes do grid de Agência/Endereço/Responsável:

```blade
<select wire:model="form.prazoId">
    <option value="">Selecione uma categoria</option>
    @foreach ($this->prazos as $id => $nome)
        <option value="{{ $id }}">{{ $nome }}</option>
    @endforeach
</select>
```

---

### 7. Livewire Prestador — `app/Livewire/Prestador/MeusAtendimentos.php`

| Alteração | Descrição |
|-----------|-----------|
| Eager loading | Adicionado `->with('prazo')` |
| Ordenação | Adicionado `->emergenciaisFirst()` antes do `->orderByDesc('abertura')` |

---

### 8. Blade Prestador — `resources/views/livewire/prestador/meus-atendimentos.blade.php`

| Alteração | Descrição |
|-----------|-----------|
| Card emergencial | Adicionadas classes `border-l-4 border-l-danger bg-danger/5` no `<a>` do card |
| Badge da categoria | Badge vermelho com nome do prazo exibido acima do nome da agência |

---

### 9. Factory — `database/factories/OcorrenciaFactory.php`

| Alteração | Descrição |
|-----------|-----------|
| `definition()` | Adicionado `'prazo_id' => Prazo::factory()` |
| `emergencial(): static` | Novo state que define `prazo_id` para o prazo "Engenharia.Emergencial" (usa `firstOrCreate` para evitar duplicatas no seed) |

Uso:

```php
Ocorrencia::factory()->emergencial()->create();
```

---

### 10. Testes — `tests/Feature/Livewire/Admin/OcorrenciasListTest.php`

5 novos testes adicionados:

| Teste | O que valida |
|-------|-------------|
| `test_emergencial_ocorrencias_appear_first` | Ocorrência emergencial (com data de abertura mais antiga) aparece antes da normal no HTML renderizado |
| `test_emergencial_ocorrencia_row_is_highlighted` | Linha emergencial contém as classes CSS `bg-danger/10 border-l-4 border-l-danger` |
| `test_non_emergencial_row_is_not_highlighted` | Linha de ocorrência normal **não** contém as classes de destaque |
| `test_admin_can_create_ocorrencia_with_prazo` | Admin consegue criar ocorrência com `prazoId` preenchido e o valor é persistido no banco |
| `test_categoria_column_shows_prazo_nome` | Nome do prazo aparece renderizado na tabela |

**Resultado**: 28 testes passando (71 assertions), 0 falhas.

---

## Arquivos modificados

| Arquivo | Tipo de alteração |
|---------|-------------------|
| `database/migrations/2026_03_06_182319_add_prazo_id_to_ocorrencias_table.php` | Novo |
| `app/Models/Prazo.php` | Modificado |
| `app/Models/Ocorrencia.php` | Modificado |
| `app/Livewire/Admin/Forms/OcorrenciaForm.php` | Modificado |
| `app/Livewire/Admin/OcorrenciasList.php` | Modificado |
| `resources/views/livewire/admin/ocorrencias-list.blade.php` | Modificado |
| `app/Livewire/Prestador/MeusAtendimentos.php` | Modificado |
| `resources/views/livewire/prestador/meus-atendimentos.blade.php` | Modificado |
| `database/factories/OcorrenciaFactory.php` | Modificado |
| `tests/Feature/Livewire/Admin/OcorrenciasListTest.php` | Modificado |

---

## Comportamento visual

### Tabela Admin (OcorrenciasList)

```
┌────┬───────────┬──────────────────────────┬────────────────────┬─────────┬──────────────┬──────────┬───────────────┬───────┐
│ ID │ Status    │ Categoria                │ Título             │ Agência │ Responsável  │ Abertura │ E-mail Enviado│ Ações │
├────┼───────────┼──────────────────────────┼────────────────────┼─────────┼──────────────┼──────────┼───────────────┼───────┤
│ ██ │ Aberto    │ ⊘ Engenharia.Emergencial │ Vazamento urgente  │ Ag. X   │ João Silva   │ 01/03    │ 01/03 14:00   │ ✎ 🗑 │  ← DESTACADA (fundo vermelho + borda)
├────┼───────────┼──────────────────────────┼────────────────────┼─────────┼──────────────┼──────────┼───────────────┼───────┤
│    │ Andamento │ Engenharia.Inspeção      │ Inspeção rotineira │ Ag. Y   │ Maria Costa  │ 05/03    │ —             │ ✎ 🗑 │  ← Normal
├────┼───────────┼──────────────────────────┼────────────────────┼─────────┼──────────────┼──────────┼───────────────┼───────┤
│    │ Aberto    │ —                        │ Sem categoria      │ Ag. Z   │ —            │ 06/03    │ —             │ ✎ 🗑 │  ← Normal (sem prazo)
└────┴───────────┴──────────────────────────┴────────────────────┴─────────┴──────────────┴──────────┴───────────────┴───────┘
```

### Cards Prestador (MeusAtendimentos)

Card emergencial exibe:
- Borda esquerda vermelha de 4px
- Fundo levemente avermelhado (5% opacidade)
- Badge vermelho com "Engenharia.Emergencial" acima do nome da agência

---

## Como testar manualmente

1. Acessar o sistema como **admin**
2. Ir em **Gestão de Ocorrências**
3. Criar uma nova ocorrência e selecionar a categoria **"Engenharia.Emergencial"**
4. Criar outra ocorrência com qualquer outra categoria (ou sem categoria)
5. Verificar que:
   - A emergencial aparece **no topo** da tabela
   - A linha tem **fundo vermelho claro** e **borda vermelha à esquerda**
   - A coluna "Categoria" exibe um **badge vermelho** com o nome
6. Acessar como **prestador** e verificar que o card emergencial também está destacado em "Meus Atendimentos"
