<div class="space-x-2">
    <button class="icon-button-blue"
        wire:click="$dispatch('edit-categoria', { id: {{ $id }} })">
        <i class="fas fa-edit"></i>
    </button>

    <button class="icon-button-red"
        wire:click="$dispatch('confirm-delete', { id: {{ $id }} })">
        <i class="fas fa-trash"></i>
    </button>
</div>

