<?php

// database/migrations/2024_12_03_000006_create_seats_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id(); // ID del asiento
            $table->foreignId('airplane_id')->constrained('airplanes'); // Relación con la tabla `airplanes`
            $table->string('seat_number', 10); // Número del asiento (varchar(10))
            $table->enum('seat_type', ['economy', 'business', 'first'])->default('economy'); // Tipo de asiento (economy, business, first)
            $table->enum('status', ['available', 'reserved', 'unavailable'])->default('available'); // Estado del asiento
            $table->timestamps(0); // Tiempos de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seats');
    }
}
