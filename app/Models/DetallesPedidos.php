<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesPedidos extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'pedido_id',
        'cantidad',
        'subtotal',        
    ];

    public function productos(){
        return $this->hasMany(Productos::class);
    }

    public function pedidos(){
        return $this->hasMany(Pedidos::class);
    }
}
