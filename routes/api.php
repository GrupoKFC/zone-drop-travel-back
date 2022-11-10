<?php

use App\Http\Controllers\AbonosController;
use App\Http\Controllers\AcompaniantesController;
use App\Http\Controllers\BancosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\CostoTourController;
use App\Http\Controllers\DetallesReservasController;
use App\Http\Controllers\HabitacionesController;
use App\Http\Controllers\LugaresSalidasController;
use App\Http\Controllers\LugarSalidaTourController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\TipoAcompanantesController;
use App\Http\Controllers\TipoTransaccionesController;
use App\Http\Controllers\ToursController;
use App\Models\TipoTransacciones;
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

Route::get('/lugar-salida-tour/obtener/{tour_id}',  [LugarSalidaTourController::class, 'obtenerLugarSalidaTour']);


Route::resource('tour', ToursController::class);
Route::get('/tour/listado/tabla/',  [ToursController::class, 'listado']);
Route::post('/tour/eliminar/{id}',  [ToursController::class, 'eliminar']);

Route::resource('cliente', ClientesController::class);
Route::get('/cliente/find/{idCliente}',  [ClientesController::class, 'find']);
Route::get('/acompaniante/find/{documento}',  [AcompaniantesController::class, 'find']);

Route::get('costo-tour/obtener-precios/{idProgramacionFecha}', [CostoTourController::class, 'obtenerPrecios']);


// Route::resource('habitacion/{idProgramacionFecha}', [HabitacionesController::class, 'obtenerPrecios']);
Route::resource('habitacion', HabitacionesController::class);



Route::resource('bancos', BancosController::class);

Route::resource('reserva', ReservasController::class);


Route::resource('abono', AbonosController::class);
Route::post('/abono/eliminar/{id}',  [AbonosController::class, 'EliminarAbono']);

Route::post('/detalle-reserva/eliminar/{id}',  [DetallesReservasController::class, 'EliminarDetalle']);




Route::get('/reporte/titulares/{programacionFechaId}',  [ReportesController::class, 'listaTitularesTour']);

Route::get('/reserva/listado/titulares/{programacionFechaId}',  [ReportesController::class, 'listaReservaTitularesTour']);




Route::get('/reporte/mensual/{programacionFechaId}',  [ReportesController::class, 'reporteMensual']);




Route::get('/tipo-transacciones/list-select',  [TipoTransaccionesController::class, 'listSelect']);
