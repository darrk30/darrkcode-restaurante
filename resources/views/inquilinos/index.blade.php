<x-app-layout>
    <div class="flex justify-end mb-6">
        <x-button-link href="{{ route('tenant.create') }}" type="button">Nuevo</x-button-link>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3">RUC</th>
                    <th scope="col" class="px-6 py-3">Nombre</th>
                    <th scope="col" class="px-6 py-3">Dominio</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Estado</th>
                    <th scope="col" class="px-6 py-3 flex justify-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tenants as $tenant)
                    <tr class="bg-white border-b ">
                        <td class="px-6 py-4">
                            {{ $tenant->tenancy_ruc ?? '—' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $tenant->tenancy_name ?? '—' }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($tenant->domains->first())
                                <a href="http://{{ $tenant->domains->first()->domain }}" target="_blank"
                                    class="text-blue-600 hover:underline">
                                    {{ $tenant->domains->first()->domain }}
                                </a>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $tenant->tenancy_email ?? '—' }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($tenant->tenancy_status == 1)
                                <span
                                    class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded">Activo</span>
                            @else
                                <span
                                    class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded">Inactivo</span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex justify-end space-x-2">
                                <form action="{{ route('tenant.destroy', $tenant) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button><i class="fa-solid fa-trash"></i></x-danger-button>
                                </form>
                                <x-button-link href="{{ route('tenant.edit', $tenant) }}" class="btn-green">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </x-button-link>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
