<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'code_iata', 
        'city_id',
    ];

    // Relación con la ciudad (una ciudad tiene muchos aeropuertos)
    public function city()
    {
        return $this->belongsTo(City::class);  // Suponiendo que tienes un modelo City
    }

    // Relación con los vuelos de salida (departures)
    public function departures()
    {
        return $this->hasMany(Flight::class, 'origin_airport_id');
    }

    // Relación con los vuelos de llegada (arrivals)
    public function arrivals()
    {
        return $this->hasMany(Flight::class, 'destination_airport_id');
    }

    public function flights()
{
    return $this->hasMany(Flight::class, 'origin_airport_id'); // Relación con vuelos de salida
}

public function flightsAsDestination()
{
    return $this->hasMany(Flight::class, 'destination_airport_id');
}
}
