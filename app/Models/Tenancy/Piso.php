<?php

namespace App\Models\Tenancy;

use App\Enums\StatusPiso;
use Illuminate\Database\Eloquent\Model;

class Piso extends Model
{

    protected $fillable = ['nombre', 'status', 'impresora_id'];

    // Relación con Mesa
    public function mesas()
    {
        return $this->hasMany(Mesa::class);
    }

    // Relación con Impresora
    public function impresora()
    {
        return $this->belongsTo(Impresora::class);
    }
}
