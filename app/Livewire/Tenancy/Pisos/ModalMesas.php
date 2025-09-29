<?php

namespace App\Livewire\Tenancy\Pisos;

use Livewire\Component;
use App\Models\Tenancy\Mesa;

class ModalMesas extends Component
{
    public $toastError = null;

    public function save($piso)
    {
        $this->validateData($piso);
        try {
            if (!empty($piso['id'])) {
                Mesa::findOrFail($piso['id'])->update([
                    'nombre'  => $piso['nombre'],
                    'status'  => $piso['status'],
                    'piso_id' => $piso['piso_id'],
                ]);
            } else {
                Mesa::create([
                    'nombre'  => $piso['nombre'],
                    'status'  => $piso['status'],
                    'piso_id' => $piso['piso_id'],
                ]);
            }
            $this->dispatch('mesaSave');
        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'No se pudo guardar la mesa. Verifica los datos o intenta más tarde.');
        }
    }

    private function validateData($data)
    {
        validator($data, [
            'nombre' => 'required|string|max:255',
            'status' => 'boolean',
            'piso_id' => 'nullable|exists:pisos,id',
        ])->validate();
    }

    public function resetForm()
    {
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.tenancy.ajustes.pisos.modal-mesas');
    }
}
