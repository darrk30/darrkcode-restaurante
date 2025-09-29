<?php

namespace App\Models\Tenancy;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    protected $table = 'unidades';
    protected $guarded = ['id'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
