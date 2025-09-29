<?php

namespace App\Models\Tenancy;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = ['razon_social', 'nombre_comercial', 'ruc', 'email', 'telefono', 'direccion', 'ubigeo', 'descripcion', 'logo', 'distrito_id'];

    
}
