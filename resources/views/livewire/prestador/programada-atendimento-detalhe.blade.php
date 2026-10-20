@php
    use App\Enums\ProgramadaStatus;
@endphp

<div>
    @include('layouts.partials/page-title', ['subtitle' => 'Atendimentos', 'title' => 'Detalhes do Atendimento'])

    <div class="mb-4">
        <a href="{{ route('prestador.atendimentos') }}" class="inline-flex items-center gap-1 text-sm text-primary hover:underline">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            Voltar aos atendimentos
        </a>
    </div>

    <!-- Detalhes da Programada -->
    <div class="card mb-4">
        <div class="card-header">
            <h6 class="card-title">{{ $this->programada->agencia }} - {{ $this->programada->id }}</h6>
            <span class="py-0.5 px-2.5 inline-flex items-center text-xs font-medium bg-{{ $this->programada->status->color() }}/10 text-{{ $this->programada->status->color() }} rounded">
                {{ $this->programada->status->label() }}
            </span>
        </div>
        <div class="card-body space-y-3">
            <div>
                <span class="text-sm font-medium text-primary">{{ $this->programada->tipo->label() }}</span><br><span class="uppercase">Título</span>
                <p class="text-xl text-default-800">{{ $this->programada->titulo }}</p>
            </div>
            @if ($this->programada->descricao)
                <div>
                    <span class="uppercase">Descrição</span>
                    <p class="text-default-800">{{ $this->programada->descricao }}</p>
                </div>
            @endif
            @if ($this->programada->enderecoVinculado)
                <div>
                    <span class="uppercase">Dados do Endereço</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
                        @if ($this->programada->enderecoVinculado->numero)
                            <div>
                                <span>Agência nº:</span>
                                <strong class="text-default-800">{{ $this->programada->enderecoVinculado->numero }}</strong>
                            </div>
                        @endif
                        @if ($this->programada->enderecoVinculado->endereco)
                            <div>
                                <span>Endereço:</span>
                                <strong class="text-default-800">{{ $this->programada->enderecoVinculado->endereco }}{{ $this->programada->enderecoVinculado->cidade_estado ? ', ' . $this->programada->enderecoVinculado->cidade_estado : '' }}</strong>
                            </div>
                        @endif
                        @if ($this->programada->enderecoVinculado->fone)
                            <div>
                                <span class="text-default-500">Fone:</span>
                                <strong class="text-default-800">{{ $this->programada->enderecoVinculado->fone }}</strong>
                            </div>
                        @endif
                        @if ($this->programada->enderecoVinculado->horario)
                            <div>
                                <span class="text-default-500">Horário:</span>
                                <strong class="text-default-800">{{ $this->programada->enderecoVinculado->horario }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            @elseif ($this->programada->endereco)
                <div>
                    <span class="text-xs font-medium text-default-500 uppercase">Endereço</span>
                    <p class="text-default-800">{{ $this->programada->endereco }}</p>
                </div>
            @endif
            <div class="flex flex-wrap gap-4 text-sm text-default-500">
                <span>Abertura: <strong>{{ $this->programada->abertura->format('d/m/Y') }}</strong></span>
                @if ($this->programada->status === ProgramadaStatus::Andamento && $this->programada->atendimentoIniciado())
                    <label class="flex items-center gap-2">
                        Chegada:
                        <input
                            wire:model.blur="dataChegada"
                            type="date"
                            class="form-input py-1 px-2 text-sm @error('dataChegada') border-danger @enderror"
                        >
                    </label>
                    <label class="flex items-center gap-2">
                        Saída:
                        <input
                            wire:model.blur="dataSaida"
                            type="date"
                            class="form-input py-1 px-2 text-sm @error('dataSaida') border-danger @enderror"
                        >
                    </label>
                @else
                    @if ($this->programada->data_chegada)
                        <span>Chegada: <strong>{{ $this->programada->data_chegada->format('d/m/Y') }}</strong></span>
                    @endif
                    @if ($this->programada->data_saida)
                        <span>Saída: <strong>{{ $this->programada->data_saida->format('d/m/Y') }}</strong></span>
                    @endif
                @endif
            </div>
        </div>
    </div>

    @if (in_array($this->programada->status, [ProgramadaStatus::Aberto, ProgramadaStatus::Andamento]) && ! $this->programada->atendimentoIniciado())

        <!-- Fotos - Somente Leitura antes de iniciar -->
        @if ($this->programada->imagens->count())
            <div class="card mb-4"><div class="card-header"><h6 class="card-title">Fotos do atendimento</h6></div><div class="card-body space-y-3">
                @foreach ($this->fotoPares as $numeroPar => $fotosPar)
                    <div class="grid grid-cols-2 gap-3" wire:key="readonly-par-{{ $numeroPar }}">
                        @foreach (['antes' => $fotosPar['antes'], 'depois' => $fotosPar['depois']] as $lado => $foto)
                            <div class="relative aspect-square rounded border border-default-200 flex items-center justify-center overflow-hidden">
                                @if ($foto)<img src="{{ asset('storage/' . $foto->path) }}" alt="{{ ucfirst($lado) }}" class="w-full h-full object-cover"><span class="absolute">{{ ucfirst($lado) }}</span>@else<span class="text-xs text-default-400">{{ ucfirst($lado) }} não enviada</span>@endif
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div></div>
        @endif

        <!-- Botão Iniciar Atendimento -->
        <div class="w-full flex justify-center">
            <x-loading-btn
                wire:click="iniciarAtendimento"
                wireTarget="iniciarAtendimento"
                buttonText="Iniciar Atendimento"
                pendingText="Iniciando..."
                class="btn bg-primary text-white uppercase font-semibold text-lg px-8 py-3"
            />
        </div>

    @elseif ($this->programada->status === ProgramadaStatus::Espera)
        <div class="card mb-4"><div class="card-body text-center text-default-600">Esta Programada aguarda liberação do administrador.</div></div>

    @elseif ($this->programada->status === ProgramadaStatus::Andamento && $this->programada->atendimentoIniciado())

        <!-- Fotos (Collapse) -->
        <div
            class="card mb-4"
            x-data="{
                isMobile: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || (navigator.maxTouchPoints > 1 && window.screen.width <= 1024),
                erroFormato: '',
                parSelecionado: null,
                tipoSelecionado: null,
                triggerFoto(par, tipo, fonte) {
                    this.parSelecionado = par;
                    this.tipoSelecionado = tipo;
                    const input = $refs.fotoInput;
                    if (fonte === 'camera') {
                        input.setAttribute('capture', 'environment');
                    } else {
                        input.removeAttribute('capture');
                    }
                    $nextTick(() => input.click());
                },
                formatoAceito(file) {
                    const extensao = (file.name.split('.').pop() || '').toLowerCase();
                    const mime = (file.type || '').toLowerCase();

                    if (['heic', 'heif'].includes(extensao) || ['image/heic', 'image/heif'].includes(mime)) {
                        return false;
                    }

                    const extensoes = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg'];
                    const mimes = ['image/jpeg', 'image/jpg', 'image/pjpeg', 'image/png', 'image/gif', 'image/bmp', 'image/x-ms-bmp', 'image/webp', 'image/svg+xml'];

                    return extensoes.includes(extensao) || mimes.includes(mime);
                },
                async enviarFoto(event) {
                    const input = event.target;
                    const file = input.files?.[0] ?? null;
                    input.value = '';

                    if (! file) {
                        return;
                    }

                    if (! this.formatoAceito(file)) {
                        this.erroFormato = 'Formato não aceito. Envie uma imagem JPG, PNG, GIF, BMP, WEBP ou SVG.';

                        return;
                    }

                    this.erroFormato = '';
                    await $wire.set('uploadingPar', this.parSelecionado);
                    await $wire.set('uploadingTipo', this.tipoSelecionado);
                    await $wire.upload('fotoUpload', file);
                }
            }"
        >
            <button
                type="button"
                class="hs-collapse-toggle card-header w-full flex justify-between items-center cursor-pointer"
                id="hs-fotos-prestador-toggle"
                aria-controls="hs-fotos-prestador-content"
                aria-expanded="true"
                data-hs-collapse="#hs-fotos-prestador-content"
            >
                <h6 class="card-title text-sm uppercase text-default-600 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                    Fotos
                </h6>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hs-collapse-open:hidden"><polyline points="6 9 12 15 18 9"/></svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hs-collapse-open:block hidden"><polyline points="18 15 12 9 6 15"/></svg>
            </button>
            <div
                id="hs-fotos-prestador-content"
                class="hs-collapse w-full overflow-hidden transition-[height] duration-300"
                aria-labelledby="hs-fotos-prestador-toggle"
            >
                <div class="card-body pt-0 space-y-3 mt-4">
                    @foreach ($this->fotoPares as $par => $fotos)
                        <div wire:key="par-{{ $par }}" class="grid grid-cols-2 gap-3">
                            @if ($fotos['antes'])
                                <div class="relative group aspect-square">
                                    <img src="{{ asset('storage/' . $fotos['antes']->path) }}" alt="Antes" class="w-full h-full object-cover rounded border border-default-200">
                                    <span class="absolute bottom-1 left-1 py-0.5 px-1.5 text-[10px] font-semibold uppercase bg-black/60 text-white rounded">Antes</span>
                                    <button
                                        type="button"
                                        wire:click="removerImagem({{ $fotos['antes']->id }})"
                                        aria-label="Remover imagem"
                                        class="absolute top-1 right-1 size-5 bg-danger text-white rounded-full flex items-center justify-center opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-opacity"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                    </button>
                                </div>
                            @else
                                <div class="aspect-square border-2 border-dashed border-default-300 rounded flex flex-col items-center justify-center hover:border-primary hover:bg-primary/5 transition-colors overflow-hidden">
                                    <div
                                        x-show="!isMobile"
                                        @click="triggerFoto({{ $par }}, 'antes', 'gallery')"
                                        class="w-full h-full flex flex-col items-center justify-center cursor-pointer"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-default-300"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                        <span class="text-xs text-default-400 mt-1 uppercase font-medium">Antes</span>
                                    </div>
                                    <div x-show="isMobile" class="w-full h-full flex flex-col items-center justify-center gap-1.5 px-1 py-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-default-300 shrink-0"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                        <span class="text-xs text-default-400 uppercase font-medium">Antes</span>
                                        <div class="flex gap-1 w-full min-w-0">
                                            <button
                                                type="button"
                                                @click.stop="triggerFoto({{ $par }}, 'antes', 'camera')"
                                                aria-label="Tirar foto Antes com a câmera"
                                                class="btn btn-sm flex-1 min-w-0 flex flex-col items-center gap-0.5 border border-default-300 text-default-600 hover:border-primary hover:text-primary hover:bg-primary/5 px-1 py-1.5"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="3"/></svg>
                                                <span class="text-[10px] font-medium whitespace-nowrap">Câmera</span>
                                            </button>
                                            <button
                                                type="button"
                                                @click.stop="triggerFoto({{ $par }}, 'antes', 'gallery')"
                                                aria-label="Escolher foto Antes da galeria"
                                                class="btn btn-sm flex-1 min-w-0 flex flex-col items-center gap-0.5 border border-default-300 text-default-600 hover:border-primary hover:text-primary hover:bg-primary/5 px-1 py-1.5"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                                <span class="text-[10px] font-medium whitespace-nowrap">Galeria</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($fotos['depois'])
                                <div class="relative group aspect-square">
                                    <img src="{{ asset('storage/' . $fotos['depois']->path) }}" alt="Depois" class="w-full h-full object-cover rounded border border-default-200">
                                    <span class="absolute bottom-1 left-1 py-0.5 px-1.5 text-[10px] font-semibold uppercase bg-black/60 text-white rounded">Depois</span>
                                    <button
                                        type="button"
                                        wire:click="removerImagem({{ $fotos['depois']->id }})"
                                        aria-label="Remover imagem"
                                        class="absolute top-1 right-1 size-5 bg-danger text-white rounded-full flex items-center justify-center opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-opacity"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                    </button>
                                </div>
                            @else
                                <div class="aspect-square border-2 border-dashed border-default-300 rounded flex flex-col items-center justify-center hover:border-primary hover:bg-primary/5 transition-colors overflow-hidden">
                                    <div
                                        x-show="!isMobile"
                                        @click="triggerFoto({{ $par }}, 'depois', 'gallery')"
                                        class="w-full h-full flex flex-col items-center justify-center cursor-pointer"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-default-300"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                        <span class="text-xs text-default-400 mt-1 uppercase font-medium">Depois</span>
                                    </div>
                                    <div x-show="isMobile" class="w-full h-full flex flex-col items-center justify-center gap-1.5 px-1 py-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-default-300 shrink-0"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                        <span class="text-xs text-default-400 uppercase font-medium">Depois</span>
                                        <div class="flex gap-1 w-full min-w-0">
                                            <button
                                                type="button"
                                                @click.stop="triggerFoto({{ $par }}, 'depois', 'camera')"
                                                aria-label="Tirar foto Depois com a câmera"
                                                class="btn btn-sm flex-1 min-w-0 flex flex-col items-center gap-0.5 border border-default-300 text-default-600 hover:border-primary hover:text-primary hover:bg-primary/5 px-1 py-1.5"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="3"/></svg>
                                                <span class="text-[10px] font-medium whitespace-nowrap">Câmera</span>
                                            </button>
                                            <button
                                                type="button"
                                                @click.stop="triggerFoto({{ $par }}, 'depois', 'gallery')"
                                                aria-label="Escolher foto Depois da galeria"
                                                class="btn btn-sm flex-1 min-w-0 flex flex-col items-center gap-0.5 border border-default-300 text-default-600 hover:border-primary hover:text-primary hover:bg-primary/5 px-1 py-1.5"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                                <span class="text-[10px] font-medium whitespace-nowrap">Galeria</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach

                    <p
                        x-show="erroFormato"
                        x-text="erroFormato"
                        role="alert"
                        class="text-sm text-danger text-center"
                    ></p>

                    <div wire:loading wire:target="fotoUpload" class="text-sm text-primary text-center py-2">
                        Carregando imagem...
                    </div>

                    <input x-ref="fotoInput" type="file" accept="image/*" class="hidden" @change="enviarFoto($event)">
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h6 class="card-title text-sm">Comentários do Atendimento</h6>
            </div>
            <div class="card-body">
                <form wire:submit="salvarComentarios">
                    <textarea
                        wire:model="comentariosPrestador"
                        rows="3"
                        class="form-input w-full mb-2"
                        placeholder="Observações sobre o atendimento realizado..."
                    ></textarea>
                    @error('comentariosPrestador') <p class="text-sm text-danger mb-2">{{ $message }}</p> @enderror
                    <x-loading-btn
                        type="submit"
                        wireTarget="salvarComentarios"
                        buttonText="Salvar Comentários"
                        pendingText="Salvando..."
                        class="btn btn-sm bg-default-200 text-default-700 hover:bg-default-300"
                    />
                </form>
            </div>
        </div>

        <div class="flex items-end gap-2 mb-4">
            <div class="flex-1">
                <input
                    wire:model="emailRat"
                    type="email"
                    id="emailRat"
                    class="form-input w-full @error('emailRat') border-danger @enderror"
                    placeholder="EMAIL@AGENCIA.COM"
                >
                @error('emailRat') <p class="mt-1 text-sm text-danger">{{ $message }}</p> @enderror
            </div>
            <x-loading-btn
                wire:click="enviarEmail"
                wireTarget="enviarEmail"
                buttonText="Enviar"
                pendingText="Enviando..."
                class="btn bg-primary text-white shrink-0 uppercase font-semibold"
            />
        </div>

        <div class="w-full flex justify-center">
            <x-loading-btn
                wire:click="concluir"
                wireTarget="concluir"
                buttonText="Concluir Atendimento"
                pendingText="Concluindo..."
                class="btn bg-success text-white uppercase font-semibold text-lg px-8 py-3"
                :is-disabled="! $this->programada->podeConcluir()"
            />
        </div>

        @if (! $this->programada->podeConcluir())
            <p class="text-xs text-default-400 mt-2">
                Para concluir: ao menos 1 foto antes, 1 foto depois e e-mail enviado.
            </p>
        @endif

    @elseif ($this->programada->status === ProgramadaStatus::Revisar)

        <div class="card mb-4">
            <div class="card-body">
                <div class="flex flex-col items-center gap-3 py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                    <p class="text-default-600 font-medium">Atendimento concluído. Aguardando revisão do administrador.</p>
                </div>
            </div>
        </div>

        @if ($this->programada->imagens->count())
            <div class="card mb-4"><div class="card-header"><h6 class="card-title">Fotos do atendimento</h6></div><div class="card-body space-y-3">
                @foreach ($this->fotoPares as $numeroPar => $fotosPar)
                    <div class="grid grid-cols-2 gap-3" wire:key="readonly-par-{{ $numeroPar }}">
                        @foreach (['antes' => $fotosPar['antes'], 'depois' => $fotosPar['depois']] as $lado => $foto)
                            <div class="aspect-square rounded border border-default-200 flex items-center justify-center overflow-hidden">
                                @if ($foto)<img src="{{ asset('storage/' . $foto->path) }}" alt="{{ ucfirst($lado) }}" class="w-full h-full object-cover"><span class="absolute">{{ ucfirst($lado) }}</span>@else<span class="text-xs text-default-400">{{ ucfirst($lado) }} não enviada</span>@endif
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div></div>
        @endif

        @if ($this->programada->comentarios_prestador)
            <x-comentarios-atendimento :comentarios="$this->programada->comentarios_prestador" />
        @endif

    @elseif ($this->programada->status === ProgramadaStatus::Concluido)

        <div class="card mb-4">
            <div class="card-body">
                <div class="flex flex-col items-center gap-3 py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-success"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <p class="text-default-600 font-medium">Esta programada foi concluída.</p>
                    @if ($this->programada->concluidoPor)
                        <p class="text-sm text-default-400">Revisado por: <strong>{{ $this->programada->concluidoPor->name }}</strong></p>
                    @endif
                </div>
            </div>
        </div>

        @if ($this->programada->imagens->count())
            <div class="card mb-4"><div class="card-header"><h6 class="card-title">Fotos do atendimento</h6></div><div class="card-body space-y-3">
                @foreach ($this->fotoPares as $numeroPar => $fotosPar)
                    <div class="grid grid-cols-2 gap-3" wire:key="readonly-par-{{ $numeroPar }}">
                        @foreach (['antes' => $fotosPar['antes'], 'depois' => $fotosPar['depois']] as $lado => $foto)
                            <div class="aspect-square rounded border border-default-200 flex items-center justify-center overflow-hidden">
                                @if ($foto)<img src="{{ asset('storage/' . $foto->path) }}" alt="{{ ucfirst($lado) }}" class="w-full h-full object-cover"><span class="absolute">{{ ucfirst($lado) }}</span>@else<span class="text-xs text-default-400">{{ ucfirst($lado) }} não enviada</span>@endif
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div></div>
        @endif

        @if ($this->programada->comentarios_prestador)
            <x-comentarios-atendimento :comentarios="$this->programada->comentarios_prestador" />
        @endif

    @endif
</div>
