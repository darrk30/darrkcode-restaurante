<div class="w-full max-w-4xl mx-auto mt-10 p-4 border rounded shadow-lg bg-white">

  <!-- TABS -->
  <div class="flex border-b border-gray-200 mb-4">
    <button class="py-2 px-4 text-blue-500 border-b-2 border-blue-500 font-semibold">General</button>
    <button class="py-2 px-4 text-gray-500">Variantes</button>
  </div>

  <!-- CONTENIDO GENERAL -->
  <div class="space-y-4">
    <div>
      <label class="block text-gray-500 text-sm">Nombre del producto</label>
      <input type="text" placeholder="Ej: Camiseta" class="w-full border-b-2 border-gray-300 focus:border-blue-500 focus:outline-none py-2">
    </div>

    <div>
      <label class="block text-gray-500 text-sm">Descripción</label>
      <textarea placeholder="Descripción del producto" class="w-full border-b-2 border-gray-300 focus:border-blue-500 focus:outline-none py-2"></textarea>
    </div>

    <div class="grid grid-cols-2 gap-6">
      <div>
        <label class="block text-gray-500 text-sm">Precio</label>
        <input type="number" placeholder="0.00" class="w-full border-b-2 border-gray-300 focus:border-blue-500 focus:outline-none py-2">
      </div>
      <div>
        <label class="block text-gray-500 text-sm">Stock</label>
        <input type="number" placeholder="0" class="w-full border-b-2 border-gray-300 focus:border-blue-500 focus:outline-none py-2">
      </div>
    </div>
  </div>

  <!-- CONTENIDO VARIANTES -->
  <div class="mt-8 space-y-4">
    <div class="flex items-center gap-4">
      <input type="text" placeholder="Nombre de la variante" class="flex-1 border-b-2 border-gray-300 focus:border-blue-500 focus:outline-none py-2">
      <input type="number" placeholder="Precio adicional" class="w-32 border-b-2 border-gray-300 focus:border-blue-500 focus:outline-none py-2">
      <button class="px-4 py-2 bg-blue-500 text-white rounded">Agregar</button>
    </div>

    <div class="border rounded p-4 bg-gray-50 space-y-2">
      <div class="flex justify-between items-center p-2 bg-white rounded shadow-sm">
        <span>Variante 1</span>
        <div class="flex gap-2">
          <span class="text-gray-500">$10.00</span>
          <button class="px-2 py-1 text-sm bg-red-500 text-white rounded">Eliminar</button>
        </div>
      </div>
      <div class="flex justify-between items-center p-2 bg-white rounded shadow-sm">
        <span>Variante 2</span>
        <div class="flex gap-2">
          <span class="text-gray-500">$5.00</span>
          <button class="px-2 py-1 text-sm bg-red-500 text-white rounded">Eliminar</button>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-2 gap-6 mt-4">
      <div>
        <label class="block text-gray-500 text-sm">Cantidad por variante</label>
        <input type="number" placeholder="0" class="w-full border-b-2 border-gray-300 focus:border-blue-500 focus:outline-none py-1">
      </div>
      <div class="flex items-center gap-2 mt-6">
        <input type="checkbox" class="accent-blue-500">
        <span class="text-gray-600">Habilitar stock por variante</span>
      </div>
    </div>
  </div>

</div>
