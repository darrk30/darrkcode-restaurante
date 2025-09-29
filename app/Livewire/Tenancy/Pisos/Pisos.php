<?php

namespace App\Livewire\Tenancy\Pisos;

use Livewire\Component;
use App\Models\Tenancy\Piso;
use App\Models\Tenancy\Mesa;
use Livewire\WithPagination;

class Pisos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    public $selectedPiso = null;
    public $toastError = null;

    protected $listeners = [
        'pisoSave' => 'closePisos',
        'mesaSave' => 'closeMesas',
    ];

    public function mount()
    {
        $this->selectedPiso = Piso::first()?->id;
    }

    // 🔹 Paginación de mesas por piso seleccionado
    public function getMesasProperty()
    {
        if (!$this->selectedPiso) {
            return collect();
        }

        return Mesa::where('piso_id', $this->selectedPiso)
            ->select('id', 'nombre', 'status', 'piso_id')
            ->paginate(10, ['*'], 'mesasPage');
    }

    // 🔹 Cuando se cambia de página en pisos
    public function updatedPisosPage($page)
    {
        $firstPiso = Piso::select('id', 'nombre', 'status', 'impresora_id')
            ->with(['impresora:id,nombre'])
            ->paginate(10, ['*'], 'pisosPage', $page)
            ->first();

        $this->selectedPiso = $firstPiso?->id;
        $this->resetPage('mesasPage');
    }

    // Cuando cambia manualmente el piso seleccionado
    public function updatedSelectedPiso()
    {
        $this->resetPage('mesasPage');
    }

    public function deletePiso($id)
    {
        try {
            Piso::findOrFail($id)->delete();
            $this->dispatch('deleted');
        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'No se pudo eliminar el piso. Puede tener dependencias.');
            return;
        }

        $this->resetPage('pisosPage');

        $firstPiso = Piso::select('id')->paginate(10, ['*'], 'pisosPage')->first();
        $this->selectedPiso = $firstPiso?->id;
    }

    public function closePisos()
    {
        $this->resetPage('pisosPage');
        $this->dispatch('close-piso');
    }

    public function closeMesas()
    {
        $this->resetPage('mesasPage');
        $this->dispatch('close-mesa');
    }

    public function deleteMesa($id)
    {
        try {
            Mesa::findOrFail($id)->delete();
            $this->dispatch('deleted');
        } catch (\Exception $e) {
            $this->toastError = 'No se pudo eliminar la mesa.';
            $this->dispatch('alert', type: 'error', message: 'No se pudo eliminar la mesa.');
            return;
        }
        $this->resetPage('mesasPage');
    }

    public function placeholder()
    {
        return view('tenancy.ajustes.pisos.skeletonSalonMesa');
    }

    public function render()
    {
        $pisos = Piso::select('id', 'nombre', 'status', 'impresora_id')
            ->with(['impresora:id,nombre'])
            ->paginate(10, ['*'], 'pisosPage');

        $selectedPisoObj = $this->selectedPiso
            ? $pisos->firstWhere('id', $this->selectedPiso)
            : null;

        return view('livewire.tenancy.ajustes.pisos.pisos', [
            'pisos' => $pisos,
            'mesas' => $this->mesas,
            'selectedPisoObj' => $selectedPisoObj,
        ]);
    }
}