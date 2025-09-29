<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'max_users',
        'status',
    ];

    // Relación con Tenant
    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }
}
