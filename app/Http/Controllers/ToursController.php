<?php

namespace App\Http\Controllers;

use App\Models\CostoTour;
use App\Models\LugaresSalidas;
use App\Models\LugarSalidaTour;
use App\Models\ProgramacionFechas;
use Illuminate\Support\Facades\DB;
use App\Models\Tours;
use Exception;
use Illuminate\Http\Request;

class ToursController extends Controller
{
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
                $NewlugarSaluda = null;
                if ($lugar["new"] == true) {
                    $NewlugarSaluda =   LugaresSalidas::create([
                        "descripcion" => $lugar["descripcion"],
                        "estado" => true
                    ]);
                } else {
                    $NewlugarSaluda = $lugar;
                }
                LugarSalidaTour::create([
                    "lugar_salida_id" => $NewlugarSaluda["id"],
                    "tour_id" =>  $tour->id,
                    "hora" => $lugar["hora"],
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
        //
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
        //
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
        )->get()
            ->map(function ($tou) {

                $tou->incluye = preg_replace("/[\r\n|\n|\r]+/",  "<br />", $tou->incluye);
                $tou->noIncluye = preg_replace("/[\r\n|\n|\r]+/",  "<br />", $tou->noIncluye);
                $tou->informacionAdicional = preg_replace("/[\r\n|\n|\r]+/",  "<br />", $tou->informacionAdicional);

                return $tou;
            });;

        foreach ($tours as $tour) {
            $lugarSalidaTour = LugarSalidaTour::select(
                'lugar_salida_tours.id',
                'lugares_salidas.id as lugares_salidas_id ',
                'lugares_salidas.descripcion',
                'lugar_salida_tours.hora',
                'lugar_salida_tours.estado'
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
}
