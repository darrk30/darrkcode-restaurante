<?php

namespace App\Livewire\Tenancy\Impresoras;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tenancy\Impresora;

class Impresoras extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';
    public $toastError = null;
    protected $listeners = ['impresoraSaved' => 'closeImpresoras'];

    public function deleteImpresora($id)
    {
        try {
            Impresora::findOrFail($id)->delete();
            $this->dispatch('deleted');
        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'No se puede eliminar la impresora esta en uso.');
            $this->dispatch('deleted');
            return;
        }
        $this->closeImpresoras();
    }

    public function placeholder()
    {
        return view('tenancy.ajustes.impresoras.skeletonImpresoras');
    }

    public function closeImpresoras()
    {
        $this->dispatch('close-impresora');
    }

    public function render()
    {
        // Consulta optimizada
        $impresoras = Impresora::select('id', 'nombre', 'status')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.tenancy.ajustes.impresoras.impresoras', [
            'impresoras' => $impresoras,
        ]);
    }
}
