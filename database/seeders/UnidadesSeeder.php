<?php

namespace Database\Seeders;

use App\Models\Tenancy\Unidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unidad::create(['nombre' => 'Unidad', 'codigo' => 'UND', 'simbolo' => 'u', 'status' => 1]);
        Unidad::create(['nombre' => 'Kilogramo', 'codigo' => 'KG', 'simbolo' => 'kg', 'status' => 1]);
        Unidad::create(['nombre' => 'Litro', 'codigo' => 'LT', 'simbolo' => 'L', 'status' => 1]);
    }
}
