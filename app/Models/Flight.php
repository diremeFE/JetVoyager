<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = [
        'airplane_id',
        'origin_airport_id',
        'destination_airport_id',
        'flight_date',
        'departure_time',
        'arrival_time',
        'total_duration',
        'stopovers_count',
        'stopover_cities',
        'base_price',
        'status',
        'flight_number',
    ];

    protected $casts = [
        'flight_date' => 'date',
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
        'total_duration' => 'interval',
        'stopover_cities' => 'array',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // Relación con la tabla 'airports' para el origen
    public function originAirport()
    {
        return $this->belongsTo(Airport::class, 'origin_airport_id');
    }

    // Relación con la tabla 'airports' para el destino
    public function destinationAirport()
    {
        return $this->belongsTo(Airport::class, 'destination_airport_id');
    }

    // Relación con los destinos populares (un vuelo tiene muchos destinos populares)
    public function popularDestinations()
    {
        return $this->hasMany(PopularDestination::class);
    }
}

