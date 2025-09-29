<?php

namespace App\Models\Tenancy;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $guarded = ['id'];

    // Relación con Categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Relación con Tipo de Producto
    public function typeProducto()
    {
        return $this->belongsTo(TypeProducto::class);
    }

    // Relación con IGV (Impuesto)
    public function igv()
    {
        return $this->belongsTo(Impuesto::class);
    }

    // Relación con Unidad (si cada producto tiene unidad base)
    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }
}
