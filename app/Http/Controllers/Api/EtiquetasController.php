<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EtiquetaModel;

class EtiquetasController extends Controller
{
    public function getAll(Request $request)
    {
        $etiquetas = EtiquetaModel::all();
        return response()->json($etiquetas, 200);
    }

    public function getOne(Request $request, $tagid)
    {
        $etiqueta = EtiquetaModel::find($tagid);
        //$etiqueta = EtiquetaModel::where('id', $tagid)->first();
        return response()->json($etiqueta, 200);
    }
    public function delete(Request $request, $tagid)
    {
        $etiqueta = EtiquetaModel::find($tagid);
        $etiqueta->delete();
        return response()->json([], 202);
    }

    public function update(Request $request, $tagid)
    {
        $etiqueta = EtiquetaModel::find($tagid);
        $etiqueta->nombre = $request->get('nombre');
        $etiqueta->save();
        return response()->json($etiqueta, 202);
    }

    public function save(Request $request)
    {
        // var_dump('hola');
        // $etiqueta = EtiquetaModel::create(['nombre' => $request->get('nombre')]);
        $etiqueta = new EtiquetaModel();
        $etiqueta->nombre = $request->get('nombre');
        $etiqueta->save();
        return response()->json($etiqueta, 201);
    }
}
