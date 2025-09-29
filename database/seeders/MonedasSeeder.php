<?php

namespace Database\Seeders;

use App\Models\Tenancy\Moneda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonedasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Moneda::create([
            'nombre' => 'Sol Peruano',
            'simbolo' => 'S/',
            'codigo' => 'PEN',
            'status' => 1,
        ]);

        Moneda::create([
            'nombre' => 'Dólar Americano',
            'simbolo' => '$',
            'codigo' => 'USD',
            'status' => 1,
        ]);
    }
}
