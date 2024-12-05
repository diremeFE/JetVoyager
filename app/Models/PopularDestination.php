<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopularDestination extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'descripcion',
    ];

    // Relación con la ciudad
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    
}
