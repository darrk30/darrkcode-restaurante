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
        Schema::create('area_produccions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('status')->default(1); // 1: activo,`
            $table->foreignId('impresora_id')->nullable()->constrained('impresoras')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_produccions');
    }
};
