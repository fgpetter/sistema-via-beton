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
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
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
                                        class="form-textarea rounded-md border-gray-300 w-full @error('descricao') border-danger @enderror"
                                        placeholder="Descrição detalhada (opcional)"
                                    ></textarea>
                                    @error('form.descricao')
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

                                @if ($form->editingId && $this->editingOcorrencia?->email_rat_enviado && $this->editingOcorrencia?->rat_pdf_path)
                                    <div class="bg-green-50 border border-green-200 rounded p-3 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                        <div>
                                            <span class="text-xs font-medium text-default-500 uppercase">RAT enviada por e-mail</span>
                                            <p class="text-sm text-default-700">
                                                Enviada em {{ $this->editingOcorrencia->email_rat_enviado->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                        <a
                                            href="{{ route('admin.ocorrencias.rat-pdf', $this->editingOcorrencia) }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="inline-flex items-center justify-center text-sm font-medium text-primary hover:underline"
                                        >
                                            Visualizar PDF da RAT
                                        </a>
                                    </div>
                                @endif

                                @if ($form->editingId)
                                    <livewire:admin.ocorrencia-foto-galeria
                                        :ocorrencia-id="$form->editingId"
                                        :wire:key="'foto-galeria-' . $form->editingId"
                                    />
                                @endif

                                @if ($form->comentarios_prestador && $form->comentarios_prestador !== '')
                                <div>
                                    <label for="comentarios" class="block text-sm font-medium text-default-700 mb-1">Comentários do Prestador</label>
                                    <textarea
                                        wire:model="form.comentarios_prestador"
                                        id="comentarios_prestador"
                                        rows="3"
                                        class="form-textarea rounded-md border-gray-300 w-full"
                                        readonly
                                    ></textarea>
                                </div>

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
