<?php

namespace App\Models\Tenancy;

use Illuminate\Database\Eloquent\Model;

class Impresora extends Model
{
    
    protected $fillable = ['nombre', 'status'];

    // Relación con Piso
    public function pisos()
    {
        return $this->hasMany(Piso::class);
    }

    // Relación con Areas de produccion
    public function areas_produccion()
    {
        return $this->hasMany(AreaProduccion::class);
    }
}
