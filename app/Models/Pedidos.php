<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'user_id',
        'estado',
        'fecha_entrega',        
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
