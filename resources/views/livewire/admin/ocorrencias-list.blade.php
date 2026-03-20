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

    @include('layouts.partials/page-title', ['subtitle' => 'Admin', 'title' => 'Gestão de Ocorrências'])

    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Gestão de Ocorrências</h6>
            @can('admin')
                <div class="flex items-center gap-2">
                    <div x-data>
                        <input
                            type="file"
                            x-ref="importInput"
                            wire:model="importFile"
                            accept=".xlsx,.xls,.csv"
                            class="hidden"
                        />
                        <button
                            type="button"
                            @click="$refs.importInput.click()"
                            class="btn btn-sm bg-success/10 text-success hover:bg-success hover:text-white"
                            wire:loading.attr="disabled"
                            wire:target="importFile, importOcorrencias"
                        >
                            <span wire:loading.remove wire:target="importFile, importOcorrencias" class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                Importar Planilha
                            </span>
                            <span wire:loading wire:target="importFile, importOcorrencias" class="flex items-center">
                                <svg class="animate-spin me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                                Importando...
                            </span>
                        </button>
                    </div>

                    <button @click="$wire.openCreateModal()" class="btn btn-sm bg-primary text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Nova Ocorrência
                    </button>
                </div>
            @endcan
        </div>
        @error('importFile')
            <div class="px-4 pt-3">
                <div class="bg-danger/10 text-danger text-sm rounded px-4 py-2">{{ $message }}</div>
            </div>
        @enderror
        <div class="card-header">
            <div class="md:flex items-center md:space-y-0 space-y-4 gap-3 w-1/2">
                <div class="relative w-3/5">
                    <input
                        wire:model.live.debounce.300ms="search"
                        class="form-input form-input-sm ps-9"
                        placeholder="Buscar por título, agência ou responsável"
                        type="text"
                    />
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-default-500"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </div>
                </div>

                <div class="relative w-2/5">
                    <select wire:model.live="statusFilter" class="form-input form-input-sm">
                        <option value="">Todos os status</option>
                        @foreach ($this->statuses as $value => $label)
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
                                    <th class="px-3.5 py-3 text-start" scope="col">Status</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Categoria</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Título</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Agência</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Responsável</th>
                                    <th class="px-3.5 py-3 text-center" scope="col">Fotos</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Abertura</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">RAT enviada</th>
                                    @can('admin') <th class="px-3.5 py-3 text-start" scope="col">Ações</th> @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($this->ocorrencias as $ocorrencia)
                                    <tr wire:key="ocorrencia-{{ $ocorrencia->id }}" class="text-default-800 font-normal text-sm whitespace-nowrap {{ $ocorrencia->isEmergencial() ? 'bg-danger/10 border-l-4 border-l-danger' : '' }}">
                                        <td class="px-3.5 py-3 text-primary">#{{ $ocorrencia->id }}</td>
                                        <td class="px-3.5 py-3">
                                            <span class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-{{ $ocorrencia->status->color() }}/10 text-{{ $ocorrencia->status->color() }} rounded">
                                                {{ $ocorrencia->status->label() }}
                                            </span>
                                            @if ($ocorrencia->status === \App\Enums\OcorrenciaStatus::Concluido && $ocorrencia->concluidoPor)
                                                <p class="text-xs text-default-400 mt-0.5">por {{ $ocorrencia->concluidoPor->name }}</p>
                                            @endif
                                        </td>
                                        <td class="px-3.5 py-3">
                                            @if ($ocorrencia->isEmergencial())
                                                <span class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-bold bg-danger/15 text-danger rounded">
                                                    {{ \App\Enums\PrazoNome::labelFor($ocorrencia->prazo?->nome) }}
                                                </span>
                                            @else
                                                <span class="text-default-600">{{ \App\Enums\PrazoNome::labelFor($ocorrencia->prazo?->nome) }}</span>
                                            @endif
                                        </td>
                                        <td class="px-3.5 py-3">
                                            <h6 class="mb-0.5 font-semibold text-default-800">{{ $ocorrencia->titulo }}</h6>
                                        </td>
                                        <td class="px-3.5 py-3">
                                            {{ $ocorrencia->agencia }}
                                            @if ($ocorrencia->enderecoVinculado)
                                                <p class="text-xs text-default-400 mt-0.5">nº {{ $ocorrencia->enderecoVinculado->numero }} · {{ $ocorrencia->enderecoVinculado->fone ?: '—' }}</p>
                                            @endif
                                        </td>
                                        <td class="px-3.5 py-3">{{ $ocorrencia->colaborador?->nome_exibicao ?? '—' }}</td>
                                        <td class="px-3.5 py-3 text-center">
                                            @if ($ocorrencia->imagens_count > 0)
                                                <span class="inline-flex items-center gap-1 text-primary" title="{{ $ocorrencia->imagens_count }} foto(s)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                                    <span class="text-xs font-medium">{{ $ocorrencia->imagens_count }}</span>
                                                </span>
                                            @else
                                                <span class="text-default-300">—</span>
                                            @endif
                                        </td>
                                        <td class="px-3.5 py-3">{{ $ocorrencia->abertura->format('d/m/Y') }}</td>
                                        <td class="px-3.5 py-3">
                                            @if ($ocorrencia->email_enviado)
                                                <span class="text-success">{{ $ocorrencia->email_enviado->format('d/m/Y H:i') }}</span>
                                            @else
                                                <span class="text-default-400">—</span>
                                            @endif
                                        </td>
                                        @can('admin')
                                        <td class="px-3.5 py-3">
                                            <div class="flex items-center gap-2">
                                                @if ($ocorrencia->status === \App\Enums\OcorrenciaStatus::Revisar)
                                                    <button
                                                        type="button"
                                                        wire:click="concluirRevisao({{ $ocorrencia->id }})"
                                                        wire:confirm="Confirma a conclusão da revisão desta ocorrência?"
                                                        class="btn size-7.5 bg-success/10 hover:bg-success/20 text-success"
                                                        title="Concluir Revisão"
                                                        wire:loading.attr="disabled"
                                                        wire:target="concluirRevisao({{ $ocorrencia->id }})"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                                    </button>
                                                @endif
                                                <button
                                                    type="button"
                                                    @click="$wire.openEditModal({{ $ocorrencia->id }})"
                                                    class="btn size-7.5 bg-default-200 hover:bg-primary/10 text-default-500 hover:text-primary"
                                                    title="Editar"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                                </button>
                                                <button
                                                    type="button"
                                                    @click="$wire.confirmDelete({{ $ocorrencia->id }})"
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
                                        <td colspan="{{ auth()->user()?->isAdmin() ? 10 : 9 }}" class="px-3.5 py-8 text-center text-default-500">
                                            <div class="flex flex-col items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-default-300"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                                                <p>Nenhuma ocorrência encontrada.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if ($this->ocorrencias->hasPages())
                <div class="card-footer">
                    {{ $this->ocorrencias->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Criar/Editar Ocorrência -->
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
            <div class="sm:max-w-4xl lg:max-w-none lg:w-2/3 sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center relative z-10">
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
                            {{ $form->editingId ? 'Editar Ocorrência' : 'Nova Ocorrência' }}
                        </h3>
                        <button type="button" aria-label="Fechar" @click="$wire.closeModal()">
                            <span class="sr-only">Fechar</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                    </div>

                    <form wire:submit="save">
                        <div class="p-4 overflow-y-auto max-h-[70vh]">
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                                    <div>
                                        <label for="status" class="block text-sm font-medium text-default-700 mb-1">Status</label>
                                        <select
                                            wire:model="form.status"
                                            id="status"
                                            class="form-input w-full @error('status') border-danger @enderror"
                                        >
                                            <option value="">Selecione um status</option>
                                            @foreach ($this->statuses as $value => $label)
                                                <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @error('form.status')
                                            <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="abertura" class="block text-sm font-medium text-default-700 mb-1">Data de Abertura</label>
                                        <input
                                            wire:model="form.abertura"
                                            type="date"
                                            id="abertura"
                                            class="form-input w-full @error('abertura') border-danger @enderror"
                                        >
                                        @error('form.abertura')
                                            <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="titulo" class="block text-sm font-medium text-default-700 mb-1">Título</label>
                                    <input
                                        wire:model="form.titulo"
                                        type="text"
                                        id="titulo"
                                        class="form-input w-full @error('titulo') border-danger @enderror"
                                        placeholder="Resumo da ocorrência"
                                    >
                                    @error('form.titulo')
                                        <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="descricao" class="block text-sm font-medium text-default-700 mb-1">Descrição</label>
                                    <textarea
                                        wire:model="form.descricao"
                                        id="descricao"
                                        rows="3"
                                        class="form-input w-full @error('descricao') border-danger @enderror"
                                        placeholder="Descrição detalhada (opcional)"
                                    ></textarea>
                                    @error('form.descricao')
                                        <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="prazoId" class="block text-sm font-medium text-default-700 mb-1">Categoria</label>
                                    <select
                                        wire:model="form.prazoId"
                                        id="prazoId"
                                        class="form-input w-full @error('prazoId') border-danger @enderror"
                                    >
                                        <option value="">Selecione uma categoria</option>
                                        @foreach ($this->prazos as $id => $nome)
                                            <option value="{{ $id }}">{{ $nome }}</option>
                                        @endforeach
                                    </select>
                                    @error('form.prazoId')
                                        <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="agencia" class="block text-sm font-medium text-default-700 mb-1">Agência</label>
                                        <input
                                            wire:model="form.agencia"
                                            type="text"
                                            id="agencia"
                                            class="form-input w-full @error('agencia') border-danger @enderror"
                                            placeholder="Usuário final afetado"
                                        >
                                        @error('form.agencia')
                                            <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="colaboradorId" class="block text-sm font-medium text-default-700 mb-1">Responsável</label>
                                        <select
                                            wire:model="form.colaboradorId"
                                            id="colaboradorId"
                                            class="form-input w-full @error('colaboradorId') border-danger @enderror"
                                        >
                                            <option value="">Sem responsável</option>
                                            @foreach ($this->colaboradores as $id => $nome)
                                                <option value="{{ $id }}">{{ $nome }}</option>
                                            @endforeach
                                        </select>
                                        @error('form.colaboradorId')
                                            <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                @if ($this->editingOcorrencia?->enderecoVinculado)
                                    <div class="bg-default-50 border border-default-200 rounded p-3 space-y-1">
                                        <span class="text-xs font-medium text-default-500 uppercase">Endereço Vinculado</span>
                                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-sm">
                                            <div>
                                                <span class="text-default-500">Agência nº:</span>
                                                <strong class="text-default-800">{{ $this->editingOcorrencia->enderecoVinculado->numero }}</strong>
                                            </div>
                                            <div>
                                                <span class="text-default-500">Endereço:</span>
                                                <strong class="text-default-800">{{ $this->editingOcorrencia->enderecoVinculado->endereco }}{{ $this->editingOcorrencia->enderecoVinculado->cidade_estado ? ', ' . $this->editingOcorrencia->enderecoVinculado->cidade_estado : '' }}</strong>
                                            </div>
                                            <div>
                                                <span class="text-default-500">Fone:</span>
                                                <strong class="text-default-800">{{ $this->editingOcorrencia->enderecoVinculado->fone ?: '—' }}</strong>
                                            </div>
                                            <div>
                                                <span class="text-default-500">Horário:</span>
                                                <strong class="text-default-800">{{ $this->editingOcorrencia->enderecoVinculado->horario ?: '—' }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                                <!-- Fotos (Collapse) - Disponível apenas na edição -->
                                @if ($form->editingId)
                                    <div class="border border-blue-200 rounded-md bg-blue-50" x-data="{ fotosOpen: false }">
                                        <button
                                            type="button"
                                            @click="fotosOpen = !fotosOpen"
                                            class="w-full px-4 py-3 flex justify-between items-center cursor-pointer"
                                        >
                                            <span class="text-sm font-medium text-default-700 flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                                Fotos
                                            </span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-default-500 transition-transform duration-200" :class="fotosOpen && 'rotate-180'"><polyline points="6 9 12 15 18 9"/></svg>
                                        </button>
                                        <div x-show="fotosOpen" x-collapse>
                                            <div class="px-4 pb-4 space-y-3">
                                                <div class="grid grid-cols-2 gap-2 text-center">
                                                    <span class="text-xs font-semibold text-default-500 uppercase">Antes</span>
                                                    <span class="text-xs font-semibold text-default-500 uppercase">Depois</span>
                                                </div>

                                                @foreach ($this->editingFotoPares as $par => $fotos)
                                                    <div wire:key="admin-par-{{ $par }}" class="grid grid-cols-2 gap-3">
                                                        <!-- ANTES -->
                                                        @if ($fotos['antes'])
                                                            <div class="relative group aspect-square">
                                                                <img src="{{ asset('storage/' . $fotos['antes']->path) }}" alt="Antes" class="w-full h-full object-cover rounded border border-default-200">
                                                                <span class="absolute bottom-1 left-1 py-0.5 px-1.5 text-[10px] font-semibold uppercase bg-black/60 text-white rounded">Antes</span>
                                                                <button
                                                                    type="button"
                                                                    wire:click="removerImagem({{ $fotos['antes']->id }})"
                                                                    wire:confirm="Remover esta imagem?"
                                                                    class="absolute top-1 right-1 size-5 bg-danger text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                                                                >
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                                                </button>
                                                            </div>
                                                        @else
                                                            <div
                                                                @click="$wire.uploadingPar = {{ $par }}; $wire.uploadingTipo = 'antes'; $nextTick(() => $refs.fotoInputAdmin.click())"
                                                                class="aspect-square border-2 border-dashed border-default-300 rounded flex flex-col items-center justify-center cursor-pointer hover:border-primary hover:bg-primary/5 transition-colors"
                                                            >
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-default-300"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                                                <span class="text-[10px] text-default-400 mt-1 uppercase font-medium">Antes</span>
                                                            </div>
                                                        @endif

                                                        <!-- DEPOIS -->
                                                        @if ($fotos['depois'])
                                                            <div class="relative group aspect-square">
                                                                <img src="{{ asset('storage/' . $fotos['depois']->path) }}" alt="Depois" class="w-full h-full object-cover rounded border border-default-200">
                                                                <span class="absolute bottom-1 left-1 py-0.5 px-1.5 text-[10px] font-semibold uppercase bg-black/60 text-white rounded">Depois</span>
                                                                <button
                                                                    type="button"
                                                                    wire:click="removerImagem({{ $fotos['depois']->id }})"
                                                                    wire:confirm="Remover esta imagem?"
                                                                    class="absolute top-1 right-1 size-5 bg-danger text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                                                                >
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                                                </button>
                                                            </div>
                                                        @else
                                                            <div class="aspect-square border-2 border-dashed border-default-200 rounded flex flex-col items-center justify-center bg-default-50">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-default-200"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                                                <span class="text-[10px] text-default-300 mt-1 uppercase font-medium">Depois</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach

                                                <div wire:loading wire:target="fotoUpload" class="text-sm text-primary text-center py-2">
                                                    Carregando imagem...
                                                </div>

                                                <button
                                                    type="button"
                                                    wire:click="adicionarPar"
                                                    class="btn w-full border-2 border-dashed border-default-300 text-default-500 hover:border-primary hover:text-primary hover:bg-primary/5 transition-colors text-sm"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                                    Adicionar Foto
                                                </button>

                                                <input x-ref="fotoInputAdmin" wire:model="fotoUpload" type="file" accept="image/*" class="hidden">
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div>
                                    <label for="comentarios" class="block text-sm font-medium text-default-700 mb-1">Comentários</label>
                                    <textarea
                                        wire:model="form.comentarios"
                                        id="comentarios"
                                        rows="3"
                                        class="form-input w-full @error('comentarios') border-danger @enderror"
                                        placeholder="Comentários adicionais (opcional)"
                                    ></textarea>
                                    @error('form.comentarios')
                                        <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                    @enderror
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
                                    {{ $form->editingId ? 'Salvar Alterações' : 'Criar Ocorrência' }}
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
                            Excluir Ocorrência
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
                                    Tem certeza que deseja excluir esta ocorrência? Esta ação não pode ser desfeita.
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