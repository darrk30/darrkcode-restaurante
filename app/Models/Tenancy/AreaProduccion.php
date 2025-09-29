<?php

namespace App\Models\Tenancy;

use Illuminate\Database\Eloquent\Model;

class AreaProduccion extends Model
{
    protected $fillable = ['nombre', 'status', 'impresora_id'];

    // Relación con Impresora
    public function impresora()
    {
        return $this->belongsTo(Impresora::class);
    } 
}
