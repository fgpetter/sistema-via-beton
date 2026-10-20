<div
    x-data="{ showModal: $wire.entangle('showModal') }"
    x-on:open-edit-modal-programada.window="$wire.openEditModal($event.detail.id)"
    x-on:open-create-modal-programada.window="$wire.openCreateModal()"
    x-init="$watch('showModal', v => { document.body.classList.toggle('overflow-hidden', v); if (v) $nextTick(() => window.initializeModalSelects?.()) })"
>
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
                            {{ $isDraft ? 'Nova Programada' : 'Editar Programada' }}
                        </h3>
                        <button type="button" aria-label="Fechar" @click="$wire.closeModal()">
                            <span class="sr-only">Fechar</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                    </div>

                    <form wire:submit="save">
                        <div class="p-4 overflow-y-auto max-h-[70vh]">
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 sm:grid-cols-6 gap-4">
                                    <div class="sm:col-span-2 min-w-0">
                                        <label for="tipo" class="block text-sm font-medium text-default-700 mb-1">Tipo</label>
                                        <select data-modal-select wire:model="form.tipo" id="tipo" class="form-input w-full @error('form.tipo') border-danger @enderror">
                                            <option value="">Selecione um tipo</option>
                                            @foreach ($this->tipos as $value => $label)<option value="{{ $value }}">{{ $label }}</option>@endforeach
                                        </select>
                                        @error('form.tipo')<p class="mt-1 text-sm text-danger">{{ $message }}</p>@enderror
                                    </div>
                                    <div class="sm:col-span-1 min-w-0">
                                        <label for="status" class="block text-sm font-medium text-default-700 mb-1">Status</label>
                                        <select data-modal-select
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

                                    <div class="sm:col-span-1 min-w-0">
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

                                    <div class="sm:col-span-2 min-w-0">
                                        <label for="responsavelEngenhariaId" class="block text-sm font-medium text-default-700 mb-1">Resp. Eng. Banrisul</label>
                                        <select data-modal-select
                                            wire:model="form.responsavelEngenhariaId"
                                            id="responsavelEngenhariaId"
                                            class="form-input w-full @error('responsavelEngenhariaId') border-danger @enderror"
                                        >
                                            <option value="">Nenhum</option>
                                            @foreach ($this->responsaveisEngenhariaBanrisul as $id => $label)
                                                <option value="{{ $id }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @error('form.responsavelEngenhariaId')
                                            <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>

                                @if ($this->editingProgramada?->colaborador?->tipo === \App\Enums\TipoColaborador::Administrativos)
                                <div>
                                    <label for="prestadorNome" class="block text-sm font-medium text-default-700 mb-1">Nome do Prestador (RAT)</label>
                                    <input wire:model="form.prestadorNome" id="prestadorNome" type="text" class="form-input w-full" placeholder="Usado quando o responsável é Administrativo">
                                </div>
                                @endif

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach ([['dataChegada', 'Data de Chegada'], ['dataSaida', 'Data de Saída']] as [$campoData, $rotuloData])
                                        <div>
                                            <label for="{{ $campoData }}" class="block text-sm font-medium text-default-700 mb-1">{{ $rotuloData }}</label>
                                            <input wire:model="form.{{ $campoData }}" type="date" id="{{ $campoData }}" class="form-input w-full @error('form.' . $campoData) border-danger @enderror">
                                            @error('form.' . $campoData)<p class="mt-1 text-sm text-danger">{{ $message }}</p>@enderror
                                        </div>
                                    @endforeach
                                </div>

                                <div>
                                    <label for="titulo" class="block text-sm font-medium text-default-700 mb-1">Título</label>
                                    <input
                                        wire:model="form.titulo"
                                        type="text"
                                        id="titulo"
                                        class="form-input w-full @error('titulo') border-danger @enderror"
                                        placeholder="Resumo da programada"
                                    >
                                    @error('form.titulo')
                                        <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                                    <div>
                                        <label for="disciplinaId" class="block text-sm font-medium text-default-700 mb-1">Disciplina</label>
                                        <select data-modal-select wire:model="form.disciplinaId" id="disciplinaId" class="form-input w-full">
                                            <option value="">Nenhuma</option>
                                            @foreach ($this->disciplinasOptions as $id => $nome)<option value="{{ $id }}">{{ $nome }}</option>@endforeach
                                        </select>
                                        @error('form.disciplinaId')<p class="mt-1 text-sm text-danger">{{ $message }}</p>@enderror
                                    </div>
                                    @foreach (range(1, 3) as $numeroSubdisciplina)
                                        <div>
                                            <label for="subdisciplina{{ $numeroSubdisciplina }}Id" class="block text-sm font-medium text-default-700 mb-1">Subdisciplina {{ $numeroSubdisciplina }}</label>
                                            <select data-modal-select wire:model="form.subdisciplina{{ $numeroSubdisciplina }}Id" id="subdisciplina{{ $numeroSubdisciplina }}Id" class="form-input w-full">
                                                <option value="">Nenhuma</option>
                                                @foreach ($this->subdisciplinasOptions as $id => $nome)<option value="{{ $id }}">{{ $nome }}</option>@endforeach
                                            </select>
                                            @error('form.subdisciplina' . $numeroSubdisciplina . 'Id')<p class="mt-1 text-sm text-danger">{{ $message }}</p>@enderror
                                        </div>
                                    @endforeach
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                                    @foreach (range(4, 6) as $numeroSubdisciplina)
                                        <div>
                                            <label for="subdisciplina{{ $numeroSubdisciplina }}Id" class="block text-sm font-medium text-default-700 mb-1">Subdisciplina {{ $numeroSubdisciplina }}</label>
                                            <select data-modal-select wire:model="form.subdisciplina{{ $numeroSubdisciplina }}Id" id="subdisciplina{{ $numeroSubdisciplina }}Id" class="form-input w-full">
                                                <option value="">Nenhuma</option>
                                                @foreach ($this->subdisciplinasOptions as $id => $nome)<option value="{{ $id }}">{{ $nome }}</option>@endforeach
                                            </select>
                                            @error('form.subdisciplina' . $numeroSubdisciplina . 'Id')<p class="mt-1 text-sm text-danger">{{ $message }}</p>@enderror
                                        </div>
                                    @endforeach
                                </div>

                                <div>
                                    <label for="descricao" class="block text-sm font-medium text-default-700 mb-1">Descrição (visível no relatório)</label>
                                    <textarea
                                        wire:model="form.descricao"
                                        id="descricao"
                                        rows="3"
                                        class="form-textarea rounded-md border-gray-300 w-full @error('descricao') border-danger @enderror"
                                        placeholder="Preencha esse campo e salve para que seja gerado o relatório."
                                    ></textarea>
                                    @error('form.descricao')
                                        <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                    @if (blank(trim((string) $form->descricao)))
                                        <small class="text-warning mt-0">Preencha o campo descrição para que o relatório possa ser gerado.</small>
                                    @endif
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
                                        <select data-modal-select
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

                                @if ($this->editingProgramada?->enderecoVinculado)
                                    <div class="bg-default-50 border border-default-200 rounded p-3 space-y-1">
                                        <span class="text-xs font-medium text-default-500 uppercase">Endereço Vinculado</span>
                                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-sm">
                                            <div>
                                                <span class="text-default-500">Agência nº:</span>
                                                <strong class="text-default-800">{{ $this->editingProgramada->enderecoVinculado->numero }}</strong>
                                            </div>
                                            <div>
                                                <span class="text-default-500">Endereço:</span>
                                                <strong class="text-default-800">{{ $this->editingProgramada->enderecoVinculado->endereco }}{{ $this->editingProgramada->enderecoVinculado->cidade_estado ? ', ' . $this->editingProgramada->enderecoVinculado->cidade_estado : '' }}</strong>
                                            </div>
                                            <div>
                                                <span class="text-default-500">Fone:</span>
                                                <strong class="text-default-800">{{ $this->editingProgramada->enderecoVinculado->fone ?: '—' }}</strong>
                                            </div>
                                            <div>
                                                <span class="text-default-500">Horário:</span>
                                                <strong class="text-default-800">{{ $this->editingProgramada->enderecoVinculado->horario ?: '—' }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($this->editingProgramada?->rat_pdf_path && $this->editingProgramada?->email_rat_enviado)
                                    <div class="bg-green-50 border border-green-200 rounded p-3 flex items-center justify-between gap-3">
                                        <div><span class="text-xs font-medium uppercase text-default-500">RAT enviada por e-mail</span><p class="text-sm">{{ $this->editingProgramada->email_rat }} · {{ $this->editingProgramada->email_rat_enviado->format('d/m/Y H:i') }}</p></div>
                                        <div class="flex gap-3">
                                            <a href="{{ route('admin.programadas.rat-pdf', $this->editingProgramada) }}" target="_blank" class="text-sm text-primary hover:underline">Visualizar RAT</a>
                                            <button type="button" class="text-sm text-primary hover:underline" x-on:click="(async () => { if (!window.Swal) { window.Swal = (await import('https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.esm.all.min.js')).default; } const r = await window.Swal.fire({text:'Salvar dados e gerar nova RAT sem reenviar?',icon:'question',showCancelButton:true,confirmButtonText:'Confirmar',cancelButtonText:'Cancelar'}); if(r.isConfirmed) $wire.gerarNovaRat() })()">Gerar nova RAT</button>
                                        </div>
                                    </div>
                                @endif

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    @if ($this->editingProgramada && $this->editingProgramada->relatoriosDisponiveis())
                                        <div class="bg-blue-50 border border-blue-200 rounded p-3 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                            <div>
                                                <span class="text-xs font-medium text-default-500 uppercase">Relatório Técnico Fotográfico</span>
                                            </div>
                                            <a
                                                href="{{ route('admin.programadas.vistoria-pdf', $this->editingProgramada) }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="inline-flex items-center justify-center text-sm font-medium text-primary hover:underline"
                                            >
                                                Baixar relatório
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                @if ($this->editingProgramada?->status === \App\Enums\ProgramadaStatus::Revisar)
                                    <button type="button" wire:click="concluirRevisao({{ $this->editingProgramada->id }})" class="btn bg-success text-white">Concluir revisão</button>
                                @endif

                                @if ($form->editingId)
                                    <livewire:admin.foto-galeria
                                        registro-tipo="programada"
                                        :registro-id="$form->editingId"
                                        :wire:key="'foto-galeria-programada-' . $form->editingId"
                                    />
                                @endif

                                <div>
                                    <label for="comentarios" class="block text-sm font-medium text-default-700 mb-1">Comentários Internos</label>
                                    <textarea
                                        wire:model="form.comentarios"
                                        id="comentarios"
                                        rows="3"
                                        class="form-textarea rounded-md border-gray-300 w-full @error('comentarios') border-danger @enderror"
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
                                    {{ $isDraft ? 'Criar Programada' : 'Salvar Alterações' }}
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
</div>
