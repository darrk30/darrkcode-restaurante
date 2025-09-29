<?php

namespace App\Livewire\Tenancy\Categorias;

use App\Models\Tenancy\Categoria;
use Livewire\Component;

class ModalCategorias extends Component
{

    public $categoria = [];
    public $toastError = null;

    public function save($categoria)
    {
        $this->validateData($categoria);

        try {
            if (!empty($categoria['id'])) {
                // Editar existente
                $cat = Categoria::findOrFail($categoria['id']);
                $nuevoOrden = max(1, (int)$categoria['orden']); // mínimo 1

                // Si cambia el orden, hacemos corrimiento
                if ($cat->orden != $nuevoOrden) {
                    if ($nuevoOrden < $cat->orden) {
                        // Moviendo hacia arriba → desplazar los que estaban antes
                        Categoria::where('orden', '>=', $nuevoOrden)->where('orden', '<', $cat->orden)->increment('orden');
                    } else {
                        // Moviendo hacia abajo → desplazar los que estaban después
                        Categoria::where('orden', '<=', $nuevoOrden)->where('orden', '>', $cat->orden)->decrement('orden');
                    }
                }

                // Finalmente actualizo el registro editado
                $cat->update([
                    'nombre' => $categoria['nombre'],
                    'status' => (bool) $categoria['status'],
                    'orden' => $nuevoOrden,
                ]);
            } else {
                // Crear nueva categoría
                $nuevoOrden = !empty($categoria['orden']) ? max(1, (int)$categoria['orden']) : (Categoria::max('orden') ?? 0) + 1;
                // Corrimiento de órdenes para insertar en medio
                Categoria::where('orden', '>=', $nuevoOrden)->increment('orden');

                Categoria::create([
                    'nombre' => $categoria['nombre'],
                    'status' => (bool) $categoria['status'],
                    'orden'  => $nuevoOrden,
                ]);
            }


            $this->dispatch('categoriaSaved');
        } catch (\Exception $e) {
            $this->dispatch(
                'alert',
                type: 'error',
                message: 'No se pudo guardar la categoría. Verifica los datos o intenta más tarde.'
            );
        }
    }

    public function getNextOrden()
    {
        return (Categoria::max('orden') ?? 0) + 1;
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
            'orden' => 'nullable|int',
        ])->validate();
    }

    public function render()
    {
        return view('livewire.tenancy.productos.categorias.modal-categorias');
    }
}
