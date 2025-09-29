<?php

namespace App\Models\Tenancy;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre', 'status', 'orden'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
