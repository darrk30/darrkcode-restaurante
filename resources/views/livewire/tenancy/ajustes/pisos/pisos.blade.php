<div class="">
    <x-page-header title="Listado de Pisos y Mesas" subtitle="Gestiona tus pisos y las mesas asignadas"
        icon="fas fa-building" />
    <div class="grid grid-cols-1 min-[836px]:grid-cols-2 gap-4" x-data="{ selected: @entangle('selectedPiso') }">
        {{-- Columna izquierda: Pisos --}}
        <div class="border border-gray-200 rounded-lg overflow-hidden">
            <div class="flex items-center justify-between px-4 py-2 bg-gray-100">
                <h2 class="font-semibold text-gray-700">SALONES</h2>
                <x-button color="green" icon="fas fa-plus" title="Nuevo Salon"
                    @click="$dispatch('open-piso'); $wire.dispatch('showModalPisos')">
                    Nuevo
                </x-button>
            </div>

            <div class="overflow-x-auto">
                <table class="table-base">
                    <thead class="table-header">
                        <tr>
                            <th class="table-th">Nombre</th>
                            <th class="table-th">Impresora</th>
                            <th class="table-th">Estado</th>
                            <th class="table-th text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pisos as $piso)
                            <tr wire:key="piso-{{ $piso->id }}" x-on:click="selected = {{ $piso->id }}"
                                wire:click="$set('selectedPiso', {{ $piso->id }})"
                                :class="selected == {{ $piso->id }} ? 'table-row-selected' : 'table-row'">

                                <td class="table-td font-medium flex items-center gap-2">{{ $piso->nombre }}</td>

                                <td class="table-td">{{ $piso->impresora?->nombre ?? 'Sin impresora' }}</td>

                                <td class="table-td">
                                    @if ($piso->status)
                                        <span class="badge-active">Activo</span>
                                    @else
                                        <span class="badge-inactive">Inactivo</span>
                                    @endif
                                </td>

                                <td class="table-td text-right space-x-3">
                                    <button class="icon-button-blue" title="Editar"
                                        @click="$dispatch('edit-piso', { id: {{ $piso->id }}, 
                                            nombre: '{{ $piso->nombre }}', 
                                            status: {{ $piso->status ? 'true' : 'false' }},
                                            impresora_id: {{ $piso->impresora_id ?? 'null' }} 
                                        })">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="icon-button-red"
                                        @click="$dispatch('confirm-delete', { 
                                            action: 'deletePiso', 
                                            id: {{ $piso->id }}, 
                                            message: '¿Estás seguro de que deseas eliminar el piso {{ $piso->nombre }}?' 
                                        })">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-2">
                {{ $pisos->links() }}
            </div>
        </div>

        {{-- Columna derecha: Mesas --}}
        <div class="border border-gray-200 rounded-lg overflow-hidden relative">
            <div class="flex items-center justify-between px-4 py-2 bg-gray-100">
                <h2 class="font-semibold text-gray-700">
                    MESAS
                    @if ($selectedPiso)
                        <span class="ml-2 text-sm text-blue-600 font-medium">
                            ({{ $selectedPisoObj->nombre ?? '---' }})
                        </span>
                    @endif
                </h2>
                @if ($selectedPiso)
                    <x-button color="green" icon="fas fa-plus"
                        @click="$dispatch('open-mesa', {piso_id: {{ $selectedPiso }}});">
                        Nueva
                    </x-button>
                @endif
            </div>
            @if ($selectedPiso)
                <div class="overflow-x-auto relative">
                    <table class="table-base">
                        <thead class="table-header">
                            <tr>
                                <th class="table-th">N°</th>
                                <th class="table-th">Estado</th>
                                <th class="table-th text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($mesas as $mesa)
                                <tr class="table-row">
                                    <td class="table-td font-medium text-gray-800">{{ $mesa->nombre }}</td>

                                    <td class="table-td">
                                        @if ($mesa->status)
                                            <span class="badge-active">Activo</span>
                                        @else
                                            <span class="badge-inactive">Inactivo</span>
                                        @endif
                                    </td>

                                    <td class="table-td text-right space-x-3">
                                        <button class="icon-button-blue" title="Editar"
                                            @click="$dispatch('edit-mesa', { id: {{ $mesa->id }}, 
                                                nombre: '{{ $mesa->nombre }}', 
                                                status: {{ $mesa->status ? 'true' : 'false' }},
                                                piso_id: {{ $selectedPiso }}
                                            })">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button class="icon-button-red"
                                            @click="$dispatch('confirm-delete', { 
                                                action: 'deleteMesa', 
                                                id: {{ $mesa->id }}, 
                                                message: '¿Estás seguro de que deseas eliminar la mesa {{ $mesa->nombre }}?' 
                                            })">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="table-td text-center text-gray-500">
                                        No hay mesas registradas para este piso
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="p-2">
                        {{ $mesas->links() }}
                    </div>
                </div>
            @else
                <div class="p-4 text-gray-500 text-sm text-center">
                    Selecciona un piso para ver sus mesas.
                </div>
            @endif
        </div>
    </div>

    {{-- Modal para eliminar Piso y Mesas --}}
    <x-confirmation-modal />

    @livewire('tenancy.pisos.model-pisos')
    @livewire('tenancy.pisos.modal-mesas')

    {{-- Toast --}}
    @if ($toastError)
        <x-toast :message="$toastError" type="error" wire:model="toastError" />
    @endif

</div>
