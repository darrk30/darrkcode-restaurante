<?php

namespace App\Models\Tenancy;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $fillable = ['nombre', 'status', 'piso_id'];

    // Relación con Piso
    public function piso()
    {
        return $this->belongsTo(Piso::class);
    }
}
