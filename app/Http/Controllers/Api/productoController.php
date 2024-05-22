<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class productoController extends Controller
{
    public function index(){
        $productos = Productos::all();

        $data = [
            'data' => $productos,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }

    public function show($id){
        $producto = Productos::find($id);

        if(!$producto){
            $data = [
               'message' => 'Producto no encontrado',
                'code' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'data' => $producto,
           'status' => 200,
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request){
        $validacion = Validator::make($request->all(), [
            'nombre' =>'required|string|max:80',
            'descripcion' =>'required|string',
            'precio' =>'required|integer',
            'stock' =>'required|integer',
            'imagen' => 'string',
            'categoria_id' =>'required|integer',
            'marca_id' =>'required|integer',
        ]);

        if($validacion->fails()){
            $data = [
               'message' => $validacion->errors(),
                'code' => 400
            ];
            return response()->json($data, 400);
        }

        $producto = Productos::create($request->all());

        $data = [
            'data' => $producto,
            'message' => 'Producto creado correctamente',
           'status' => 200,
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id){
        $producto = Productos::find($id);

        if(!$producto){
            $data = [
               'message' => 'Producto no encontrado',
                'code' => 404
            ];
            return response()->json($data, 404);
        }

        $validacion = Validator::make($request->all(), [
            'nombre' =>'required|string|max:80',
            'descripcion' =>'required|string',
            'precio' =>'required|integer',
            'stock' =>'required|integer',
            'imagen' => 'string',
            'categoria_id' =>'required|integer',
            'marca_id' =>'required|integer',
        ]);

        if($validacion->fails()){
            $data = [
               'message' => $validacion->errors(),
                'code' => 400
            ];
            return response()->json($data, 400);
        }

        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'imagen' => $request->imagen,
            'categoria_id' => $request->categoria_id,
            'marca_id' => $request->marca_id,
        ]);

        $data = [
            'data' => $producto,
            'message' => 'Marca actualizada correctamente',
            'status' => 200,
        ];

        return response()->json($data, 200);
    }


    public function updatePartial(Request $request, $id){
        $producto = Productos::find($id);

        if(!$producto){
            $data = [
               'message' => 'Producto no encontrado',
                'code' => 404
            ];
            return response()->json($data, 404);
        }

        $validacion = Validator::make($request->all(), [
            'nombre' =>'string|max:80',
            'descripcion' =>'string',
            'precio' =>'integer',
            'stock' =>'integer',
            'imagen' => 'string',
            'categoria_id' =>'integer',
            'marca_id' =>'integer',
        ]);

        if($validacion->fails()){
            $data = [
               'message' => $validacion->errors(),
                'code' => 400
            ];
            return response()->json($data, 400);
        }

        if($request->has('nombre')){
            $producto->nombre = $request->nombre;
        }

        if($request->has('descripcion')){
            $producto->descripcion = $request->descripcion;
        }

        if($request->has('precio')){
            $producto->precio = $request->precio;
        }

        if($request->has('stock')){
            $producto->stock = $request->stock;
        }
        
        if($request->has('imagen')){
            $producto->imagen = $request->imagen;
        }

        if($request->has('categoria_id')){
            $producto->categoria_id = $request->categoria_id;
        }

        if($request->has('marca_id')){
            $producto->marca_id = $request->marca_id;
        }

        $producto->save();

        $data = [
            'data' => $producto,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }

    public function destroy($id){
        $producto = Productos::find($id);

        if(!$producto){
            $data = [
               'message' => 'Producto no encontrado',
                'code' => 404
            ];
            return response()->json($data, 404);
        }

        $producto->delete();

        $data = [
            'data' => $producto,
           'status' => 200,
        ];

        return response()->json($data, 200);
    }


}
