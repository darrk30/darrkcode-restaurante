<x-app-layout>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tenant.update', $tenant) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- RUC --}}
                <x-input-label for="ruc">RUC</x-input-label>
                <x-text-input 
                    id="ruc"
                    name="tenancy_ruc" 
                    type="text" 
                    maxlength="11"
                    class="w-full mt-2"
                    value="{{ old('tenancy_ruc', $tenant->getAttribute('tenancy_ruc')) }}" 
                    placeholder="Ingrese el RUC"/>
                <x-input-error :messages="$errors->get('tenancy_ruc')" class="mt-2"/>

                {{-- Nombre --}}
                <x-input-label for="name">Nombre</x-input-label>
                <x-text-input 
                    id="name"
                    name="tenancy_name" 
                    type="text" 
                    class="w-full mt-2"
                    value="{{ old('tenancy_name', $tenant->getAttribute('tenancy_name')) }}" 
                    placeholder="Ingrese el nombre de la empresa"/>
                <x-input-error :messages="$errors->get('tenancy_name')" class="mt-2"/>

                {{-- Subdominio --}}
                <x-input-label for="id">Subdominio</x-input-label>
                <x-text-input 
                    id="id"
                    name="id" 
                    type="text" 
                    class="w-full mt-2"
                    value="{{ old('id', $tenant->id) }}" 
                    placeholder="Ingrese un identificador único"/>
                <x-input-error :messages="$errors->get('id')" class="mt-2"/>

                {{-- Email --}}
                <x-input-label for="email">Correo electrónico</x-input-label>
                <x-text-input 
                    id="email"
                    name="tenancy_email" 
                    type="email" 
                    class="w-full mt-2"
                    value="{{ old('tenancy_email', $tenant->getAttribute('tenancy_email')) }}" 
                    placeholder="Ingrese el correo"/>
                <x-input-error :messages="$errors->get('tenancy_email')" class="mt-2"/>

                {{-- Botón --}}
                <div class="flex justify-end">
                    <button class="btn-primary mt-4">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
