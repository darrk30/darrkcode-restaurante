<div>

    <x-page-header title="Listado de Areas de producción" subtitle="Gestiona tus areas de producción registradas" icon="fa-solid fa-industry" />


    <div class="grid grid-cols-1 gap-6">
        {{-- Columna izquierda: Tabla de areaproduccions --}}
        <div class="lg:col-span-2 border border-gray-200 rounded-lg overflow-hidden">
            <div class="flex items-center justify-between px-4 py-2 bg-gray-100">
                <h2 class="font-semibold text-gray-700">AREAS DE PRODUCCIÓN</h2>
                <x-button color="green" icon="fas fa-plus" @click="$dispatch('open-areaproduccion');">
                    Nueva
                </x-button>

            </div>

            <div class="overflow-x-auto">
                <table class="table-base w-full">
                    <thead class="table-header">
                        <tr>
                            <th class="table-th">Nombre</th>
                            <th class="table-th">Impresora</th>
                            <th class="table-th">Estado</th>
                            <th class="table-th text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($areasproduccion as $areaproduccion)
                            <tr wire:key="areaproduccion-{{ $areaproduccion->id }}" class="table-row">
                                <td class="table-td font-medium text-gray-800 flex items-center gap-2">
                                    {{ $areaproduccion->nombre }}
                                </td>

                                <td class="table-td">{{ $areaproduccion->impresora?->nombre ?? 'Sin impresora' }}</td>

                                <td class="table-td">
                                    @if ($areaproduccion->status)
                                        <span class="badge-active">Activo</span>
                                    @else
                                        <span class="badge-inactive">Inactivo</span>
                                    @endif
                                </td>

                                <td class="table-td text-right space-x-3">
                                    <button class="icon-button-blue" title="Editar"
                                        @click="$dispatch('edit-areaproduccion', { id: {{ $areaproduccion->id }}, 
                                            nombre: '{{ $areaproduccion->nombre }}', 
                                            status: {{ $areaproduccion->status ? 'true' : 'false' }},
                                            impresora_id: {{ $areaproduccion->impresora_id ?? 'null' }} 
                                        })">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="icon-button-red"
                                        @click="$dispatch('confirm-delete', { 
                                                action: 'deleteAreaproduccion', 
                                                id: {{ $areaproduccion->id }}, 
                                                message: '¿Estás seguro de que deseas eliminar la areaproduccion {{ $areaproduccion->nombre }}?' 
                                            })">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">
                                    No hay registros. <button class="text-blue-600 underline"
                                        @click="$dispatch('open-areaproduccion')">Crea una areaproduccion</button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-2">
                {{ $areasproduccion->links() }}
            </div>
        </div>
    </div>

    {{-- Modal para eliminar areaproduccion --}}
    <x-confirmation-modal />
    {{-- Modal para crear/editar areaproduccion --}}
    @livewire('tenancy.area-produccion.modal-area-produccion')

    {{-- Toast --}}
    <x-toast/>


</div>
