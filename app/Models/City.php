<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'country'];

    // Relación con los aeropuertos (una ciudad tiene muchos aeropuertos)
    public function airports()
    {
        return $this->hasMany(Airport::class);
    }
}
