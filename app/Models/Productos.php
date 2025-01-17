<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'imagen',
        'categoria_id',
        'marca_id',
        'estado',        
    ];

    public function categoria(){
        return $this->belongsTo(Categorias::class);
    }

    public function marca(){
        return $this->belongsTo(Marcas::class);
    }
}
