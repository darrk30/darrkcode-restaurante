@props(['title' => 'Confirmar Eliminación'])

<div x-data="{ open: false, action: null, id: null, message: '' }"
    x-on:confirm-delete.window="
        open = true; 
        action = $event.detail.action; 
        id = $event.detail.id; 
        message = $event.detail.message ?? '¿Estás seguro de que deseas eliminar este registro?'; 
    "
    x-on:deleted.window="open = false">
    <template x-if="open">
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md mx-2">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $title }}</h2>
                <p class="text-gray-600 mb-4" x-text="message"></p>

                <div class="flex justify-end gap-3">
                    <x-button type="button" color="gray" @click="open = false">
                        Cancelar
                    </x-button>
                    <x-button type="button" color="red" x-on:click="$wire.call(action, id)"
                        wire:loading.attr="disabled" wire:target="{{ $attributes->get('action') ?? 'delete' }}">
                        <span wire:loading.remove wire:target="{{ $attributes->get('action') ?? 'delete' }}">
                            Eliminar
                        </span>
                        <span wire:loading wire:target="{{ $attributes->get('action') ?? 'delete' }}">
                            Eliminando...
                        </span>
                    </x-button>


                </div>
            </div>
        </div>
    </template>
</div>
