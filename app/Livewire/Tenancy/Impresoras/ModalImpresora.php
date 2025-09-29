<?php

namespace App\Livewire\Tenancy\Impresoras;

use App\Models\Tenancy\Impresora;
use Livewire\Component;

class ModalImpresora extends Component
{
    public $toastError = null;

    public function save($impresora)
    {
        // Validación
        $this->validateData($impresora);

        try {
            if (!empty($impresora['id'])) {
                // Editar
                Impresora::findOrFail($impresora['id'])->update([
                    'nombre' => $impresora['nombre'],
                    'status' => (bool) $impresora['status'],
                ]);
            } else {
                // Crear
                Impresora::create([
                    'nombre' => $impresora['nombre'],
                    'status' => (bool) $impresora['status'],
                ]);
            }

            // Emitir evento global para refrescar tabla/listado
            $this->dispatch('impresoraSaved');
        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'No se pudo guardar la impresora. Verifica los datos o intenta más tarde.');
        }
    }

    public function resetForm()
    {
        $this->resetValidation();
    }

    private function validateData($data)
    {
        validator($data, [
            'nombre' => 'required|string|max:255',
            'status' => 'boolean',
        ])->validate();
    }

    public function render()
    {
        return view('livewire.tenancy.ajustes.impresoras.modal-impresora');
    }
}
