<?php

namespace Database\Seeders;

use App\Models\Tenancy\TypeProducto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeProducto::create([
            'nombre' => 'Almacenado',
            'codigo' => 'ALM',
            'status' => 1,
        ]);

        TypeProducto::create([
            'nombre' => 'Preparado',
            'codigo' => 'PREP',
            'status' => 1,
        ]);
    }
}
