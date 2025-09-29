<div>

    <x-page-header title="Listado de Impresoras" subtitle="Gestiona las impresoras registradas" icon="fas fa-print" />

    {{-- Aviso en móvil (arriba, colapsable) --}}
    <div class="block lg:hidden">
        <div x-data="{ open: false }" class="mb-4">
            <button @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-2 bg-blue-100 border border-blue-300 rounded-lg text-blue-800 font-semibold">
                <span><i class="fas fa-info-circle"></i> Importante</span>
                <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'"></i>
            </button>

            <div x-show="open" x-transition class="mt-2">
                <x-info-card type="info">
                    <span class="font-semibold text-gray-800">Antes de registrar:</span>
                    <ul class="list-disc list-inside mt-2 space-y-1 text-gray-700">
                        <li>Configura la impresora en tu PC y verifica que esté conectada por red.</li>
                        <li>Escribe el <span class="font-semibold">nombre exactamente igual</span> al que aparece en tu
                            sistema.</li>
                        <li>Si el nombre no coincide, el sistema no la reconocerá y la impresión directa fallará.</li>
                    </ul>
                </x-info-card>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Columna izquierda: Tabla de Impresoras --}}
        <div class="lg:col-span-2 border border-gray-200 rounded-lg overflow-hidden">
            <div class="flex items-center justify-between px-4 py-2 bg-gray-100">
                <h2 class="font-semibold text-gray-700">IMPRESORAS</h2>
                <x-button color="green" icon="fas fa-plus" @click="$dispatch('open-impresora');">
                    Nueva
                </x-button>

            </div>

            <div class="overflow-x-auto">
                <table class="table-base w-full">
                    <thead class="table-header">
                        <tr>
                            <th class="table-th">Nombre</th>
                            <th class="table-th">Estado</th>
                            <th class="table-th text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($impresoras as $impresora)
                            <tr wire:key="impresora-{{ $impresora->id }}" class="table-row">
                                <td class="table-td font-medium text-gray-800 flex items-center gap-2">
                                    <i class="fas fa-print text-gray-400"></i>
                                    {{ $impresora->nombre }}
                                </td>

                                <td class="table-td">
                                    @if ($impresora->status)
                                        <span class="badge-active">Activo</span>
                                    @else
                                        <span class="badge-inactive">Inactivo</span>
                                    @endif
                                </td>

                                <td class="table-td text-right space-x-3">
                                    <button class="icon-button-blue" title="Editar"
                                        @click="$dispatch('edit-impresora', { id: {{ $impresora->id }}, 
                                            nombre: '{{ $impresora->nombre }}', 
                                            status: {{ $impresora->status ? 'true' : 'false' }} 
                                        })">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="icon-button-red"
                                        @click="$dispatch('confirm-delete', { 
                                                action: 'deleteImpresora', 
                                                id: {{ $impresora->id }}, 
                                                message: '¿Estás seguro de que deseas eliminar la impresora {{ $impresora->nombre }}?' 
                                            })">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">
                                    No hay registros. <button class="text-blue-600 underline"
                                        @click="$dispatch('open-impresora')">Crea una impresora</button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-2">
                {{ $impresoras->links() }}
            </div>
        </div>

        {{--  Aviso en escritorio (columna derecha) --}}
        <div class="hidden lg:block space-y-4">
            <x-info-card type="info" title="Importante">
                <span class="font-semibold text-gray-800">Antes de registrar:</span>
                <ul class="list-disc list-inside mt-2 space-y-1 text-gray-700">
                    <li>Configura la impresora en tu PC y verifica que esté conectada por red.</li>
                    <li>Escribe el <span class="font-semibold">nombre exactamente igual</span> al que aparece en tu
                        sistema.</li>
                    <li>Si el nombre no coincide, el sistema no la reconocerá y la impresión directa fallará.</li>
                </ul>
            </x-info-card>
        </div>
    </div>

    {{-- Modal para eliminar impresora --}}
    <x-confirmation-modal />
    {{-- Modal para crear/editar impresora --}}
    @livewire('tenancy.impresoras.modal-impresora')

    {{-- Toast --}}
    <x-toast/>


</div>
