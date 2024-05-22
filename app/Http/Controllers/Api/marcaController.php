<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Marcas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class marcaController extends Controller
{
    public function index(){
        $marcas = Marcas::all();

        $data = [
            'data' => $marcas,
           'status' => 200,
        ];

        return response()->json($data, 200);
        
    }

    public function show($id){
        $marca = Marcas::find($id);

        if(!$marca){
            $data = [
                'data' => 'No se encontro la marca',
               'status' => 404,
            ];
            return response()->json($data, 404);
        }

        $data = [
            'data' => $marca,
           'status' => 200,
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request){
        
        $validacion = Validator::make($request->all(), [
            'nombre' =>'required|string|max:80',            
        ]);

        if($validacion->fails()){
            $data = [ 
                'message' => 'Error en la validación de los datos',
                'errors' => $validacion->errors(),
                'code' => 400
            ];

            return response()->json($data, 400);
        }
        
        $marca = Marcas::create([
            'nombre' => $request->nombre
        ]);

        if(!$marca){
            $data = [
                'message' => 'Error al crear la marca',
                'code' => 400
            ];
            return response()->json($data, 500);
        }

        $data = [
            'data' => $marca,
            'status' => 201,
        ];

        return response()->json($data, 201);
    }

    public function update(Request $request, $id){
        $marca = Marcas::find($id);

        if(!$marca){
            $data = [
                'data' => 'No se encontro la marca',
               'status' => 404,
            ];
            return response()->json($data, 404);
        }

        $validacion = Validator::create([
            'nombre' =>'required|string|max:80',            
        ]);

        if($validacion->fails()){
            $data = [ 
                'message' => 'Error en la validación de los datos',
                'errors' => $validacion->errors(),
                'code' => 400
            ];

            return response()->json($data, 400);
        }

        $marca->update([
            'nombre' => $request->nombre
        ]);

        $data = [
            'data' => $marca,
           'status' => 200,
        ];

        return response()->json($data, 200);

    }

    public function destroy($id){
        $marca = Marcas::find($id);

        if(!$marca){
            $data = [
               'message' => 'marca no encontrada',
                'code' => 404
            ];
            return response()->json($data, 404);
        }

        $marca->delete();

        $data = [
            'marca' => $marca,
           'message' => 'marca eliminada correctamente',
            'code' => 200
        ];

        return response()->json($data, 200);
    }

}
