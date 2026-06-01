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
            <h6 class="card-title">Prazos</h6>
            <button @click="$wire.openCreateModal()" class="btn btn-sm bg-primary text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Novo Prazo
            </button>
        </div>

        <div class="card-header">
            <div class="relative max-w-md">
                <input
                    wire:model.live.debounce.300ms="search"
                    class="form-input form-input-sm ps-9"
                    placeholder="Buscar por nome"
                    type="text"
                />
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-default-500"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
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
                                    <th class="px-3.5 py-3 text-start" scope="col">Nome</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Prazo</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($this->prazos as $prazo)
                                    <tr wire:key="prazo-{{ $prazo->id }}" class="text-default-800 font-normal text-sm whitespace-nowrap">
                                        <td class="px-3.5 py-3">{{ $prazo->nome }}</td>
                                        <td class="px-3.5 py-3">{{ $prazo->prazo_formatado }}</td>
                                        <td class="px-3.5 py-3">
                                            <div class="flex items-center gap-2">
                                                <button
                                                    type="button"
                                                    @click="$wire.openEditModal({{ $prazo->id }})"
                                                    class="btn size-7.5 bg-default-200 hover:bg-primary/10 text-default-500 hover:text-primary"
                                                    title="Editar"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                                </button>
                                                <button
                                                    type="button"
                                                    @click="$wire.confirmDelete({{ $prazo->id }})"
                                                    class="btn size-7.5 bg-default-200 hover:bg-danger/10 text-default-500 hover:text-danger"
                                                    title="Excluir"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-3.5 py-8 text-center text-default-500">
                                            Nenhum prazo encontrado.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if ($this->prazos->hasPages())
                <div class="card-footer">
                    {{ $this->prazos->links() }}
                </div>
            @endif
        </div>
    </div>

    <template x-teleport="body">
        <div
            x-show="showModal"
            x-cloak
            class="size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
            role="dialog"
            tabindex="-1"
            aria-labelledby="modal-title"
        >
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
                            {{ $editingId ? 'Editar Prazo' : 'Novo Prazo' }}
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
                                        wire:model.blur="nome"
                                        type="text"
                                        id="nome"
                                        class="form-input w-full @error('nome') border-danger @enderror"
                                        placeholder="Ex.: Engenharia.Emergencial"
                                    >
                                    @error('nome')
                                        <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="prazoValor" class="block text-sm font-medium text-default-700 mb-1">Prazo</label>
                                        <input
                                            wire:model.blur="prazoValor"
                                            type="number"
                                            min="1"
                                            id="prazoValor"
                                            class="form-input w-full @error('prazoValor') border-danger @enderror"
                                            placeholder="Ex.: 6"
                                        >
                                        @error('prazoValor')
                                            <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="prazoUnidade" class="block text-sm font-medium text-default-700 mb-1">Unidade</label>
                                        <select
                                            wire:model.blur="prazoUnidade"
                                            id="prazoUnidade"
                                            class="form-input w-full @error('prazoUnidade') border-danger @enderror"
                                        >
                                            <option value="">Selecione</option>
                                            @foreach ($this->unidades as $value => $label)
                                                <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @error('prazoUnidade')
                                            <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
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
                                    {{ $editingId ? 'Salvar Alterações' : 'Criar Prazo' }}
                                </span>
                                <span wire:loading wire:target="save">Salvando...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>

    <template x-teleport="body">
        <div
            x-show="showDeleteModal"
            x-cloak
            class="size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
            role="dialog"
            tabindex="-1"
            aria-labelledby="delete-modal-title"
        >
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
                            Excluir Prazo
                        </h3>
                        <button type="button" aria-label="Fechar" @click="$wire.closeDeleteModal()">
                            <span class="sr-only">Fechar</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                    </div>

                    <div class="p-4 overflow-y-auto">
                        <p class="text-sm text-default-500">
                            Tem certeza que deseja excluir este prazo? Esta ação não pode ser desfeita.
                        </p>
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
