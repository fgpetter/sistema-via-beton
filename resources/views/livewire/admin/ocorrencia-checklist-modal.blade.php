<div
    x-data="{ showModal: $wire.entangle('showModal') }"
    x-on:open-checklist-modal.window="$wire.openChecklistModal($event.detail.id, $event.detail.tipo)"
    x-on:keydown.escape.window="if (showModal) $wire.closeModal()"
    x-init="$watch('showModal', v => document.body.classList.toggle('overflow-hidden', v))"
>
    <template x-teleport="body">
        <div
            x-show="showModal"
            x-cloak
            class="size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
            role="dialog"
            tabindex="-1"
            aria-labelledby="checklist-modal-title"
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
                    <div class="flex justify-between items-start gap-4 p-4 border-b border-default-200">
                        <div>
                            <h3 id="checklist-modal-title" class="font-bold text-default-800 text-base">
                                Checklist de Levantamento para Manutenções Preventivas | {{ $form->tipo->label() }}
                            </h3>
                            @if ($this->ocorrencia)
                                <p class="mt-1 text-sm text-default-600 flex flex-wrap gap-x-4 gap-y-1">
                                    <span><strong class="text-default-800">Ocorrência:</strong> #{{ $this->ocorrencia->id }}</span>
                                    <span><strong class="text-default-800">Agência:</strong> {{ $this->ocorrencia->agencia }}</span>
                                    <span><strong class="text-default-800">Título:</strong> {{ $this->ocorrencia->titulo }}</span>
                                </p>
                            @endif
                        </div>
                        <button type="button" aria-label="Fechar" @click="$wire.closeModal()">
                            <span class="sr-only">Fechar</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                    </div>

                    <form wire:submit="save">
                        <div class="p-4 overflow-y-auto max-h-[70vh] space-y-6">
                            <p class="text-sm text-default-600">
                                Marque <strong>S</strong> se houver necessidade de intervenção, <strong>N</strong> se não houver e <strong>N/A</strong> se não se aplica.
                                Use os atalhos do cabeçalho de cada bloco para marcar todos os itens de uma vez.
                            </p>

                            @foreach ($form->tipo->blocos() as $bloco)
                                <section class="border border-default-200 rounded-md overflow-hidden" aria-labelledby="bloco-{{ $bloco->value }}">
                                    <header class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 px-3 py-2 bg-default-100 border-b border-default-200">
                                        <h4 id="bloco-{{ $bloco->value }}" class="font-semibold text-sm text-default-800">
                                            {{ $bloco->codigo() }} {{ $bloco->label() }}
                                        </h4>
                                        <div class="flex items-center gap-3 text-xs text-default-600">
                                            <span>Marcar todos:</span>
                                            @foreach (\App\Enums\ChecklistResposta::cases() as $resposta)
                                                <label class="inline-flex items-center gap-1 cursor-pointer">
                                                    <input
                                                        type="radio"
                                                        name="marcar-todos-{{ $bloco->value }}"
                                                        value="{{ $resposta->value }}"
                                                        wire:click="marcarBloco('{{ $bloco->value }}', '{{ $resposta->value }}')"
                                                        @checked($form->valorUnificado($bloco) === $resposta->value)
                                                    >
                                                    {{ $resposta->sigla() }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </header>

                                    @foreach ($bloco->itens() as $item)
                                        <div class="grid grid-cols-1 sm:grid-cols-[4.5rem_1fr_auto] items-center gap-2 px-3 py-2 border-b border-default-100 last:border-b-0">
                                            <span class="text-xs text-default-500">{{ $item->codigo() }}</span>
                                            <span class="text-sm text-default-800">{{ $item->label() }}</span>
                                            <div class="flex items-center gap-4">
                                                @foreach (\App\Enums\ChecklistResposta::cases() as $resposta)
                                                    <label class="inline-flex items-center gap-1 text-sm cursor-pointer">
                                                        <input
                                                            type="radio"
                                                            name="{{ $bloco->value }}-{{ $item->formKey() }}"
                                                            value="{{ $resposta->value }}"
                                                            wire:model="form.respostas.{{ $bloco->value }}.{{ $item->formKey() }}"
                                                            required
                                                        >
                                                        {{ $resposta->label() }}
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </section>
                            @endforeach

                            <div>
                                <label for="checklist-observacoes" class="block text-sm font-medium text-default-700 mb-1">Observações</label>
                                <textarea
                                    wire:model="form.observacoes"
                                    id="checklist-observacoes"
                                    rows="4"
                                    maxlength="5000"
                                    class="form-textarea rounded-md border-gray-300 w-full @error('form.observacoes') border-danger @enderror"
                                    placeholder="Observações gerais do levantamento (opcional)"
                                ></textarea>
                                @error('form.observacoes')
                                    <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 p-4 border-t border-default-200">
                            <div class="flex flex-col gap-1">
                                @if ($errors->isNotEmpty())
                                    <p class="text-sm text-danger">{{ $errors->first() }}</p>
                                @endif
                                @if ($this->ocorrencia?->{$form->tipo->relacao()})
                                    <a
                                        href="{{ route('admin.ocorrencias.checklist-pdf', [$this->ocorrencia->id, $form->tipo->value]) }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center text-sm font-medium text-primary hover:underline"
                                    >
                                        Visualizar PDF
                                    </a>
                                @endif
                            </div>
                            <div class="flex items-center justify-end gap-2">
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
                                    <span wire:loading.remove wire:target="save">Salvar e gerar PDF</span>
                                    <span wire:loading wire:target="save">Salvando...</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>
