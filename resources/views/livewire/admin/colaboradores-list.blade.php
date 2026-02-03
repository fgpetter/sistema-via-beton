<div
    x-data="{
        showModal: @entangle('showModal'),
        showDeleteModal: @entangle('showDeleteModal')
    }"
    x-init="
        $watch('showModal', value => {
            if (value) document.body.classList.add('overflow-hidden');
            else document.body.classList.remove('overflow-hidden');
        });
        $watch('showDeleteModal', value => {
            if (value) document.body.classList.add('overflow-hidden');
            else document.body.classList.remove('overflow-hidden');
        });
    "
>

    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Gestão de Colaboradores</h6>
            @can('admin')
                <button @click="$wire.openCreateModal()" class="btn btn-sm bg-primary text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Novo Colaborador
                </button>
            @endcan
        </div>
        <div class="card-header">
            <div class="md:flex items-center md:space-y-0 space-y-4 gap-3 w-1/2">
                <div class="relative w-3/5">
                    <input
                        wire:model.live.debounce.300ms="search"
                        class="form-input form-input-sm ps-9"
                        placeholder="Buscar por nome ou e-mail"
                        type="text"
                    />
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-default-500"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </div>
                </div>

                <div class="relative w-2/5">
                    <select wire:model.live="tipoFilter" class="form-input form-input-sm">
                        <option value="">Todos os tipos</option>
                        @foreach ($this->tipos as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-default-200">
                            <thead class="bg-default-150">
                                <tr class="text-sm font-normal text-default-700 whitespace-nowrap">
                                    <th class="px-3.5 py-3 text-start" scope="col">ID</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Nome</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Tipo</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Contrato</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Usuário</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Criado em</th>
                                    @can('admin') <th class="px-3.5 py-3 text-start" scope="col">Ações</th> @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($this->colaboradores as $colaborador)
                                    <tr wire:key="colaborador-{{ $colaborador->id }}" class="text-default-800 font-normal text-sm whitespace-nowrap">
                                        <td class="px-3.5 py-3 text-primary">#{{ $colaborador->id }}</td>
                                        <td class="px-3.5 py-3">
                                            <h6 class="mb-0.5 font-semibold text-default-800">{{ $colaborador->nome }}</h6>
                                        </td>
                                        <td class="px-3.5 py-3">
                                            <span class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-primary/10 text-primary rounded">
                                                {{ $colaborador->tipo->label() }}
                                            </span>
                                        </td>
                                        <td class="px-3.5 py-3">
                                            @if ($colaborador->contrato->label() === "CLT")
                                                <span class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-success/10 text-success rounded">
                                                    {{ $colaborador->contrato->label() }}
                                                </span>
                                            @else
                                                <span class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-warning/10 text-warning rounded">
                                                    {{ $colaborador->contrato->label() }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-3.5">{{ $colaborador->user->email }}</td>
                                        <td class="py-3 px-3.5">{{ $colaborador->created_at->format('d/m/Y') }}</td>
                                        @can('admin') 
                                        <td class="px-3.5 py-3">
                                            <div class="flex items-center gap-2">
                                                <button
                                                    type="button"
                                                    @click="$wire.openEditModal({{ $colaborador->id }})"
                                                    class="btn size-7.5 bg-default-200 hover:bg-primary/10 text-default-500 hover:text-primary"
                                                    title="Editar"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                                </button>
                                                <button
                                                    type="button"
                                                    @click="$wire.confirmDelete({{ $colaborador->id }})"
                                                    class="btn size-7.5 bg-default-200 hover:bg-danger/10 text-default-500 hover:text-danger"
                                                    title="Excluir"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                                </button>
                                            </div>
                                        </td>
                                        @endcan
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-3.5 py-8 text-center text-default-500">
                                            <div class="flex flex-col items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-default-300"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                                <p>Nenhum colaborador encontrado.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if ($this->colaboradores->hasPages())
                <div class="card-footer">
                    <p class="text-default-500 text-sm">
                        Exibindo <b>{{ $this->colaboradores->firstItem() ?? 0 }}</b> a <b>{{ $this->colaboradores->lastItem() ?? 0 }}</b> de <b>{{ $this->colaboradores->total() }}</b> resultados
                    </p>
                    <nav aria-label="Pagination" class="flex items-center gap-2">
                        @if ($this->colaboradores->onFirstPage())
                            <button disabled class="btn btn-sm border bg-transparent border-default-200 text-default-400 cursor-not-allowed" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><polyline points="15 18 9 12 15 6"/></svg> Anterior
                            </button>
                        @else
                            <button wire:click="previousPage" class="btn btn-sm border bg-transparent border-default-200 text-default-600 hover:bg-primary/10 hover:text-primary hover:border-primary/10" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><polyline points="15 18 9 12 15 6"/></svg> Anterior
                            </button>
                        @endif

                        @foreach ($this->colaboradores->getUrlRange(1, $this->colaboradores->lastPage()) as $page => $url)
                            @if ($page == $this->colaboradores->currentPage())
                                <button class="btn size-7.5 bg-primary text-white" type="button">{{ $page }}</button>
                            @else
                                <button wire:click="gotoPage({{ $page }})" class="btn size-7.5 bg-transparent border border-default-200 text-default-600 hover:bg-primary/10 hover:text-primary hover:border-primary/10" type="button">
                                    {{ $page }}
                                </button>
                            @endif
                        @endforeach

                        @if ($this->colaboradores->hasMorePages())
                            <button wire:click="nextPage" class="btn btn-sm border bg-transparent border-default-200 text-default-600 hover:bg-primary/10 hover:text-primary hover:border-primary/10" type="button">
                                Próximo <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ms-1"><polyline points="9 18 15 12 9 6"/></svg>
                            </button>
                        @else
                            <button disabled class="btn btn-sm border bg-transparent border-default-200 text-default-400 cursor-not-allowed" type="button">
                                Próximo <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ms-1"><polyline points="9 18 15 12 9 6"/></svg>
                            </button>
                        @endif
                    </nav>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Criar/Editar Colaborador -->
    <template x-teleport="body">
        <div
            x-show="showModal"
            x-cloak
            class="size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
            role="dialog"
            tabindex="-1"
            aria-labelledby="modal-title"
        >
            <!-- Backdrop -->
            <div
                x-show="showModal"
                x-transition:enter="ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/50 pointer-events-auto"
                @click="$wire.closeModal()"
            ></div>

            <!-- Modal Content -->
            <div class="sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center relative z-10">
                <div
                    x-show="showModal"
                    x-transition:enter="ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="w-full flex flex-col bg-white border border-default-200 shadow-lg rounded-md pointer-events-auto"
                    @click.stop
                >
                    <div class="flex justify-between items-center p-4 border-b border-default-200">
                        <h3 id="modal-title" class="font-bold text-default-800 text-base">
                            {{ $editingId ? 'Editar Colaborador' : 'Novo Colaborador' }}
                        </h3>
                        <button type="button" aria-label="Fechar" @click="$wire.closeModal()">
                            <span class="sr-only">Fechar</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                    </div>

                    <form wire:submit="save">
                        <div class="p-4 overflow-y-auto">
                            <div class="space-y-4">
                                <div>
                                    <label for="nome" class="block text-sm font-medium text-default-700 mb-1">Nome</label>
                                    <input
                                        wire:model="nome"
                                        type="text"
                                        id="nome"
                                        class="form-input w-full @error('nome') border-danger @enderror"
                                        placeholder="Nome completo"
                                    >
                                    @error('nome')
                                        <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="tipo" class="block text-sm font-medium text-default-700 mb-1">Tipo</label>
                                    <select
                                        wire:model="tipo"
                                        id="tipo"
                                        class="form-input w-full @error('tipo') border-danger @enderror"
                                    >
                                        <option value="">Selecione um tipo</option>
                                        @foreach ($this->tipos as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('tipo')
                                        <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="contrato" class="block text-sm font-medium text-default-700 mb-1">Contrato</label>
                                    <select
                                        wire:model="contrato"
                                        id="contrato"
                                        class="form-input w-full @error('contrato') border-danger @enderror"
                                    >
                                        <option value="">Selecione um contrato</option>
                                        @foreach ($this->contratos as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('contrato')
                                        <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                @if ($editingId)
                                    <div>
                                        <label for="userName" class="block text-sm font-medium text-default-700 mb-1">Usuário</label>
                                        <input
                                            type="text"
                                            id="userName"
                                            class="form-input w-full bg-default-100"
                                            value="{{ $nome }}"
                                            disabled
                                        >
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
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-default-700 mb-1">E-mail</label>
                                        <input
                                            wire:model="email"
                                            type="email"
                                            id="email"
                                            class="form-input w-full @error('email') border-danger @enderror"
                                            placeholder="email@exemplo.com"
                                        >
                                        @error('email')
                                            <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-2 p-4 border-t border-default-200">
                            <button
                                type="button"
                                @click="$wire.closeModal()"
                                class="btn bg-default-200 text-default-600 hover:bg-default-300"
                            >
                                Cancelar
                            </button>
                            <button
                                type="submit"
                                class="btn bg-primary text-white hover:bg-primary/90"
                                wire:loading.attr="disabled"
                            >
                                <span wire:loading.remove wire:target="save">
                                    {{ $editingId ? 'Salvar Alterações' : 'Criar Colaborador' }}
                                </span>
                                <span wire:loading wire:target="save">
                                    Salvando...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>

    <!-- Modal Confirmar Exclusão -->
    <template x-teleport="body">
        <div
            x-show="showDeleteModal"
            x-cloak
            class="size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
            role="dialog"
            tabindex="-1"
            aria-labelledby="delete-modal-title"
        >
            <!-- Backdrop -->
            <div
                x-show="showDeleteModal"
                x-transition:enter="ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/50 pointer-events-auto"
                @click="$wire.closeDeleteModal()"
            ></div>

            <!-- Modal Content -->
            <div class="sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center relative z-10">
                <div
                    x-show="showDeleteModal"
                    x-transition:enter="ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="w-full flex flex-col bg-white border border-default-200 shadow-lg rounded-md pointer-events-auto"
                    @click.stop
                >
                    <div class="flex justify-between items-center p-4 border-b border-default-200">
                        <h3 id="delete-modal-title" class="font-bold text-default-800 text-base">
                            Excluir Colaborador
                        </h3>
                        <button type="button" aria-label="Fechar" @click="$wire.closeDeleteModal()">
                            <span class="sr-only">Fechar</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                    </div>

                    <div class="p-4 overflow-y-auto">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 flex items-center justify-center h-10 w-10 rounded-full bg-danger/10">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-danger"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                            </div>
                            <div>
                                <p class="text-sm text-default-500">
                                    Tem certeza que deseja excluir este colaborador? Esta ação não pode ser desfeita.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-2 p-4 border-t border-default-200">
                        <button
                            type="button"
                            @click="$wire.closeDeleteModal()"
                            class="btn bg-default-200 text-default-600 hover:bg-default-300"
                        >
                            Cancelar
                        </button>
                        <button
                            type="button"
                            wire:click="delete"
                            class="btn bg-danger text-white hover:bg-danger/90"
                            wire:loading.attr="disabled"
                        >
                            <span wire:loading.remove wire:target="delete">Excluir</span>
                            <span wire:loading wire:target="delete">Excluindo...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
