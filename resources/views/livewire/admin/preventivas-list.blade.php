<div
    x-data="{
        showDeleteModal: @entangle('showDeleteModal'),
        columns: {
            status: true,
            abertura: true
        }
    }"
    x-init="
        $watch('showDeleteModal', value => {
            if (value) document.body.classList.add('overflow-hidden');
            else document.body.classList.remove('overflow-hidden');
        });
    "
>

    @include('layouts.partials/page-title', ['subtitle' => 'Admin', 'title' => 'Gestão de Preventivas'])

    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Gestão de Preventivas</h6>
            @can('admin')
                <button @click="$dispatch('open-create-modal-preventiva')" class="btn btn-sm bg-primary text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Nova Preventiva
                </button>
            @endcan
        </div>
        <div class="card-header">
            <div class="flex flex-col gap-3 xl:flex-row xl:flex-wrap xl:items-center xl:my-3 w-full">
                <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center flex-1 min-w-0">
                    <div class="relative w-full max-w-md">
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
                    <div class="relative w-full sm:w-48 shrink-0">
                        <select wire:model.live="statusFilter" class="form-input form-input-sm w-full">
                            <option value="">Todos os status</option>
                            @foreach ($this->statuses as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-default-600">
                        <span class="text-default-500 shrink-0">Colunas:</span>
                        <label class="inline-flex items-center gap-1.5 cursor-pointer select-none">
                            <input type="checkbox" x-model="columns.status" class="rounded border-default-300 text-primary focus:ring-primary/30 size-3.5">
                            <span>Status</span>
                        </label>
                        <label class="inline-flex items-center gap-1.5 cursor-pointer select-none">
                            <input type="checkbox" x-model="columns.abertura" class="rounded border-default-300 text-primary focus:ring-primary/30 size-3.5">
                            <span>Abertura</span>
                        </label>
                    </div>
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
                                    <th x-show="columns.status" class="px-3.5 py-3 text-start" scope="col">Status</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Título</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Agência</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Responsável</th>
                                    <th class="px-3.5 py-3 text-center" scope="col">Fotos</th>
                                    <th x-show="columns.abertura" class="px-3.5 py-3 text-start" scope="col">Abertura</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($this->preventivas as $preventiva)
                                    <tr wire:key="preventiva-{{ $preventiva->id }}" class="text-default-800 font-normal text-sm whitespace-nowrap">
                                        <td class="px-3.5 py-3 text-primary cursor-pointer" @click="$dispatch('open-edit-modal-preventiva', {id: {{ $preventiva->id }}})">
                                            #{{ $preventiva->id }}
                                        </td>
                                        <td x-show="columns.status" class="px-3.5 py-3">
                                            <span class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-{{ $preventiva->status->color() }}/10 text-{{ $preventiva->status->color() }} rounded">
                                                {{ $preventiva->status->label() }}
                                            </span>
                                            @if ($preventiva->status === \App\Enums\PreventivaStatus::Concluido && $preventiva->concluidoPor)
                                                <p class="text-xs text-default-400 mt-0.5">por {{ $preventiva->concluidoPor->name }}</p>
                                            @endif
                                        </td>
                                        <td class="px-3.5 py-3 hs-tooltip [--placement:top] font-semibold">
                                            {{ Illuminate\Support\Str::limit($preventiva->titulo, 30) }}
                                            <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-default-900 text-xs font-medium text-white rounded" role="tooltip">
                                                {{ $preventiva->titulo }}
                                            </span>
                                        </td>
                                        <td class="px-3.5 py-3">
                                            {{ $preventiva->agencia }}
                                        </td>
                                        <td class="px-3.5 py-3">{{ Illuminate\Support\Str::limit($preventiva->colaborador?->nome_exibicao ?? '—', 30) }}</td>
                                        <td class="px-3.5 py-3 text-center">
                                            @if ($preventiva->imagens_count > 0)
                                                <span class="inline-flex items-center gap-1 text-primary" title="{{ $preventiva->imagens_count }} foto(s)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                                    <span class="text-xs font-medium">{{ $preventiva->imagens_count }}</span>
                                                    @if ($preventiva->imagens_recusadas_count > 0)
                                                        <span class="text-xs text-danger">({{ $preventiva->imagens_recusadas_count }} recusada(s))</span>
                                                    @endif
                                                </span>
                                            @else
                                                <span class="text-default-300">—</span>
                                            @endif
                                        </td>
                                        <td x-show="columns.abertura" class="px-3.5 py-3">{{ $preventiva->abertura->format('d/m/Y') }}</td>
                                        <td class="px-3.5 py-3">
                                            <div class="flex items-center gap-2">
                                                <button
                                                    type="button"
                                                    @click="$dispatch('open-edit-modal-preventiva', {id: {{ $preventiva->id }}})"
                                                    class="btn size-7.5 bg-default-200 hover:bg-primary/10 text-default-500 hover:text-primary"
                                                    title="Editar"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                                </button>
                                                @if ($preventiva->status === \App\Enums\PreventivaStatus::Concluido)
                                                    <a
                                                        href="{{ route('admin.preventivas.vistoria-pdf', $preventiva) }}"
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                        class="btn size-7.5 bg-default-200 hover:bg-success/10 text-default-500 hover:text-success"
                                                        title="Relatório de Vistoria"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                                                    </a>
                                                    <a
                                                        href="{{ route('admin.preventivas.relatorio-executivo-pdf', $preventiva) }}"
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                        class="btn size-7.5 bg-default-200 hover:bg-success/10 text-default-500 hover:text-success"
                                                        title="Relatório Executivo"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                                                    </a>
                                                @endif
                                                <button
                                                    type="button"
                                                    @click="$wire.confirmDelete({{ $preventiva->id }})"
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
                                        <td
                                            x-bind:colspan="7 + (columns.status ? 1 : 0) + (columns.abertura ? 1 : 0)"
                                            class="px-3.5 py-8 text-center text-default-500"
                                        >
                                            <div class="flex flex-col items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-default-300"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                                                <p>Nenhuma preventiva encontrada.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if ($this->preventivas->hasPages())
                <div class="card-footer">
                    {{ $this->preventivas->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Criar/Editar Preventiva -->
    <livewire:admin.preventiva-modal wire:key="preventiva-modal" />

    <!-- Modal Confirmar Exclusão -->
    @include('livewire.admin.partials.modal-confirmar-exclusao')
</div>
