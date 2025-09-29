<div class="space-y-6">
    <x-page-header title="Crear Empresa" subtitle="Registra una nueva empresa en el sistema" icon="fas fa-building" />

    <form wire:submit.prevent="save" enctype="multipart/form-data" class="bg-white shadow rounded-xl p-6 space-y-6">

        @csrf

        {{-- Información General --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">
                Información General
            </h2>

            <div class="grid grid-cols-1 gap-6">
                {{-- RUC + Razón Social --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    {{-- RUC con botón --}}
                    <div class="col-span-1">
                        <x-input-label for="ruc" value="RUC" />
                        <div class="flex mt-1">
                            {{-- Input bloqueado mientras se busca --}}
                            <x-text-input wire:model="ruc" id="ruc" name="ruc" type="text"
                                class="flex-1 rounded-r-none" placeholder="20123456789" required
                                wire:loading.attr="disabled" wire:target="buscarRuc" />

                            {{-- Botón con estados --}}
                            <button type="button" wire:click="buscarRuc"
                                class="px-4 bg-blue-600 text-white rounded-r-md hover:bg-blue-700 flex items-center justify-center"
                                wire:loading.attr="disabled" wire:target="buscarRuc">

                                {{-- Ícono lupa (cuando no carga) --}}
                                <i class="fas fa-search" wire:loading.remove wire:target="buscarRuc"></i>

                                {{-- Spinner (cuando carga) --}}
                                <svg wire:loading wire:target="buscarRuc" class="animate-spin h-5 w-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('ruc')" class="mt-2" />
                    </div>


                    {{-- Razón Social --}}
                    <div class="col-span-1 md:col-span-2">
                        <x-input-label for="razon_social" value="Razón Social (Nombre de Empresa)" />
                        <x-text-input wire:model="razon_social" id="razon_social" name="razon_social" type="text"
                            class="mt-1 block w-full" placeholder="Ej: Mi Empresa S.A.C." required />
                        <x-input-error :messages="$errors->get('razon_social')" class="mt-2" />
                    </div>
                </div>

                {{-- Subdominio + Logo --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                    {{-- Subdominio --}}
                    <div class="col-span-1 md:col-span-2">
                        <x-input-label for="subdominio" value="Subdominio" />
                        <div class="flex mt-1 w-full">
                            <x-text-input wire:model="subdominio" id="subdominio" name="subdominio" type="text"
                                class="flex-1 min-w-0 rounded-r-none" placeholder="identificador-unico" required />
                            <span
                                class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-600 whitespace-nowrap">
                                .tusistema.com
                            </span>
                        </div>

                        <x-input-error :messages="$errors->get('subdominio')" class="mt-2" />
                    </div>

                    {{-- Logo con preview --}}
                    <div x-data="{ preview: null }" class="space-y-2">
                        <x-input-label>Logo</x-input-label>

                        <div class="mt-2">
                            <div class="h-28 flex items-center justify-center border-2 border-dashed rounded-lg cursor-pointer overflow-hidden"
                                @click="$refs.logoInput.click()">
                                <template x-if="preview">
                                    <img :src="preview" class="h-full object-contain" />
                                </template>
                                <template x-if="!preview">
                                    <div class="text-center text-gray-500">
                                        <i class="fas fa-image text-2xl mb-1"></i>
                                        <div class="text-sm">Clic para subir imagen</div>
                                    </div>
                                </template>
                            </div>
                            <input type="file" id="logo" name="logo" class="hidden" accept="image/*"
                                x-ref="logoInput"
                                @change="preview = $event.target.files.length ? URL.createObjectURL($event.target.files[0]) : null">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- Información de la Empresa --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">
                Información de la Empresa
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Dirección --}}
                <div class="md:col-span-2">
                    <x-input-label for="direccion" value="Dirección" />
                    <x-text-input wire:model="direccion" id="direccion" name="direccion" type="text"
                        class="mt-1 block w-full" placeholder="Ej: Av. Principal 123 - Lima" />
                    <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
                </div>

                {{-- Ubigeo --}}
                <div>
                    <x-input-label for="ubigeo" value="Ubigeo" />
                    <x-text-input wire:model="ubigeo" id="ubigeo" name="ubigeo" type="text"
                        class="mt-1 block w-full" placeholder="Ej: 150101" />
                    <x-input-error :messages="$errors->get('ubigeo')" class="mt-2" />
                </div>

                {{-- Departamento --}}
                <div>
                    <x-input-label for="departamento" value="Departamento" />
                    <x-text-input wire:model="departamento" id="departamento" name="departamento" type="text"
                        class="mt-1 block w-full" placeholder="Ej: Lima" />
                    <x-input-error :messages="$errors->get('departamento')" class="mt-2" />
                </div>

                {{-- Provincia --}}
                <div>
                    <x-input-label for="provincia" value="Provincia" />
                    <x-text-input wire:model="provincia" id="provincia" name="provincia" type="text"
                        class="mt-1 block w-full" placeholder="Ej: Lima" />
                    <x-input-error :messages="$errors->get('provincia')" class="mt-2" />
                </div>

                {{-- Distrito --}}
                <div>
                    <x-input-label for="distrito" value="Distrito" />
                    <x-text-input wire:model="distrito" id="distrito" name="distrito" type="text"
                        class="mt-1 block w-full" placeholder="Ej: Miraflores" />
                    <x-input-error :messages="$errors->get('distrito')" class="mt-2" />
                </div>

                {{-- Correo de contacto --}}
                <div>
                    <x-input-label for="correo_contacto" value="Correo de contacto" />
                    <x-text-input wire:model="correo_contacto" id="correo_contacto" name="correo_contacto"
                        type="email" class="mt-1 block w-full" placeholder="empresa@ejemplo.com" />
                    <x-input-error :messages="$errors->get('correo_contacto')" class="mt-2" />
                </div>

                {{-- Teléfono --}}
                <div>
                    <x-input-label for="telefono" value="Teléfono" />
                    <x-text-input wire:model="telefono" id="telefono" name="telefono" type="text"
                        class="mt-1 block w-full" placeholder="+51 999 999 999" />
                    <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                </div>
            </div>
        </div>

        {{-- Usuario de acceso --}}
        <div>
            <h2 class="text-xl font-semibold flex items-center gap-3 mb-4">
                <i class="fas fa-user-circle text-gray-600"></i>
                Usuario de acceso
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-1">
                    <x-input-label for="tenancy_email">Correo de acceso <span
                            class="text-red-500">*</span></x-input-label>
                    <x-text-input wire:model="tenancy_email" id="tenancy_email" name="tenancy_email" type="email"
                        required class="w-full mt-2" placeholder="correo@ejemplo.com" />
                    <x-input-error :messages="$errors->get('tenancy_email')" class="mt-2" />
                </div>

                <div class="md:col-span-1" x-data="{ show: false }">
                    <x-input-label for="tenancy_password">Contraseña <span
                            class="text-red-500">*</span></x-input-label>
                    <div class="relative mt-2">
                        <x-text-input wire:model="tenancy_password" id="tenancy_password" name="tenancy_password"
                            x-bind:type="show ? 'text' : 'password'" required class="w-full pr-10"
                            placeholder="Ingrese la contraseña" />
                        <button type="button" class="absolute inset-y-0 right-2 flex items-center text-gray-500"
                            @click="show = !show">
                            <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                        </button>
                    </div>
                </div>

                <div class="md:col-span-1" x-data="{ show: false }">
                    <x-input-label for="tenancy_password_confirmation">Confirmar contraseña <span
                            class="text-red-500">*</span></x-input-label>
                    <div class="relative mt-2">
                        <x-text-input wire:model="tenancy_password_confirmation" id="tenancy_password_confirmation"
                            name="tenancy_password_confirmation" x-bind:type="show ? 'text' : 'password'" required
                            class="w-full pr-10" placeholder="Repita la contraseña" />
                        <button type="button" class="absolute inset-y-0 right-2 flex items-center text-gray-500"
                            @click="show = !show">
                            <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Botones --}}
        <div class="flex justify-end gap-4">
            <x-secondary-button type="button" onclick="window.history.back()">Cancelar</x-secondary-button>
            <x-primary-button>Guardar Empresa</x-primary-button>
        </div>
    </form>

    <x-toast />
</div>
