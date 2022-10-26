<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoriaModel;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{

    public function getAll(Request $request)
    {
        $categorias = CategoriaModel::all();
        return response()->json($categorias, 200);
    }

    public function getOne(Request $request, $catid)
    {
        $categoria = CategoriaModel::find($catid);
        //$categoria = CategoriaModel::where('id', $catid)->first();
        return response()->json($categoria, 200);
    }
    public function delete(Request $request, $catid)
    {
        $categoria = CategoriaModel::find($catid);
        $categoria->delete();
        return response()->json([], 202);
    }

    public function update(Request $request, $catid)
    {
        $categoria = CategoriaModel::find($catid);
        $categoria->nombre = $request->get('nombre');
        $categoria->save();
        return response()->json($categoria, 202);
    }

    public function save(Request $request)
    {
        // var_dump('hola');
        $categoria = CategoriaModel::create(['nombre' => $request->get('nombre')]);
        return response()->json($categoria, 201);
    }
}
