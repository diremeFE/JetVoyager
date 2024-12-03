<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinosPopulares extends Model
{
    use HasFactory;
    protected $table = 'destinos_populares';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'dia_disponible',
        'mes_disponible',
        'imagen'
    ];

    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = true; 
}

