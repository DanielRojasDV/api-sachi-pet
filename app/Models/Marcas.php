<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'estado',        
    ];

    public function productos(){
        return $this->hasMany(Productos::class);
    }
}
