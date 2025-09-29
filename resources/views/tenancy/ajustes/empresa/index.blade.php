<x-tenancy-layout>
    <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-2xl p-6 mt-8">

        <!-- Header con Logo y Razón Social -->
        <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-8 border-b pb-6 md:text-left">

            <!-- Contenedor del logo clickeable -->
            <label for="logo"
                class="cursor-pointer h-24 w-40 md:w-64 rounded-xl overflow-hidden border bg-gray-50 flex items-center justify-center shadow-sm hover:shadow-md transition">
                <img id="logoPreview"
                    src="{{ $empresa->logo
                        ? asset('storage/' . $empresa->logo)
                        : 'https://empleo.camaradesevilla.com/tenancy/assets/images/logo-empresa-default.png' }}"
                    alt="logo" class="h-full w-full object-contain p-2">
            </label>

            <!-- Input oculto -->
            <input type="file" id="logo" name="logo" accept="image/*" class="hidden">

            <!-- Texto -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    {{ $empresa->razon_social ?? 'Mi Empresa' }}
                </h1>
                <p class="text-gray-500 text-sm">
                    {{ $empresa->nombre_comercial ?? 'Nombre Comercial' }}
                </p>
            </div>
        </div>

        <!-- Formulario -->
        <form action="{{ route('empresa.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Nombre Comercial -->
            <div>
                <label class="block text-sm font-semibold text-gray-600">Nombre Comercial</label>
                <input type="text" name="nombre_comercial"
                    value="{{ old('nombre_comercial', $empresa->nombre_comercial) }}"
                    class="w-full border-0 border-b-2 border-gray-300 focus:border-blue-500 focus:ring-0 text-gray-800 py-2">
            </div>

            <!-- RUC y Correo -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-semibold text-gray-600">RUC</label>
                    <input type="text" name="ruc" value="{{ old('ruc', $empresa->ruc) }}" readonly
                        class="w-full border-0 border-b-2 border-gray-300 focus:border-blue-500 focus:ring-0 text-gray-800 py-2 bg-gray-100 cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600">Correo</label>
                    <input type="email" name="email" value="{{ old('email', $empresa->email) }}"
                        class="w-full border-0 border-b-2 border-gray-300 focus:border-blue-500 focus:ring-0 text-gray-800 py-2">
                </div>
            </div>

            <!-- Teléfono y Ubigeo -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-semibold text-gray-600">Teléfono</label>
                    <input type="text" name="telefono" value="{{ old('telefono', $empresa->telefono) }}"
                        class="w-full border-0 border-b-2 border-gray-300 focus:border-blue-500 focus:ring-0 text-gray-800 py-2">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600">Ubigeo</label>
                    <input type="text" id="ubigeo" name="ubigeo" value="{{ old('ubigeo', $empresa->ubigeo) }}"
                        class="w-full border-0 border-b-2 border-gray-300 focus:border-blue-500 focus:ring-0 text-gray-800 py-2 bg-gray-50">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Departamento -->
                <div>
                    <label for="departamento" class="block text-sm font-medium text-gray-700 mb-1">Departamento</label>
                    <select id="departamento" name="departamento"
                        class="block py-2.5 px-0 w-full text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer">
                        <option value="">Seleccione...</option>
                    </select>
                </div>

                <!-- Provincia -->
                <div>
                    <label for="provincia" class="block text-sm font-medium text-gray-700 mb-1">Provincia</label>
                    <select id="provincia" name="provincia"
                        class="block py-2.5 px-0 w-full text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer">
                        <option value="">Seleccione...</option>
                    </select>
                </div>

                <!-- Distrito -->
                <div>
                    <label for="distrito" class="block text-sm font-medium text-gray-700 mb-1">Distrito</label>
                    <select id="distrito" name="distrito"
                        class="block py-2.5 px-0 w-full text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer">
                        <option value="">Seleccione...</option>
                    </select>
                </div>
            </div>



            <!-- Dirección -->
            <div>
                <label class="block text-sm font-semibold text-gray-600">Dirección</label>
                <input type="text" name="direccion" value="{{ old('direccion', $empresa->direccion) }}"
                    class="w-full border-0 border-b-2 border-gray-300 focus:border-blue-500 focus:ring-0 text-gray-800 py-2">
            </div>

            <!-- Botón -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-200">
                    Guardar cambios
                </button>
            </div>
        </form>
    </div>
    @if (session('success'))
        <x-toast :message="session('success')" type="success" :duration="3000" />
    @endif

    @if (session('error'))
        <x-toast :message="session('error')" type="error" :duration="3000" />
    @endif
    <script>
        // Previsualizar logo
        document.getElementById('logo').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById('logoPreview').src = URL.createObjectURL(file);
            }
        });

        // Ubigeo dinámico
        document.addEventListener("DOMContentLoaded", async () => {
            const departamentoSelect = document.getElementById('departamento');
            const provinciaSelect = document.getElementById('provincia');
            const distritoSelect = document.getElementById('distrito');
            const ubigeoInput = document.getElementById('ubigeo');

            const ubigeo = "{{ $empresa->ubigeo ?? '' }}";
            const departamento_id = ubigeo.substring(0, 2);
            const provincia_id = ubigeo.substring(0, 4);
            const distrito_id = ubigeo;

            // Departamentos
            let res = await fetch("/api/departamentos");
            let departamentos = await res.json();
            departamentos.forEach(dep => {
                let opt = new Option(dep.nombre, dep.codigo);
                if (dep.codigo === departamento_id) opt.selected = true;
                departamentoSelect.add(opt);
            });

            // Provincias
            async function loadProvincias(depCodigo) {
                provinciaSelect.innerHTML = "<option value=''>Seleccione...</option>";
                distritoSelect.innerHTML = "<option value=''>Seleccione...</option>";
                let res = await fetch(`/api/provincias?departamento_codigo=${depCodigo}`);
                let provincias = await res.json();
                provincias.forEach(prov => {
                    let opt = new Option(prov.nombre, prov.codigo);
                    if (prov.codigo === provincia_id) opt.selected = true;
                    provinciaSelect.add(opt);
                });
            }

            // Distritos
            async function loadDistritos(provCodigo) {
                distritoSelect.innerHTML = "<option value=''>Seleccione...</option>";
                let res = await fetch(`/api/distritos?provincia_codigo=${provCodigo}`);
                let distritos = await res.json();
                distritos.forEach(dis => {
                    let opt = new Option(dis.nombre, dis.codigo);
                    if (dis.codigo === distrito_id) opt.selected = true;
                    distritoSelect.add(opt);
                });
            }

            // Listeners
            departamentoSelect.addEventListener("change", async e => {
                provinciaSelect.innerHTML = "<option value=''>Seleccione...</option>";
                distritoSelect.innerHTML = "<option value=''>Seleccione...</option>";
                ubigeoInput.value = ""; // limpiar hasta que elija distrito
                if (e.target.value) {
                    await loadProvincias(e.target.value);
                }
            });

            provinciaSelect.addEventListener("change", async e => {
                distritoSelect.innerHTML = "<option value=''>Seleccione...</option>";
                ubigeoInput.value = ""; // limpiar hasta que elija distrito
                if (e.target.value) {
                    await loadDistritos(e.target.value);
                }
            });

            distritoSelect.addEventListener("change", e => {
                ubigeoInput.value = e.target.value; // actualizar SOLO con distrito
            });

            // Inicialización
            if (departamentoSelect.value) {
                await loadProvincias(departamentoSelect.value);
                if (provinciaSelect.value) {
                    await loadDistritos(provinciaSelect.value);
                }
            }
        });
    </script>

</x-tenancy-layout>
