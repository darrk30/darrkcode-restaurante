<div>
    <div class="flex items-center justify-between flex-wrap gap-4 border-b-2 pb-2">

        <!-- IZQUIERDA -->
        <div class="flex items-center">
            <x-button-link href="{{route('productos.create')}}" class="cursor-pointer">Nuevo</x-button-link>
            <h1 class="text-lg ml-2 text-gray-800">Productos</h1>
        </div>
    </div>
    <!-- LISTADO DE PRODUCTOS -->
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-2 items-stretch">
        @foreach ($productos as $producto)
            <div class="border rounded-lg p-2 flex flex-col justify-between h-full">
                <div class="flex items-start gap-3">
                    <img src="{{ $producto->imagen ?? 'https://www.arosa.sk/wp-content/themes/invelity/images/default-product.jpg' }}"
                        alt="Producto" class="w-16 h-16 rounded object-cover">
                    <div class="flex-1">
                        <a href="#" class="text-sm font-semibold text-gray-800 hover:text-blue-700">
                            {{ $producto->nombre }}
                        </a>
                        <p class="text-sm text-gray-500">
                            Stock: <span class="font-medium text-green-600">{{ $producto->stock }}</span>
                            <span class="mx-1">·</span>
                            Variantes: <span
                                class="font-medium text-gray-700">{{ $producto->variantes_count ?? 0 }}</span>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
