<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id', 'producto', 'cantidad', 'precio'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
