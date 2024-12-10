<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airplane_id')->constrained('airplanes');
            $table->foreignId('origin_airport_id')->constrained('airports');
            $table->foreignId('destination_airport_id')->constrained('airports');
            $table->date('flight_date'); 
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->time('total_duration')->nullable(); 
            $table->unsignedTinyInteger('stopovers_count')->default(0); 
            $table->json('stopover_cities')->nullable(); 
            $table->decimal('base_price', 10, 2);
            $table->enum('status', ['scheduled', 'canceled', 'completed'])->default('scheduled');
            $table->string('flight_number')->nullable();
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
}
