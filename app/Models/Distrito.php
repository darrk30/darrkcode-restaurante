<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $fillable = ['codigo', 'nombre', 'provincia_id'];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }
}
