---
name: Adicionar funcionalidade de copiar ao input userName usando Alpine.js + SweetAlert2
overview: Implementar funcionalidade de copiar para clipboard no input userName do modal de edição de colaboradores usando Alpine.js + Clipboard API nativa, com toast de confirmação via SweetAlert2 Laravel já instalado no projeto.
todos:
  - id: add-copy-button
    content: Adicionar botão de copiar ao lado do input userName no modal com Alpine.js
    status: pending
  - id: add-swal-toast
    content: Implementar toast SweetAlert2 para confirmar cópia bem-sucedida
    status: pending
---

# Plano de Ação: Adicionar funcionalidade de copiar ao input userName usando Alpine.js + SweetAlert2

## Contexto

O input `userName` está localizado no modal de edição de colaboradores (`resources/views/livewire/admin/colaboradores-list.blade.php`, linha 271). Este input está desabilitado e exibe o nome do colaborador quando está em modo de edição. A funcionalidade de copiar para clipboard facilitará a cópia desse valor.

## Estrutura Atual

- O projeto já usa **Alpine.js** (via Livewire) para interações client-side
- O projeto já tem **SweetAlert2 Laravel** instalado e configurado (usado em `ColaboradoresList.php`)
- O modal é controlado por Livewire com estado `showModal` e Alpine.js (`x-show="showModal"`)
- O input `userName` só aparece quando `$editingId` está definido (linha 266)
- O valor do input vem de `{{ $nome }}` (linha 273)
- SweetAlert2 está disponível globalmente via `window.Swal` (carregado pelo pacote sweetalert2-laravel)

## Vantagens da Abordagem

- **Sem dependências externas**: Não precisa instalar pacotes npm adicionais
- **Mais leve**: Usa apenas APIs nativas do navegador
- **Integração natural**: Alpine.js já está disponível via Livewire
- **Feedback profissional**: Usa SweetAlert2 já instalado para toast de confirmação
- **Consistência**: Mantém o mesmo padrão visual usado em outras partes do sistema
- **Compatibilidade**: Clipboard API é suportada em todos os navegadores modernos (Chrome 66+, Firefox 63+, Safari 13.1+)

## Implementação

### 1. Modificar a view Blade

Em `resources/views/livewire/admin/colaboradores-list.blade.php`, modificar a seção do input `userName` (linhas 266-275) para adicionar:

- Um wrapper `div` com `x-data` do Alpine.js para gerenciar a função de cópia
- Um botão de copiar ao lado do input
- Toast SweetAlert2 para confirmar cópia bem-sucedida (usando `window.Swal` disponível globalmente)
- Ícone SVG de copiar (seguindo o padrão já usado no arquivo)

## Arquivos a Modificar

1. `resources/views/livewire/admin/colaboradores-list.blade.php` - Adicionar botão e lógica Alpine.js

## Exemplos de Código

### Exemplo 1: Versão com SweetAlert2 Toast (RECOMENDADO)

Esta versão usa SweetAlert2 para mostrar um toast de confirmação, mantendo consistência com o resto do sistema:

```blade
@if ($editingId)
    <div>
        <label for="userName" class="block text-sm font-medium text-default-700 mb-1">Usuário</label>
        <div 
            class="relative"
            x-data="{
                async copyToClipboard() {
                    const input = document.getElementById('userName');
                    try {
                        // Copia para clipboard usando API moderna
                        await navigator.clipboard.writeText(input.value);
                        
                        // Mostra toast de sucesso usando SweetAlert2
                        if (window.Swal) {
                            window.Swal.fire({
                                title: 'Copiado!',
                                text: 'Nome do usuário copiado para a área de transferência',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                            });
                        }
                    } catch (err) {
                        // Fallback para navegadores antigos
                        input.select();
                        input.setSelectionRange(0, 99999);
                        const success = document.execCommand('copy');
                        
                        if (window.Swal) {
                            if (success) {
                                window.Swal.fire({
                                    title: 'Copiado!',
                                    text: 'Nome do usuário copiado para a área de transferência',
                                    icon: 'success',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true,
                                });
                            } else {
                                window.Swal.fire({
                                    title: 'Erro',
                                    text: 'Não foi possível copiar o texto',
                                    icon: 'error',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 2000,
                                });
                            }
                        }
                    }
                }
            }"
        >
            <input
                type="text"
                id="userName"
                class="form-input w-full bg-default-100 pr-10"
                value="{{ $nome }}"
                disabled
            >
            <button
                type="button"
                @click="copyToClipboard()"
                class="absolute right-2 top-8 p-1.5 text-default-500 hover:text-primary transition-colors"
                title="Copiar nome"
            >
                <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    width="16" 
                    height="16" 
                    viewBox="0 0 24 24" 
                    fill="none" 
                    stroke="currentColor" 
                    stroke-width="2" 
                    stroke-linecap="round" 
                    stroke-linejoin="round"
                >
                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                </svg>
            </button>
        </div>
        <label for="userEmail" class="block text-sm font-medium text-default-700 mt-3">Email</label>
        <input
            type="text"
            id="userEmail"
            class="form-input w-full bg-default-100"
            value="{{ $email }}"
            disabled
        >
    </div>
@else
    <!-- ... resto do código ... -->
@endif
```

### Exemplo 2: Versão Simplificada com SweetAlert2 (Toast mais curto)

Versão mais compacta com mensagem mais curta:

```blade
@if ($editingId)
    <div>
        <label for="userName" class="block text-sm font-medium text-default-700 mb-1">Usuário</label>
        <div 
            class="relative"
            x-data="{
                async copyToClipboard() {
                    const input = document.getElementById('userName');
                    try {
                        await navigator.clipboard.writeText(input.value);
                        if (window.Swal) {
                            window.Swal.fire({
                                title: 'Copiado!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                            });
                        }
                    } catch (err) {
                        input.select();
                        document.execCommand('copy');
                        if (window.Swal) {
                            window.Swal.fire({
                                title: 'Copiado!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                            });
                        }
                    }
                }
            }"
        >
            <input
                type="text"
                id="userName"
                class="form-input w-full bg-default-100 pr-10"
                value="{{ $nome }}"
                disabled
            >
            <button
                type="button"
                @click="copyToClipboard()"
                class="absolute right-2 top-8 p-1.5 text-default-500 hover:text-primary transition-colors"
                title="Copiar nome"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                </svg>
            </button>
        </div>
        <!-- ... resto do código ... -->
    </div>
@endif
```

### Exemplo 3: Versão com Fallback Visual (sem SweetAlert2)

Se por algum motivo o SweetAlert2 não estiver disponível, esta versão usa feedback visual simples:

```blade
@if ($editingId)
    <div>
        <label for="userName" class="block text-sm font-medium text-default-700 mb-1">Usuário</label>
        <div 
            class="relative"
            x-data="{
                copied: false,
                async copyToClipboard() {
                    const input = document.getElementById('userName');
                    try {
                        await navigator.clipboard.writeText(input.value);
                        
                        // Tenta usar SweetAlert2 primeiro
                        if (window.Swal) {
                            window.Swal.fire({
                                title: 'Copiado!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                            });
                        } else {
                            // Fallback visual se SweetAlert2 não estiver disponível
                            this.copied = true;
                            setTimeout(() => this.copied = false, 2000);
                        }
                    } catch (err) {
                        input.select();
                        document.execCommand('copy');
                        if (window.Swal) {
                            window.Swal.fire({
                                title: 'Copiado!',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                            });
                        } else {
                            this.copied = true;
                            setTimeout(() => this.copied = false, 2000);
                        }
                    }
                }
            }"
        >
            <input
                type="text"
                id="userName"
                class="form-input w-full bg-default-100 pr-10"
                value="{{ $nome }}"
                disabled
            >
            <button
                type="button"
                @click="copyToClipboard()"
                class="absolute right-2 top-8 p-1.5 text-default-500 hover:text-primary transition-colors"
                :title="copied ? 'Copiado!' : 'Copiar nome'"
                :class="copied ? 'text-success' : ''"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                </svg>
            </button>
        </div>
        <!-- ... resto do código ... -->
    </div>
@endif
```

## Explicação do Código

### Alpine.js `x-data` com SweetAlert2

```javascript
x-data="{
    async copyToClipboard() {
        const input = document.getElementById('userName');
        try {
            // Copia usando Clipboard API moderna
            await navigator.clipboard.writeText(input.value);
            
            // Mostra toast SweetAlert2
            if (window.Swal) {
                window.Swal.fire({
                    title: 'Copiado!',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                });
            }
        } catch (err) {
            // Fallback para navegadores antigos
            input.select();
            document.execCommand('copy');
            // Mostra toast mesmo no fallback
            if (window.Swal) {
                window.Swal.fire({ /* ... */ });
            }
        }
    }
}"
```

### Uso do SweetAlert2

O SweetAlert2 está disponível globalmente via `window.Swal` porque:

- O pacote `sweetalert2/laravel` já está instalado
- O template `@include('sweetalert2::index')` está incluído no layout (verificado em `resources/views/layouts/vertical.blade.php`)
- O SweetAlert2 é carregado automaticamente pelo pacote

### Configuração do Toast

As opções do toast seguem o padrão usado no componente `ColaboradoresList.php`:

- `toast: true` - Exibe como toast (não modal)
- `position: 'top-end'` - Posição no canto superior direito
- `showConfirmButton: false` - Sem botão de confirmação
- `timer: 2000` - Fecha automaticamente após 2 segundos
- `timerProgressBar: true` - Mostra barra de progresso (opcional)

### Botão com Event Handler

```blade
<button
    type="button"
    @click="copyToClipboard()"  <!-- Alpine.js event handler -->
    class="absolute right-2 top-8 p-1.5 text-default-500 hover:text-primary transition-colors"
    title="Copiar nome"
>
```

### Ícone SVG

- **Ícone de copiar**: Retângulo com linha (padrão de clipboard) - sempre visível

## Considerações Técnicas

- **Posicionamento**: O botão usa `absolute` dentro de um `relative` para ficar dentro do input
- **Acessibilidade**: Inclui `title` e `type="button"` para não submeter formulário
- **Feedback**: Toast SweetAlert2 aparece automaticamente e fecha após 2 segundos
- **Fallback**: Inclui fallback para navegadores que não suportam Clipboard API (usa `document.execCommand`)
- **SweetAlert2**: Verifica se `window.Swal` existe antes de usar (defesa contra erros)
- **Consistência**: Usa o mesmo padrão de toast usado em outras partes do sistema (`swalToastSuccess`)
- **Sem estado local**: Não precisa de estado `copied` porque o feedback vem do SweetAlert2

## Localização Exata no Arquivo

O código deve substituir as linhas **266-284** em `resources/views/livewire/admin/colaboradores-list.blade.php`:

```blade
@if ($editingId)
    <div>
        <label for="userName" class="block text-sm font-medium text-default-700 mb-1">Usuário</label>
        <!-- AQUI VAI O NOVO CÓDIGO COM O BOTÃO -->
        <label for="userEmail" class="block text-sm font-medium text-default-700 mt-3">Email</label>
        <!-- ... -->
    </div>
@endif
```