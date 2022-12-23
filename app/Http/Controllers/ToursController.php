<?php

namespace App\Http\Controllers;

use App\Models\CostoTour;
use App\Models\LugaresSalidas;
use App\Models\LugarSalidaTour;
use App\Models\ProgramacionFechas;
use App\Models\Reservas;
use Illuminate\Support\Facades\DB;
use App\Models\Tours;
use Exception;
use Illuminate\Http\Request;

class ToursController extends Controller
{

    public function actualizarPrecioTour($programacionFechaId,  Request $request)
    {

        try {

            $exitenReserva = false;
            $cantidadReserva = 0;
            $reservas = Reservas::select("*")->where("programacion_fecha_id", "=", $programacionFechaId)->get();
            if (is_array($reservas) || is_object($reservas)) {
                foreach ($reservas as $reserv) {
                    $cantidadReserva++;
                    $exitenReserva = true;
                }
            }
            if ($exitenReserva) {
                return response()->json(["Message" => "En está fecha ya existen ($cantidadReserva) Reservas. NO se permite modificar los precios"], 209);
            }


            $data = $request->json()->all();
            $programacionFecha = ProgramacionFechas::select("*")->where("id", "=", $programacionFechaId)->first();


            $precios = $data["precios"];


            foreach ($precios as $precio) {

                if ($precio["type"] == "new") {
                    $costoTour =  CostoTour::create([
                        'programacion_fecha_id' =>  $programacionFecha->id,
                        "tipo_acompanante_id" => $precio["id"],
                        'aplicapago' => ($precio["valor"] == 0) ? false : true,
                        'precio' =>  $precio["valor"],
                        'estado' =>  1
                    ]);
                } else {
                    // En caso de actualizar.
                    $costo_tour = CostoTour::select("*")->where("id", "=", $precio["id"])->first();
                    $costo_tour->precio =  $precio["valor"];
                    $costo_tour->aplicapago =  ($precio["valor"] == 0) ? false : true;
                    $costo_tour->save();
                }
            }

            DB::commit();
            return response()->json(["Message" => "Datos Actualizados Correctamente"], 200);
        } catch (Exception $e) {

            DB::rollBack();
            return response()->json(["Message" => $e->getMessage()], 209);
        }
    }
    public function actualizarTour($idTour,  Request $request)
    {
        try {


            $tour = Tours::select("*")->where("id", "=", $idTour)->first();
            $data = $request->json()->all();

            $lugaresSalidas = $data["lugaresSalidas"];


            $tour->titulo = $data["titulo"];
            $tour->duracion = $data["duracion"];
            $tour->detalles = $data["detalles"];
            $tour->imagen = $data["imagen"];
            $tour->incluye = $data["incluye"];
            $tour->noIncluye = $data["noIncluye"];
            $tour->informacionAdicional = $data["informacionAdicional"];
            $tour->save();

            foreach ($lugaresSalidas as $lugar) {
                $NewlugarSalida = null;
                if ($lugar["new"] == true) {
                    $NewlugarSalida =   LugaresSalidas::create([
                        "descripcion" => $lugar["descripcion"],
                        "estado" => true
                    ]);
                } else {
                    $NewlugarSalida = $lugar;
                }
                LugarSalidaTour::create([
                    "lugar_salida_id" => $NewlugarSalida["id"],
                    "tour_id" =>  $tour->id,
                    "hora" => $lugar["hora"],
                    "siguienteDia" => $lugar["siguienteDia"],
                    "estado" => true
                ]);
            }

            // return  $tour;

            DB::commit();
            return response()->json(["Message" => "Datos Actualizados Correctamente"], 200);
        } catch (Exception $e) {

            DB::rollBack();
            return response()->json(["errorMessage" => $e->getMessage()], 209);
        }
    }
    public function añadirFecha($idTour,  Request $request)
    {
        try {
            $data = $request->json()->all();
            $programacionFechas = $data["fechas"];
            $precios = $data["precios"];

            foreach ($programacionFechas as $programacion) {
                $nuevaProgramacionFecha =  ProgramacionFechas::create(
                    [
                        'fecha' => $programacion["fecha"],
                        "observacion" =>  "",
                        'estado' => true,
                        'tour_id' =>  $idTour
                    ]
                );

                foreach ($precios as $precio) {
                    $costoTour =  CostoTour::create([
                        'programacion_fecha_id' =>  $nuevaProgramacionFecha->id,
                        "tipo_acompanante_id" => $precio["id"],
                        'aplicapago' => ($precio["valor"] == 0) ? false : true,
                        'precio' =>  $precio["valor"],
                        'estado' =>  1
                    ]);
                }
            }

            DB::commit();
            return response()->json(["Message" => "Fechas & Costos Guardados Correctamente"], 200);
        } catch (Exception $e) {

            DB::rollBack();
            return response()->json(["errorMessage" => $e->getMessage()], 209);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "OK";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $data = $request->json()->all();
            $toReturn = [];
            DB::beginTransaction();
            $programacionFechas = $data["programacionFechas"];
            $lugaresSalidas = $data["lugaresSalidas"];
            $tour =  Tours::create($request->json()->all());
            array_push($toReturn, $tour);


            foreach ($lugaresSalidas as $lugar) {
                $NewlugarSalida = null;
                if ($lugar["new"] == true) {
                    $NewlugarSalida =   LugaresSalidas::create([
                        "descripcion" => $lugar["descripcion"],
                        "estado" => true
                    ]);
                } else {
                    $NewlugarSalida = $lugar;
                }
                LugarSalidaTour::create([
                    "lugar_salida_id" => $NewlugarSalida["id"],
                    "tour_id" =>  $tour->id,
                    "hora" => $lugar["hora"],
                    "siguienteDia" => $lugar["siguienteDia"],
                    "estado" => true
                ]);
            }

            foreach ($programacionFechas as $programacion) {
                $nuevaProgramacionFecha =  ProgramacionFechas::create(
                    [
                        'fecha' => $programacion["fecha"],
                        "observacion" => $programacion["observacion"],
                        'estado' => true,
                        'tour_id' =>   $tour->id
                    ]
                );
                array_push($toReturn, $nuevaProgramacionFecha);

                $precios = $programacion["precios"];
                foreach ($precios as $precio) {
                    $costoTour =  CostoTour::create([
                        'programacion_fecha_id' =>  $nuevaProgramacionFecha->id,
                        "tipo_acompanante_id" => $precio["id"],
                        'aplicapago' => ($precio["valor"] == 0) ? false : true,
                        'precio' =>  $precio["valor"],
                        'estado' =>  1
                    ]);
                    array_push($toReturn, $costoTour);
                }
            }

            DB::commit();
            return response()->json($toReturn, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tours  $tours
     * @return \Illuminate\Http\Response
     */
    public function show(Tours $tours)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tours  $tours
     * @return \Illuminate\Http\Response
     */
    public function edit(Tours $tours)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tours  $tours
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tours $tours)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tours  $tours
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tours $tours)
    {
    }

    public function listado()
    {

        $reporte = [];
        $tours = Tours::select(
            'tours.id',
            'tours.titulo',
            'tours.duracion',
            'tours.detalles',
            'tours.imagen',
            'tours.incluye',
            'tours.noIncluye',
            'tours.informacionAdicional',
            'tours.estado',
        )
            ->orderBy('tours.titulo', 'asc')
            ->get()
            ->map(function ($tou) {

                $tou->incluye = preg_replace("/[\r\n|\n|\r]+/",  "<br />", $tou->incluye);
                $tou->noIncluye = preg_replace("/[\r\n|\n|\r]+/",  "<br />", $tou->noIncluye);
                $tou->informacionAdicional = preg_replace("/[\r\n|\n|\r]+/",  "<br />", $tou->informacionAdicional);

                return $tou;
            });

        foreach ($tours as $tour) {
            $lugarSalidaTour = LugarSalidaTour::select(
                'lugar_salida_tours.id',
                'lugares_salidas.id as lugares_salidas_id ',
                'lugares_salidas.descripcion',
                'lugar_salida_tours.hora',
                'lugar_salida_tours.estado',
                'lugar_salida_tours.siguienteDia'

            )
                ->join('lugares_salidas', 'lugares_salidas.id', 'lugar_salida_tours.lugar_salida_id')
                ->where('lugar_salida_tours.tour_id', $tour->id)->get();


            $programacionFechas = ProgramacionFechas::select(
                'programacion_fechas.id',
                'programacion_fechas.fecha',
                'programacion_fechas.observacion',
                'programacion_fechas.estado'
            )
                ->where('programacion_fechas.tour_id', $tour->id)->get();

            foreach ($programacionFechas as $programacion) {
                $costoTour = CostoTour::select(
                    'costo_tours.id',
                    'costo_tours.programacion_fecha_id',
                    'costo_tours.tipo_acompanante_id',
                    'tipo_acompanantes.descripcion',
                    'costo_tours.aplicapago',
                    'costo_tours.precio',
                    'costo_tours.estado'
                )
                    ->join('tipo_acompanantes', 'tipo_acompanantes.id', 'costo_tours.tipo_acompanante_id')
                    ->where('costo_tours.programacion_fecha_id', $programacion->id)->get();

                $programacion->precios  = $costoTour;
            }



            $tour->lugaresSalidas =  $lugarSalidaTour;
            $tour->programacionFechas =  $programacionFechas;
            array_push(
                $reporte,
                $tour
            );
        }




        return  $reporte;
    }

    public function eliminar($id)
    {
        try {
            $toReturn = [];
            $existenReservas = false;
            $tour = Tours::select("*")->where("id", "=", $id)->first();
            $programacionFechas =  $tour->programacionFechas;

            foreach ($programacionFechas as $fechas) {
                $reservas =  Reservas::where("programacion_fecha_id", "=",  $fechas["id"])->get();

                $cantidadReservas = 0;
                $fechasR = $fechas["fecha"];
                $tieneReservas = false;
                foreach ($reservas as $reserva) {

                    $cantidadReservas++;
                    $existenReservas = true;
                    $tieneReservas = true;
                }
                if ($tieneReservas) {
                    $response = [
                        "fechas" =>  $fechasR,
                        "cantidad"   => $cantidadReservas
                    ];
                    array_push($toReturn,  $response);
                }
            }


            $response = null;

            if (!$existenReservas) {
                $tour->delete();
                $response = ["existe_reserva" => $existenReservas, "reservas" =>  $toReturn, "Message" => "Tour Eliminado Correctamente"];
            } else {
                $response = ["existe_reserva" => $existenReservas, "reservas" =>  $toReturn, "Message" => "El Tour tiene registrado reservas. No se permite eliminar."];
            }

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json(["existe_reserva" => false, "reservas" => [], "Message" => "Error con el Tour proporcionado."], 400);
        }
    }
}
