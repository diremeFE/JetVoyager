<?php

// database/migrations/2024_12_03_000002_create_airports_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del aeropuerto
            $table->char('code_iata', 3); // Código IATA del aeropuerto
            $table->foreignId('city_id')->constrained('cities'); // Relación con la tabla cities
            $table->timestamps(0); // Tiempos de creación y actualización sin fracción de segundo
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airports');
    }
}
