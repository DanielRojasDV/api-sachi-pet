<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePedidoRequest;
use App\Models\DetallesPedidos;
use App\Models\Pedidos;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class pedidosController extends Controller
{   
    public function index(){
        $pedidos = Pedidos::all();

        $data = [
            'data' => $pedidos,
            'status' => 200,            
        ];

        return response()->json($data, 200);
    }

    public function show($id){
        $pedido = Pedidos::find($id);

        if(!$pedido){
            $data = [
               'message' => 'Pedido no encontrado',
                'code' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'data' => $pedido,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }

    public function destroy($id){
        $pedido = Pedidos::find($id);

        if(!$pedido){
            $data = [
               'message' => 'Pedido no encontrado',
                'code' => 404
            ];
            return response()->json($data, 404);
        }

        $pedido->delete();

        $data = [
           'message' => 'Pedido eliminado',
            'code' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id){
        $pedido = Pedidos::find($id);

        if(!$pedido){
            $data = [
               'message' => 'Pedido no encontrado',
                'code' => 404
            ];
            return response()->json($data, 404);
        }

        $pedido->update($request->all());

        $data = [
           'message' => 'Pedido actualizado',
            'code' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(StorePedidoRequest $request){
                
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            
            // Crear pedido
            $pedido = Pedidos::create([
                'total' => $request->total,
                'user_id' => $request->user_id,            
            ]);

            // Crear detalles del pedido
            foreach ($validated['productos'] as $productoData) {
                $producto = Productos::find($productoData['producto_id']);

                // Validar el stock disponible
                if ($producto->stock < $productoData['cantidad']) {
                    return response()->json(['error' => 'Stock insuficiente para el producto ID ' . $producto->id], 400);
                }

                // Crear detalle del pedido
                DetallesPedidos::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $productoData['cantidad'],
                    'subtotal' => $producto->precio * $productoData['cantidad']
                ]);

                // Reducir el stock del producto
                $producto->decrement('stock', $productoData['cantidad']);

                DB::commit();
            }

            $data = [
                'message' => 'Pedido y detalles creados correctamente',
                 'data' => $pedido,
                 'code' => 200
             ];
     
             return response()->json($data, 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Ocurrió un error al crear el pedido', 'details' => $th->getMessage()], 500);
        }



        
    }
}
