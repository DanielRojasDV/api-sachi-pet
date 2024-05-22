<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\categoriaController;
use App\Http\Controllers\Api\marcaController;
use App\Http\Controllers\Api\productoController;
use App\Http\Controllers\Api\pedidosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//*** */ Metodos Categorias

Route::get('/categorias', [categoriaController::class, 'index']);

Route::get('/categorias/{id}', [categoriaController::class, 'show']);

Route::post('/categorias', [categoriaController::class, 'store']);

Route::put('/categorias/{id}', [categoriaController::class, 'update']);

Route::patch('/categorias/{id}', [categoriaController::class, 'updatePartial']);

Route::delete('/categorias/{id}', [categoriaController::class, 'destroy']);


//*** */ Metodos marcas

Route::get('/marcas', [marcaController::class, 'index']);

Route::get('/marcas/{id}', [marcaController::class, 'show']);

Route::post('/marcas', [marcaController::class, 'store']);

Route::put('/marcas/{id}', [marcaController::class, 'update']);

Route::delete('/marcas/{id}', [marcaController::class, 'destroy']);


//*** */ Metodos productos

Route::get('/productos', [productoController::class, 'index']);

Route::get('/productos/{id}', [productoController::class, 'show']);

Route::post('/productos', [productoController::class, 'store']);

Route::put('/productos/{id}', [productoController::class, 'update']);

Route::delete('/productos/{id}', [productoController::class, 'destroy']);


//*** */ Metodos productos

Route::get('/pedidos', [pedidosController::class, 'index']);

Route::get('/pedidos/{id}', [pedidosController::class, 'show']);

Route::post('/pedidos', [pedidosController::class, 'store']);


//*** */ Metodos autenticacion

Route::post('/registro', [AuthController::class, 'registro']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);