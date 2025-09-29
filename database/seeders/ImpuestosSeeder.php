<?php

namespace Database\Seeders;

use App\Models\Tenancy\Impuesto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImpuestosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Impuesto::create([
            'nombre' => 'IGV 18% (Incluido)',
            'descripcion' => 'Impuesto General a las Ventas incluido en el precio',
            'porcentaje' => 18,
            'codigo' => 'IGV',
            'incluido_precio' => true,
            'status' => 1,
        ]);

        Impuesto::create([
            'nombre' => 'IGV 18% (No incluido)',
            'descripcion' => 'Impuesto General a las Ventas agregado al total',
            'porcentaje' => 18,
            'codigo' => 'IGV',
            'incluido_precio' => false,
            'status' => 1,
        ]);
    }
}
