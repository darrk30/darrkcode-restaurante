<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;

class UbigeosSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('data/UBIGEOS_2022_1891_distritos.csv');

        if (!file_exists($file)) {
            $this->command->error("El archivo CSV no existe en: $file");
            return;
        }

        $handle = fopen($file, 'r');
        $header = fgetcsv($handle, 1000, ','); // Saltar encabezado

        while (($row = fgetcsv($handle, 1000, ';')) !== false) {
            if (count($row) < 4) {
                $this->command->warn("Fila inválida, saltada: " . implode(', ', $row));
                continue;
            }
            $this->command->info("Procesando: " . implode(', ', $row));
            $ubigeo            = trim($row[0]);
            $departamentoNombre = mb_convert_encoding(trim($row[1]), 'UTF-8', 'ISO-8859-1');
            $provinciaNombre   = mb_convert_encoding(trim($row[2]), 'UTF-8', 'ISO-8859-1');
            $distritoNombre    = mb_convert_encoding(trim($row[3]), 'UTF-8', 'ISO-8859-1');


            $codDep  = substr($ubigeo, 0, 2);
            $codProv = substr($ubigeo, 0, 4);
            $codDist = substr($ubigeo, 0, 6);

            // Departamento
            $departamento = Departamento::firstOrCreate(
                ['codigo' => $codDep],
                ['nombre' => $departamentoNombre]
            );

            // Provincia
            $provincia = Provincia::firstOrCreate(
                ['codigo' => $codProv],
                [
                    'nombre' => $provinciaNombre,
                    'departamento_id' => $departamento->id,
                ]
            );

            // Distrito
            Distrito::firstOrCreate(
                ['codigo' => $codDist],
                [
                    'nombre' => $distritoNombre,
                    'provincia_id' => $provincia->id,
                ]
            );
        }

        fclose($handle);

        $this->command->info('Ubigeos cargados correctamente con modelos ✅');
    }
}
