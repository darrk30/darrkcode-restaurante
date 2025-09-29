<?php

namespace App\Livewire\Tenancy\Categorias;

use App\Models\Tenancy\Categoria;
use Livewire\Component;
use Livewire\WithPagination;

class Categorias extends Component
{

    use WithPagination;

    protected $paginationTheme = 'tailwind';
    public $toastError = null;
    protected $listeners = ['categoriaSaved' => 'closeCategoria'];

    public function deleteCategoria($id)
    {
        try {
            $cat = Categoria::findOrFail($id);
            $ordenEliminado = $cat->orden;
            $cat->delete();
            // Compactar órdenes para no dejar huecos
            Categoria::where('orden', '>', $ordenEliminado)->decrement('orden');
            $this->dispatch('deleted');
        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'No se puede eliminar la categoria porque está en uso.');
            $this->dispatch('deleted');
            return;
        }

        $this->closeCategoria();
    }

    public function placeholder()
    {
        return view('tenancy.productos.categorias.skeletonCategorias');
    }

    public function closeCategoria()
    {
        $this->dispatch('close-categoria');
    }

    public function render()
    {
        // Consulta optimizada
        $categorias = Categoria::select('id', 'nombre', 'status', 'orden')
            ->orderBy('orden', 'asc')
            ->paginate(10);

        return view('livewire.tenancy.productos.categorias.categorias', [
            'categorias' => $categorias,
        ]);
    }
}
