<div>
    @if ($this->ocorrencia->imagens->count())
        <x-foto-galeria
            :collapse-id="$collapseId"
            :foto-pares="$this->ocorrencia->fotoPares()"
            :wire-key-prefix="$wireKeyPrefix"
            :card-class="$cardClass"
            :collapse-panel-class="$collapsePanelClass"
        />
    @endif
</div>
