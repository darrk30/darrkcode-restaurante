<?php

namespace App\Livewire\Tenancy\AreaProduccion;

use App\Models\Tenancy\AreaProduccion;
use App\Models\Tenancy\Impresora;
use Livewire\Component;

class ModalAreaProduccion extends Component
{
    public $impresoras = [];
    public $toastError = null;

    public function mount()
    {
        $this->impresoras = Impresora::pluck('nombre', 'id');
    }

    public function save($areaProduccion)
    {
        // Validación
        $this->validateData($areaProduccion);

        try {
            if (!empty($areaProduccion['id'])) {
                // Editar
                AreaProduccion::findOrFail($areaProduccion['id'])->update([
                    'nombre' => $areaProduccion['nombre'],
                    'status' => (bool) $areaProduccion['status'],
                    'impresora_id' => $areaProduccion['impresora_id'] !== '' ? $areaProduccion['impresora_id'] : null,
                ]);
            } else {
                // Crear
                AreaProduccion::create([
                    'nombre' => $areaProduccion['nombre'],
                    'status' => (bool) $areaProduccion['status'],
                    'impresora_id' => $areaProduccion['impresora_id'] !== '' ? $areaProduccion['impresora_id'] : null,
                ]);
            }

            // Emitir evento global para refrescar tabla/listado
            $this->dispatch('areaProduccionSaved');
        } catch (\Exception $e) {
            dd($e);
            $this->dispatch('alert', type: 'error', message: 'No se pudo guardar el area de producción. Verifica los datos o intenta más tarde.');
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
            'impresora_id' => 'nullable|exists:impresoras,id',
        ])->validate();
    }

    public function render()
    {
        return view('livewire.tenancy.ajustes.area-produccion.modal-area-produccion');
    }
}
