<?php

namespace App\Livewire\Tenancy\AreaProduccion;

use App\Models\Tenancy\AreaProduccion as TenancyAreaProduccion;
use Livewire\Component;
use Livewire\WithPagination;

class AreaProduccion extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';
    public $toastError = null;
    protected $listeners = ['areaProduccionSaved' => 'closeAreasProduccion'];

    public function deleteAreaproduccion($id)
    {
        try {
            TenancyAreaProduccion::findOrFail($id)->delete();
            $this->dispatch('deleted');
        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'No se puede eliminar el area de producción porque esta en uso.');
            $this->dispatch('deleted');
            return;
        }
        $this->closeAreasProduccion();
    }

    public function placeholder()
    {
        return view('tenancy.ajustes.areasProduccion.skeletonAreasProduccion');
    }

    public function closeAreasProduccion()
    {
        $this->dispatch('close-areaproduccion');
        return TenancyAreaProduccion::select('id', 'nombre', 'status', 'impresora_id')->orderBy('id', 'desc')->paginate(10);
    }

    public function render()
    {
        // Consulta optimizada
        $areasproduccion = TenancyAreaProduccion::select('id', 'nombre', 'status', 'impresora_id')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.tenancy.ajustes.area-produccion.area-produccion', [
            'areasproduccion' => $areasproduccion,
        ]);
    }
}
