<?php

use App\Http\Controllers\LugaresSalidasController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\TipoAcompanantesController;
use App\Http\Controllers\ToursController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/servicios/listado/{limit}',  [ServiciosController::class, 'listado']);
Route::resource('tipoacompanante', TipoAcompanantesController::class);
Route::resource('lugaressalidas', LugaresSalidasController::class);


Route::resource('tour', ToursController::class);
Route::get('/tour/listado/tabla/',  [ToursController::class, 'listado']);
