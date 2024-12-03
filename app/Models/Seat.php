<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    // Los campos que se pueden asignar masivamente
    protected $fillable = ['airplane_id', 'seat_number', 'seat_type', 'status'];

    // Relación con el avión (un avión tiene muchos asientos)
    public function airplane()
    {
        return $this->belongsTo(Airplane::class); // Un asiento pertenece a un avión
    }
}
