<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('impuestos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // 
            $table->string('descripcion')->nullable(); // Ej: IGV 18%
            $table->decimal('porcentaje', 5, 2)->default(0.00); // 18.00
            $table->string('codigo')->nullable(); // Ej: IGV, EXO, INA
            $table->boolean('incluido_precio')->default(true); // Ej: esta incluido en el precio
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impuestos');
    }
};
