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
                        <table class="table-fixed min-w-full divide-y divide-default-200">
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
                                        <td class="px-3.5 py-3 text-primary cursor-pointer" @click="$wire.openEditModal({{ $ocorrencia->id }})">
                                            #{{ $ocorrencia->id }}
                                        </td>
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
                                        <td class="px-3.5 py-3 hs-tooltip [--placement:top] font-semibold">
                                            {{ Illuminate\Support\Str::limit($ocorrencia->titulo, 30) }}
                                            <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-default-900 text-xs font-medium text-white rounded" role="tooltip">
                                                {{ $ocorrencia->titulo }}
                                            </span>
                                        </td>
                                        <td class="px-3.5 py-3">
                                            {{ $ocorrencia->agencia }}
                                        </td>
                                        <td class="px-3.5 py-3">{{ Illuminate\Support\Str::limit($ocorrencia->colaborador?->nome_exibicao ?? '—', 30) }}</td>
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
    @include('livewire.admin.partials.modal-ocorrencia')

    <!-- Modal Confirmar Exclusão -->
    @include('livewire.admin.partials.modal-confirmar-exclusao')
</div>