<div x-cloak x-data="{
        open: false,
        mode: 'create',
        areaproduccion: { id: null, nombre: '',impresora_id:'', status: true}
    }"
    x-on:open-areaproduccion.window="
        mode='create'; 
        areaproduccion={id:null,nombre:'',impresora_id:'',status:true}; 
        open=true;
    "
    x-on:edit-areaproduccion.window="
        mode='edit'; 
        areaproduccion=$event.detail; 
        open=true;
    "
    x-on:close-areaproduccion.window="open=false"
>
    <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50"
        @click.away="open = false">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 mx-2 sm:mx-0" @click.stop>
            <h2 class="text-lg font-semibold text-gray-700 mb-4">
                <span x-text="mode === 'edit' ? 'Editar área de producción' : 'Nueva área de producción'"></span>
            </h2>

            <!-- Form -->
            <div class="space-y-4">
                <!-- Nombre -->
                <div>
                    <x-input-label for="nombre" value="Nombre" />
                    <x-text-input id="nombre" type="text" x-model="areaproduccion.nombre" placeholder="Ejm: Cocina"
                        class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('nombre')" class="mt-1" />
                </div>
                
                <!-- Impresora -->
                <div>
                    <x-input-label for="impresora_id" value="Impresora" />
                    <select id="impresora_id" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                        x-model="areaproduccion.impresora_id">
                        <option value="">Sin impresora</option>
                        @foreach ($impresoras as $id => $nombre)
                            <option value="{{ $id }}">{{ $nombre }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('impresora_id')" class="mt-1" />
                </div>

                <!-- Status -->
                <div class="flex items-center">
                    <input id="status" type="checkbox" x-model="areaproduccion.status" class="rounded border-gray-300">
                    <x-input-label for="status" value="Activo" class="ml-2" />
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-6 flex justify-end space-x-2">
                <x-button type="button" color="gray" @click="open = false; $wire.resetForm()">
                    Cancelar
                </x-button>
                <x-button type="button" color="blue" wire:click="save(areaproduccion)">
                    <span wire:loading wire:target="save">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Guardando...
                    </span>

                    <!-- Texto normal que se oculta durante la carga -->
                    <span wire:loading.remove wire:target="save">
                        Guardar
                    </span>
                </x-button>
            </div>
        </div>
    </div>
</div>
