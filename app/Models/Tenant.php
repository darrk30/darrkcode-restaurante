<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    // Campos rellenables
    protected $fillable = [
        'id',
        'tenancy_name',
        'tenancy_ruc',
        'tenancy_email',
        'tenancy_password',
        'tenancy_status',
    ];

    // Decirle a Stancl que estas columnas son "reales"
    public static function getCustomColumns(): array
    {
        return [
            'id',
            'tenancy_name',
            'tenancy_ruc',
            'tenancy_email',
            'tenancy_password',
            'tenancy_status',
        ];
    }
}
