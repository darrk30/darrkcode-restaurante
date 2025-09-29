<?php

namespace App\Livewire\Tenancy\Productos;

use App\Models\Tenancy\Categoria;
use App\Models\Tenancy\Producto;
use Livewire\Component;

class Productos extends Component
{
    public $filters = ['publicado']; // filtros iniciales
    public $categorias = [];          // categorías desde DB
    public $selectedCat = '';         // categoría seleccionada

    public function mount()
    {
        $this->categorias = Categoria::all();
    }

    public function render()
    {
        $productos = Producto::select('id', 'nombre', 'status')->orderBy('id', 'desc')->paginate(10);
        return view('livewire.tenancy.productos.productos.productos', [
            'productos' => $productos,
        ]);
    }
}
