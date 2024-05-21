<?php

use App\Http\Controllers\Api\categoriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//*** */ Metodos Categorias

Route::get('/categorias', [categoriaController::class, 'index']);

Route::get('/categorias/{id}', [categoriaController::class, 'show']);

Route::post('/categorias', [categoriaController::class, 'store']);

Route::put('/categories/{id}', [categoriaController::class, 'update']);

Route::patch('/categorias/{id}', [categoriaController::class, 'updatePartial']);

Route::delete('/categorias/{id}', [categoriaController::class, 'destroy']);




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
