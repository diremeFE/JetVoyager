<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['flight_id', 'discount', 'start_date', 'end_date'];

    // Relación con Flight (un vuelo puede tener múltiples ofertas)
    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
}
