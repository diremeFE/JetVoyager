<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airplane extends Model
{
    use HasFactory;

    // Define los campos que son asignables en masa
    protected $fillable = [
        'name',
        'num_rows',
        'seats_per_row',
        'total_seats',
    ];

    // Relación con los vuelos
    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
