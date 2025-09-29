<div>
    <x-page-header title="Listado de Categorias" subtitle="Gestiona tus categorias" icon="fas fa-tag" />
    <div class="grid grid-cols-1 gap-6">
        {{-- Columna izquierda: Tabla de categorias --}}
        <div class="lg:col-span-2 border border-gray-200 rounded-lg overflow-hidden">
            <div class="flex items-center justify-between px-4 py-2 bg-gray-100">
                <h2 class="font-semibold text-gray-700">CATEGORIAS</h2>
                <x-button color="green" icon="fas fa-plus" @click="$dispatch('open-categoria');">
                    Nueva
                </x-button>

            </div>

            <div class="overflow-x-auto">
                <table class="table-base w-full">
                    <thead class="table-header">
                        <tr>
                            <th class="table-th">Nombre</th>
                            <th class="table-th">Orden</th>
                            <th class="table-th">Estado</th>
                            <th class="table-th text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categorias as $categoria)
                            <tr wire:key="categoria-{{ $categoria->id }}" class="table-row">
                                <td class="table-td font-medium text-gray-800 flex items-center gap-2">
                                    {{ $categoria->nombre }}
                                </td>

                                <td class="table-td">{{ $categoria->orden}}</td>

                                <td class="table-td">
                                    @if ($categoria->status)
                                        <span class="badge-active">Activo</span>
                                    @else
                                        <span class="badge-inactive">Inactivo</span>
                                    @endif
                                </td>

                                <td class="table-td text-right space-x-3">
                                    <button class="icon-button-blue" title="Editar"
                                        @click="$dispatch('edit-categoria', { id: {{ $categoria->id }}, 
                                            nombre: '{{ $categoria->nombre }}', 
                                            status: {{ $categoria->status ? 'true' : 'false' }},
                                            orden: {{ $categoria->orden ?? 'null' }} 
                                        })">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="icon-button-red"
                                        @click="$dispatch('confirm-delete', { 
                                                action: 'deleteCategoria', 
                                                id: {{ $categoria->id }}, 
                                                message: '¿Estás seguro de que deseas eliminar la categoria {{ $categoria->nombre }}?' 
                                            })">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">
                                    No hay registros. <button class="text-blue-600 underline"
                                        @click="$dispatch('open-categoria')">Crea una categoria</button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-2">
                {{ $categorias->links() }}
            </div>
        </div>
    </div>

    {{-- Modal para eliminar categoria --}}
    <x-confirmation-modal />
    {{-- Modal para crear/editar categoria --}}
    @livewire('tenancy.categorias.modal-categorias')

    {{-- Toast --}}
    <x-toast/>


</div>
