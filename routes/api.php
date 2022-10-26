<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [\App\Http\Controllers\Api\LoginController::class, 'login']);
Route::post('register', [\App\Http\Controllers\Api\LoginController::class, 'register']);

Route::controller(\App\Http\Controllers\Api\CategoriasController::class)->group(function () {
    Route::prefix('categorias')->group(function () {
        Route::get('/', 'getAll');
        Route::get('/{catid}', 'getOne');
        Route::delete('/{catid}', 'delete');
        Route::put('/{catid}', 'update');
        Route::post('/', 'save');
    });
});

Route::prefix('etiquetas')->group(function () {
    Route::get('/', [\App\Http\Controllers\Api\EtiquetasController::class, 'getAll']);
    Route::get('/{tagid}', [\App\Http\Controllers\Api\EtiquetasController::class, 'getOne']);
    Route::delete('/{tagid}', [\App\Http\Controllers\Api\EtiquetasController::class, 'delete']);
    Route::put('/{tagid}', [\App\Http\Controllers\Api\EtiquetasController::class, 'update']);
    Route::post('/', [\App\Http\Controllers\Api\EtiquetasController::class, 'save']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
