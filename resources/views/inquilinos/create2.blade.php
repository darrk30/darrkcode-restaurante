@php
    // host sin http(s)
    $appHost = str_replace(['http://', 'https://'], '', config('app.url') ?? env('APP_URL'));
@endphp

<x-app-layout>
    <x-page-header title="Crear Empresa" subtitle="Registra una nueva empresa en el sistema" icon="fas fa-building" />
    <div class="max-w-6xl mx-auto pb-4">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                <form action="{{ route('tenant.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    {{-- ===================== --}}
                    {{-- Información General --}}
                    {{-- ===================== --}}
                    <div>
                        <h2 class="text-xl font-semibold flex items-center gap-3 mb-4">
                            <i class="fas fa-building text-gray-600"></i>
                            Información General
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            {{-- RUC con botón buscar --}}
                            <div x-data="rucForm()" x-init="init()">
                                <div class="relative">
                                    <x-text-input id="ruc" name="tenancy_ruc" maxlength="11" required
                                        class="flex-1 rounded-r-none" placeholder="Ingrese el RUC"
                                        value="{{ old('tenancy_ruc') }}" />
                                    <button type="button" title="Buscar RUC"
                                        class="bg-blue-600 text-white px-4 rounded-r hover:bg-blue-700">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- Nombre (ocupa 2/3) --}}
                            <div class="md:col-span-2">
                                <x-input-label for="name">Nombre Empresa <span
                                        class="text-red-500">*</span></x-input-label>
                                <x-text-input id="name" name="tenancy_name" required class="w-full mt-2"
                                    placeholder="Ingrese el nombre" value="{{ old('tenancy_name') }}" />
                                <x-input-error :messages="$errors->get('tenancy_name')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Subdominio + logo --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div>
                                <x-input-label for="id">Subdominio <span
                                        class="text-red-500">*</span></x-input-label>
                                <div class="relative mt-2 flex rounded-md shadow-sm">
                                    {{-- Input --}}
                                    <x-text-input id="id" name="id" required class="flex-1 rounded-r-none"
                                        placeholder="identificador-unico" value="{{ old('id') }}" />

                                    {{-- Sufijo --}}
                                    <span
                                        class="inline-flex items-center px-2 rounded-r border border-l-0 bg-gray-50 text-gray-600 text-xs sm:text-sm whitespace-nowrap max-w-[40%] overflow-hidden text-ellipsis">
                                        .{{ $appHost }}
                                    </span>
                                </div>
                                <x-input-error :messages="$errors->get('id')" class="mt-2" />
                            </div>


                            {{-- Logo (preview bonito) --}}
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

                    {{-- ===================== --}}
                    {{-- Usuario de Acceso (Email + Claves) --}}
                    {{-- ===================== --}}
                    <div>
                        <h2 class="text-xl font-semibold flex items-center gap-3 mb-4">
                            <i class="fas fa-user-circle text-gray-600"></i>
                            Usuario de acceso
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-1">
                                <x-input-label for="tenancy_email">Correo de acceso <span
                                        class="text-red-500">*</span></x-input-label>
                                <x-text-input id="tenancy_email" name="tenancy_email" type="email" required
                                    class="w-full mt-2" placeholder="correo@ejemplo.com"
                                    value="{{ old('tenancy_email') }}" />
                                <x-input-error :messages="$errors->get('tenancy_email')" class="mt-2" />
                            </div>

                            <div class="md:col-span-1" x-data="{ show: false }">
                                <x-input-label for="tenancy_password">Contraseña <span
                                        class="text-red-500">*</span></x-input-label>
                                <div class="relative mt-2">
                                    <x-text-input id="tenancy_password" name="tenancy_password"
                                        x-bind:type="show ? 'text' : 'password'" required class="w-full pr-10"
                                        placeholder="Ingrese la contraseña" />
                                    <button type="button"
                                        class="absolute inset-y-0 right-2 flex items-center text-gray-500"
                                        @click="show = !show">
                                        <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="md:col-span-1" x-data="{ show: false }">
                                <x-input-label for="tenancy_password_confirmation">Confirmar contraseña <span
                                        class="text-red-500">*</span></x-input-label>
                                <div class="relative mt-2">
                                    <x-text-input id="tenancy_password_confirmation"
                                        name="tenancy_password_confirmation" x-bind:type="show ? 'text' : 'password'"
                                        required class="w-full pr-10" placeholder="Repita la contraseña" />
                                    <button type="button"
                                        class="absolute inset-y-0 right-2 flex items-center text-gray-500"
                                        @click="show = !show">
                                        <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- ===================== --}}
                    {{-- Información de la Empresa (dirección) --}}
                    {{-- ===================== --}}
                    <div>
                        <h2 class="text-xl font-semibold flex items-center gap-3 mb-4">
                            <i class="fas fa-map-marker-alt text-gray-600"></i>
                            Información de la empresa
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-data="ubigeoForm()"
                            x-init="init()">
                            {{-- Dirección --}}
                            <div class="md:col-span-2">
                                <x-input-label for="direccion">Dirección</x-input-label>
                                <x-text-input id="direccion" name="direccion" class="w-full mt-2"
                                    value="{{ old('direccion') }}" />
                            </div>

                            {{-- Ubigeo --}}
                            <div class="md:col-span-2">
                                <x-input-label for="ubigeo">Ubigeo</x-input-label>
                                <x-text-input id="ubigeo" name="ubigeo" class="w-full mt-2" readonly
                                    x-model="ubigeo" />
                            </div>

                            {{-- Departamento --}}
                            <div>
                                <x-input-label for="departamento">Departamento</x-input-label>
                                <select id="departamento" name="departamento" x-ref="departamento"
                                    class="w-full mt-2 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></select>
                            </div>

                            {{-- Provincia --}}
                            <div>
                                <x-input-label for="provincia">Provincia</x-input-label>
                                <select id="provincia" name="provincia" x-ref="provincia" disabled
                                    class="w-full mt-2 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></select>
                            </div>

                            {{-- Distrito --}}
                            <div>
                                <x-input-label for="distrito">Distrito</x-input-label>
                                <select id="distrito" name="distrito" x-ref="distrito" disabled
                                    class="w-full mt-2 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></select>
                            </div>

                            {{-- Teléfono --}}
                            <div>
                                <x-input-label for="telefono">Teléfono</x-input-label>
                                <x-text-input id="telefono" name="telefono" class="w-full mt-2"
                                    value="{{ old('telefono') }}" />
                            </div>

                            {{-- Email --}}
                            <div>
                                <x-input-label for="email">Email</x-input-label>
                                <x-text-input id="email" name="email" class="w-full mt-2"
                                    value="{{ old('email') }}" />
                            </div>

                        </div>
                    </div>


                    {{-- ===================== --}}
                    {{-- Permisos (Módulos + Submódulos) --}}
                    {{-- ===================== --}}
                    <div>
                        <h2 class="text-xl font-semibold flex items-center gap-3 mb-4">
                            <i class="fas fa-user-shield text-gray-600"></i>
                            Permisos (Módulos)
                        </h2>

                        <div class="space-y-4">
                            {{-- RECOMENDACIÓN: repetir este bloque por cada módulo (puedes convertirlo en componente) --}}
                            {{-- Módulo: Ventas --}}
                            <div x-data="{
                                open: false,
                                checked: false,
                                toggleAll(v) {
                                    this.$refs.subs.querySelectorAll('input[type=checkbox]').forEach(cb => cb.checked = v);
                                },
                                updateModule() {
                                    const any = Array.from(this.$refs.subs.querySelectorAll('input[type=checkbox]')).some(cb => cb.checked);
                                    this.checked = any;
                                }
                            }" x-init="updateModule()"
                                class="border rounded-lg shadow-sm overflow-hidden">
                                <div class="flex items-center justify-between px-4 py-3 bg-gray-50">
                                    <div class="flex items-center gap-3">
                                        <!-- checkbox del módulo: evitar que su click propague y toggle el acordeón -->
                                        <input type="checkbox" x-model="checked"
                                            @change="toggleAll($event.target.checked)" @click.stop
                                            class="h-4 w-4 text-blue-600 border-gray-300 rounded">

                                        <!-- nombre que abre/cierra (click aquí NO toca el checkbox) -->
                                        <button type="button" @click="open = !open"
                                            class="text-left text-sm font-semibold text-gray-800 hover:underline">
                                            Módulo Ventas
                                        </button>
                                    </div>

                                    <!-- flecha (también abre el acordeón) -->
                                    <button type="button" @click="open = !open" class="p-1 text-gray-500">
                                        <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'"></i>
                                    </button>
                                </div>

                                <div x-show="open" x-transition x-ref="subs" class="px-6 py-4 bg-white space-y-2">
                                    <label class="flex items-center gap-2">
                                        <input type="checkbox" name="permissions[]" value="ventas.ver"
                                            @change="updateModule()"
                                            class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                                        Ver ventas
                                    </label>

                                    <label class="flex items-center gap-2">
                                        <input type="checkbox" name="permissions[]" value="ventas.crear"
                                            @change="updateModule()"
                                            class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                                        Crear ventas
                                    </label>

                                    <label class="flex items-center gap-2">
                                        <input type="checkbox" name="permissions[]" value="ventas.editar"
                                            @change="updateModule()"
                                            class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                                        Editar ventas
                                    </label>

                                    <label class="flex items-center gap-2">
                                        <input type="checkbox" name="permissions[]" value="ventas.eliminar"
                                            @change="updateModule()"
                                            class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                                        Eliminar ventas
                                    </label>
                                </div>
                            </div>

                            {{-- Módulo: Inventario (ejemplo) --}}
                            <div x-data="{
                                open: false,
                                checked: false,
                                toggleAll(v) {
                                    this.$refs.subs.querySelectorAll('input[type=checkbox]').forEach(cb => cb.checked = v);
                                },
                                updateModule() {
                                    const any = Array.from(this.$refs.subs.querySelectorAll('input[type=checkbox]')).some(cb => cb.checked);
                                    this.checked = any;
                                }
                            }" x-init="updateModule()"
                                class="border rounded-lg shadow-sm overflow-hidden">
                                <div class="flex items-center justify-between px-4 py-3 bg-gray-50">
                                    <div class="flex items-center gap-3">
                                        <input type="checkbox" x-model="checked"
                                            @change="toggleAll($event.target.checked)" @click.stop
                                            class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                                        <button type="button" @click="open = !open"
                                            class="text-left text-sm font-semibold text-gray-800 hover:underline">
                                            Módulo Inventario
                                        </button>
                                    </div>
                                    <button type="button" @click="open = !open" class="p-1 text-gray-500">
                                        <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'"></i>
                                    </button>
                                </div>

                                <div x-show="open" x-transition x-ref="subs" class="px-6 py-4 bg-white space-y-2">
                                    <label class="flex items-center gap-2">
                                        <input type="checkbox" name="permissions[]" value="inventario.ver"
                                            @change="updateModule()"
                                            class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                                        Ver inventario
                                    </label>

                                    <label class="flex items-center gap-2">
                                        <input type="checkbox" name="permissions[]" value="inventario.actualizar"
                                            @change="updateModule()"
                                            class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                                        Actualizar stock
                                    </label>
                                </div>
                            </div>

                            {{-- Repite bloques de módulo según necesites --}}
                        </div>
                    </div>

                    {{-- ===================== --}}
                    {{-- Botón Guardar --}}
                    {{-- ===================== --}}
                    <div class="flex justify-end pt-4 border-t">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                            Guardar Empresa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function ubigeoForm() {
            return {
                departamentoSelect: null,
                provinciaSelect: null,
                distritoSelect: null,
                ubigeo: '',

                init() {
                    const self = this;

                    // --------------------
                    // Departamento
                    // --------------------
                    this.departamentoSelect = new TomSelect(this.$refs.departamento, {
                        valueField: 'codigo',
                        labelField: 'nombre',
                        searchField: 'nombre',
                        placeholder: 'Seleccione departamento',
                        maxItems: 1,
                        preload: true, // Carga al abrir
                        load: (query, callback) => {
                            const url = '/api/departamentos' + (query ? '?search=' + query : '');
                            fetch(url)
                                .then(res => res.json())
                                .then(data => callback(data))
                                .catch(() => callback([]));
                        },
                        onChange: (value) => {
                            // Limpiar y habilitar dependientes
                            self.provinciaSelect.clear();
                            self.provinciaSelect.disable();
                            self.distritoSelect.clear();
                            self.distritoSelect.disable();

                            // Ubigeo solo con el código del select actual
                            self.ubigeo = value || '';

                            // Cargar provincias del departamento
                            if (value) {
                                self.provinciaSelect.enable();
                                self.provinciaSelect.clearOptions();
                                fetch(
                                        `/api/provincias?departamento_id=${self.departamentoSelect.options[value].id}`
                                    )
                                    .then(res => res.json())
                                    .then(data => self.provinciaSelect.addOption(data))
                                    .catch(() => {});
                            }
                        }
                    });

                    // --------------------
                    // Provincia
                    // --------------------
                    this.provinciaSelect = new TomSelect(this.$refs.provincia, {
                        valueField: 'codigo',
                        labelField: 'nombre',
                        searchField: 'nombre',
                        placeholder: 'Seleccione provincia',
                        maxItems: 1,
                        load: (query, callback) => {
                            const depValue = self.departamentoSelect.getValue();
                            if (!depValue) return callback([]);
                            const depId = self.departamentoSelect.options[depValue].id;
                            const url = `/api/provincias?departamento_id=${depId}` + (query ? '&search=' +
                                query : '');
                            fetch(url)
                                .then(res => res.json())
                                .then(data => callback(data))
                                .catch(() => callback([]));
                        },
                        onChange: (value) => {
                            // Limpiar y habilitar distrito
                            self.distritoSelect.clear();
                            self.distritoSelect.disable();

                            // Ubigeo solo con el código del select actual
                            self.ubigeo = value || '';

                            // Cargar distritos de la provincia
                            if (value) {
                                self.distritoSelect.enable();
                                self.distritoSelect.clearOptions();
                                fetch(`/api/distritos?provincia_id=${self.provinciaSelect.options[value].id}`)
                                    .then(res => res.json())
                                    .then(data => self.distritoSelect.addOption(data))
                                    .catch(() => {});
                            }
                        }
                    });

                    // --------------------
                    // Distrito
                    // --------------------
                    this.distritoSelect = new TomSelect(this.$refs.distrito, {
                        valueField: 'codigo',
                        labelField: 'nombre',
                        searchField: 'nombre',
                        placeholder: 'Seleccione distrito',
                        maxItems: 1,
                        load: (query, callback) => {
                            const provValue = self.provinciaSelect.getValue();
                            if (!provValue) return callback([]);
                            const provId = self.provinciaSelect.options[provValue].id;
                            const url = `/api/distritos?provincia_id=${provId}` + (query ? '&search=' + query :
                                '');
                            fetch(url)
                                .then(res => res.json())
                                .then(data => callback(data))
                                .catch(() => callback([]));
                        },
                        onChange: (value) => {
                            // Ubigeo solo con el código del select actual
                            self.ubigeo = value || '';
                        }
                    });

                    // Inicialmente bloqueados
                    this.provinciaSelect.disable();
                    this.distritoSelect.disable();
                }
            }
        }
    </script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('rucForm', () => ({
                loading: false,
                init() {
                    const rucInput = document.getElementById('ruc');
                    const searchBtn = rucInput.nextElementSibling; // botón al lado del input

                    searchBtn.addEventListener('click', async () => {
                        const ruc = rucInput.value.trim();
                        if (!ruc || ruc.length !== 11) {
                            alert('Ingrese un RUC válido (11 dígitos)');
                            return;
                        }

                        this.loading = true;

                        try {
                            const res = await fetch(`/api/ruc?ruc=${ruc}`);
                            const data = await res.json();

                            if (!data.success) {
                                alert('No se encontró información para este RUC');
                                this.loading = false;
                                return;
                            }

                            const info = data.data;

                            // Nombre de la empresa
                            document.getElementById('name').value = info.razonSocial || '';

                            // Dirección
                            if (info.direccion) {
                                document.getElementById('direccion').value = info.direccion;
                            }

                            // Ubigeo
                            if (info.ubigeo && info.ubigeo.length === 6) {
                                const depCodigo = info.ubigeo.substring(0, 2);
                                const provCodigo = info.ubigeo.substring(2, 4);
                                const distCodigo = info.ubigeo.substring(4, 6);

                                const depSelect = document.getElementById('departamento')
                                    .tomselect;
                                const provSelect = document.getElementById('provincia')
                                    .tomselect;
                                const distSelect = document.getElementById('distrito')
                                    .tomselect;

                                // Departamento
                                depSelect.setValue(depCodigo);

                                // Provincias
                                provSelect.disable();
                                provSelect.clearOptions();
                                fetch(
                                        `/api/provincias?departamento_id=${depSelect.options[depCodigo].id}`)
                                    .then(res => res.json())
                                    .then(data => {
                                        provSelect.addOption(data);
                                        provSelect.enable();
                                        // Seleccionar provincia **solo si existe en las opciones**
                                        if (data.find(d => d.codigo === provCodigo)) {
                                            provSelect.setValue(provCodigo);
                                        }

                                        // Distritos
                                        distSelect.disable();
                                        distSelect.clearOptions();
                                        fetch(
                                                `/api/distritos?provincia_id=${provSelect.options[provCodigo]?.id || ''}`)
                                            .then(res => res.json())
                                            .then(distritos => {
                                                distSelect.addOption(distritos);
                                                distSelect.enable();
                                                if (distritos.find(d => d.codigo ===
                                                        distCodigo)) {
                                                    distSelect.setValue(distCodigo);
                                                }
                                            });
                                    });

                                // Ubigeo final
                                document.getElementById('ubigeo').value = info.ubigeo;
                            }


                            // Teléfono y email si vienen en la API
                            if (info.telefonos && info.telefonos.length) {
                                document.getElementById('telefono').value = info.telefonos
                                    .join(', ');
                            }

                            // Podrías agregar más campos si la API los trae en un futuro

                        } catch (error) {
                            console.error(error);
                            alert('Error al consultar RUC');
                        } finally {
                            this.loading = false;
                        }
                    });
                }
            }))
        })
    </script>



</x-app-layout>
