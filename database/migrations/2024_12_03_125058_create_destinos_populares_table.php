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
        Schema::create('destinos_populares', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('precio');
            
            // Campos de fecha con enteros restringidos
            $table->unsignedTinyInteger('dia_disponible'); // Número del día (1-31)
            $table->unsignedTinyInteger('mes_disponible'); // Número del mes (1-12)

            // Campo para la imagen
            $table->string('imagen')->nullable();  // Ruta de la imagen o nombre del archivo

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinos_populares');
    }
};
