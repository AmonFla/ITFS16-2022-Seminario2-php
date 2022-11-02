<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoriaModel;
use App\Models\EntradaModel;
use App\Models\EtiquetaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntradasController extends Controller
{
    public function getAll(Request $request)
    {
        $entrada = EntradaModel::with(['categorias', 'etiquetas', 'user'])
            ->get();
        return response()->json($entrada, 200);
    }

    public function getOne(Request $request, $id)
    {
        $entrada = EntradaModel::where(['id' => $id])
            ->with(['categorias', 'etiquetas', 'user'])
            ->get();
        return response()->json($entrada, 200);
    }

    public function delete(Request $request, $id)
    {


        $entrada = EntradaModel::where(['id' => $id, 'user_id' => Auth::user()->id])->first();
        if (isset($entrada->id)) {
            $entrada->etiquetas()->detach();
            $entrada->delete();
        } else {
            return response()->json(['error' => 'no posee los permisos'], 401);
        }
        return response()->json([], 202);
    }

    public function update(Request $request, $id)
    {

        $input  = $request->all();

        if (isset($input['categoria']['id'])) {
            $categoria = CategoriaModel::find($input['categoria']['id']);
        } else {
            $categoria = CategoriaModel::create(['nombre' => $input['categoria']['nombre']]);
        }

        $entrada = EntradaModel::find($id);
        $entrada->titulo = $input['titulo'];
        $entrada->contenido = $input['contenido'];
        $entrada->fecha_pub = $input['fechaPub'];
        $entrada->categoria_id = $categoria->id;

        $entrada->etiquetas()->detach();

        foreach ($input['tags'] as $tag) {
            if (isset($tag['id'])) {
                $etiqueta = EtiquetaModel::find($tag['id']);
            } else {
                $etiqueta = EtiquetaModel::create(['nombre' => $tag['nombre']]);
            }
            $entrada->etiquetas()->attach($etiqueta);
        }
        $entrada->save();

        return response()->json($entrada, 202);
    }


    public function save(Request $request)
    {
        // var_dump('hola');
        $input = $request->all();

        if (isset($input['categoria']['id'])) {
            $categoria = CategoriaModel::find($input['categoria']['id']);
        } else {
            $categoria = CategoriaModel::create(['nombre' => $input['categoria']['nombre']]);
        }


        $entrada = EntradaModel::create(
            [
                'titulo' => $input['titulo'],
                'contenido' => $input['contenido'],
                'fecha_pub' => $input['fechaPub'],
                'user_id' => Auth::user()->id,
                'categoria_id' => $categoria->id
            ]
        );

        foreach ($input['tags'] as $tag) {
            if (isset($tag['id'])) {
                $etiqueta = EtiquetaModel::find($tag['id']);
            } else {
                $etiqueta = EtiquetaModel::create(['nombre' => $tag['nombre']]);
            }
            $entrada->etiquetas()->attach($etiqueta);
        }
        $entrada->save();

        $entrada = EntradaModel::where(['id' => $entrada->id])
            ->with(['categorias', 'etiquetas', 'user'])
            ->get();

        return response()->json($entrada, 201);
    }
}
