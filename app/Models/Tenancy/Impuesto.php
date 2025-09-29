<?php

namespace App\Models\Tenancy;

use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
    protected $guarded = ['id'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
