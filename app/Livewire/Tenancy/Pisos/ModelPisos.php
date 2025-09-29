<?php

namespace App\Livewire\Tenancy\Pisos;

use Livewire\Component;
use App\Models\Tenancy\Piso;
use App\Models\Tenancy\Impresora;

class ModelPisos extends Component
{
    public $impresoras = [];
    public $toastError = null;

    public function mount()
    {
        $this->impresoras = Impresora::pluck('nombre', 'id');
    }

    // Guarda o actualiza el piso (optimizado)
    public function save($piso)
    {
       $this->validateData($piso);

        try {
            if (!empty($piso['id'])) {
                Piso::findOrFail($piso['id'])->update([
                    'nombre' =>  $piso['nombre'],
                    'status' => (bool) $piso['status'],
                    'impresora_id' => $piso['impresora_id'] !== '' ? $piso['impresora_id'] : null,
                ]);
            } else {
                Piso::create([
                    'nombre' =>  $piso['nombre'],
                    'status' => (bool) $piso['status'],
                    'impresora_id' => $piso['impresora_id'] !== '' ? $piso['impresora_id'] : null,
                ]);
            }

            $this->dispatch('pisoSave');
            
        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'No se pudo guardar el piso. Verifica los datos o intenta más tarde.');
        }
    }

    private function validateData($data)
    {
        validator($data, [
            'nombre' => 'required|string|max:255',
            'status' => 'boolean',
            'impresora_id' => 'nullable|exists:impresoras,id',
        ])->validate();
    }

    // Método para resetear campos y errores
    public function resetForm()
    {
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.tenancy.ajustes.pisos.model-pisos');
    }
}