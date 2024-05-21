<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class categoriaController extends Controller
{
    public function index()
    {
        $categorias = Categorias::all();
        return response()->json($categorias);
    }

    public function show($id)
    {
        $categoria = Categorias::find($id);

        if(!$categoria){
            $data = [
               'message' => 'Categoria no encontrada',
                'code' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'categoria' => $categoria,
            'code' => '200',
        ];

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'nombre' =>'required'            
        ]);
        
        if($validacion->fails()){
            $data = [ 
                'message' => 'Error en la validación de los datos',
                'errors' => $validacion->errors(),
                'code' => 400
            ];

            return response()->json($data, 400);
        }

        // $categoria = Categorias::create($request->all());

        $categoria = Categorias::create([
            'nombre' => $request->nombre
        ]);

        if(!$categoria){
            $data = [
                'message' => 'Error al crear la categoria',
                'code' => 400
            ];
            return response()->json($data, 500);
        }

        $data = [
            'categoria' => $categoria,
            'message' => 'Categoria creada correctamente',
            'code' => 201
        ];

        return response()->json($data, 201);


    }

    public function update(Request $request, $id)
    {
        $categoria = Categorias::find($id);

        if(!$categoria){
            $data = [
               'message' => 'Categoria no encontrada',
                'code' => 404
            ];
            return response()->json($data, 404);
        }

        $validacion = Validator::make($request->all(), [
            'nombre' =>'required'            
        ]);
        
        if($validacion->fails()){
            $data = [ 
               'message' => 'Error en la validación de los datos',
                'errors' => $validacion->errors(),
                'code' => 400
            ];

            return response()->json($data, 400);
        }

        // $categoria->update($request->all());

        $categoria->update([
            'nombre' => $request->nombre
        ]);

        $data = [
            'categoria' => $categoria,
           'message' => 'Categoria actualizada correctamente',
            'code' => 200
        ];
    }

    // lo que cambia es que se le quita el required a los campos en la validacion
    public function updatePartial(Request $request, $id)
    {
        $categoria = Categorias::find($id);

        if(!$categoria){
            $data = [
               'message' => 'Categoria no encontrada',
                'code' => 404
            ];
            return response()->json($data, 404);
        }

        
        $validacion = Validator::make($request->all(), [
            'nombre' =>'max:60'             
        ]);
        
        if($validacion->fails()){
            $data = [ 
               'message' => 'Error en la validación de los datos',
                'errors' => $validacion->errors(),
                'code' => 400
            ];

            return response()->json($data, 400);
        }

        // $categoria->update($request->all());

        if($request->has('nombre')){
            $categoria->nombre = $request->nombre;
        }

        $categoria->save();

        $data = [
            'categoria' => $categoria,
           'message' => 'Categoria actualizada correctamente',
            'code' => 200
        ];
    }

    public function destroy($id)
    {
        $categoria = Categorias::find($id);

        if(!$categoria){
            $data = [
               'message' => 'Categoria no encontrada',
                'code' => 404
            ];
            return response()->json($data, 404);
        }

        $categoria->delete();

        $data = [
            'categoria' => $categoria,
           'message' => 'Categoria eliminada correctamente',
            'code' => 200
        ];

        return response()->json($data, 200);
    }
}
