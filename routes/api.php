<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/products', function (){
    return 'Listado de Productos';
});

Route::get('/products/{id}', function (){
    return 'Ver Producto';
});

Route::post('/products', function (){
    return 'Creando Producto';
});

Route::put('/products/{id}', function (){
    return 'Actualizar Product';
});

Route::delete('/products/{id}', function (){
    return 'Eliminar Product';
});
