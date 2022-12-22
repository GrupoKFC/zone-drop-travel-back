<?php

namespace App\Http\Controllers;

use App\Models\Abonos;
use App\Models\Acompaniantes;
use App\Models\Clientes;
use App\Models\CostoTour;
use App\Models\DetallesReservas;
use App\Models\Habitaciones;
use App\Models\HabitacionReservas;
use Illuminate\Support\Facades\DB;
use App\Models\Reservas;
use Illuminate\Http\Request;
use Exception;

class ReservasController extends Controller
{

    public function editarReserva($reserva_id, Request $request)
    {

        try {


            $data = $request->json()->all();
            $cliente =  $data["cliente"];
            $acompaniantesRequest =  $data["acompaniantes"];
            $informacionPagos =  $data["informacionPagos"];
            $lugarSalida_id =  $data["lugarSalida"];
            $habitacionesNombres =  $data["habitaciones"];
            $habitcionesEliminadas =  $data["habitcionesEliminadas"];
            $acompañantesEliminados =  $data["acompañantesEliminados"];


            $listHabitaciones = [];
            $listAcompaniantes = [];
            $listHabitacionesDelete = [];



            // 1 Cliente
            $dbo_cliente =  Clientes::where("id", "=",  $cliente["id"])->first();
            $dbo_cliente->fill($cliente);
            if ($dbo_cliente->isDirty()) {
                // Actualizar Cliente en caso de existir cambios en sus campos.
                $dbo_cliente->fill($cliente)->save();
            }


            $valorClienteTitular  = $cliente["tipoCliente"]["precio"];

            $valorAcompañantes = 0;
            foreach ($acompaniantesRequest as $acompa) {
                $valorAcompañantes += $acompa["tipoAcompañante"]["precio"];
            }



            foreach ($acompaniantesRequest as $acompa) {
                if (!$acompa["existente"]) {
                    $newAcompaniante = Clientes::create(
                        [
                            'documento' =>  $acompa["documento"],
                            'nombres' => $acompa["nombres"],
                            'tipoDocumento' => 'cedula',
                            'apellidos' => $acompa["apellidos"],
                            'fechaNacimiento' => $acompa["fechaNacimiento"],
                            'correo' =>  $acompa["correo"],
                            'direccion' => $acompa["direccion"],
                            'genero' => $acompa["genero"],
                            'telefono1' => $acompa["telefono1"],
                            'telefono2' => $acompa["telefono2"],
                            'observaciones' => $acompa["observaciones"],
                            'estado' =>  true
                        ]
                    );
                    $newAcompaniante->añadirAlDetalle = $acompa["añadirAlDetalle"];
                    $newAcompaniante["tipoAcompañante"] = $acompa["tipoAcompañante"];
                    array_push($listAcompaniantes, $newAcompaniante);
                } else {
                    // Actualizar Datos del Acompañante.
                    $dbo_acompañante =  Clientes::where("id", "=",  $acompa["id"])->first();
                    $dbo_acompañante->fill($acompa);
                    if ($dbo_acompañante->isDirty()) {
                        $dbo_acompañante->fill($acompa)->save();
                    }
                    $dbo_acompañante["tipoAcompañante"] = $acompa["tipoAcompañante"];
                    $dbo_acompañante->añadirAlDetalle = $acompa["añadirAlDetalle"];
                    array_push($listAcompaniantes, $dbo_acompañante);
                }
            }


            $listaDetallesReservas = [];
            foreach ($listAcompaniantes as $acompañante) {

                if ($acompañante["añadirAlDetalle"]) {
                    $detalleReserva = DetallesReservas::create([
                        'reserva_id' => $reserva_id,
                        'costo_tour_id' => $acompañante["tipoAcompañante"]["id"],
                        'cliente_id' => $acompañante["id"],
                        'precioDefault' =>  $acompañante["tipoAcompañante"]["aplicapago"],
                        'precio' => $acompañante["tipoAcompañante"]["precio"],
                        'observaciones' => "",
                        'estado' =>  true,
                        'tipo_cliente' => 'Acompañante'
                    ]);
                    array_push($listaDetallesReservas, $detalleReserva);
                }
                //
            }


            //   Reserva
            $dbo_reserva =  Reservas::where("id", "=",   $reserva_id)->first();
            $dbo_reserva->cliente_id =   $dbo_cliente["id"];
            $dbo_reserva->esAgencia =  $informacionPagos["esAgencia"];
            $dbo_reserva->comisionAgencia =  $informacionPagos["descuentoAgencia"];
            $dbo_reserva->descuento =  $informacionPagos["descuento"];
            $dbo_reserva->costoAdicional =  $informacionPagos["costoAdicional"];
            $dbo_reserva->costoAdicionalMotivo =  $informacionPagos["costoAdicionalMotivo"];
            $dbo_reserva->observaciones =  $informacionPagos["observaciones"];
            $dbo_reserva->lugar_salida_tours_id =  $lugarSalida_id;
            $dbo_reserva->total =   ($valorAcompañantes  +   $valorClienteTitular);


            if ($dbo_reserva->isDirty()) {
                $dbo_reserva->save();
            }

            foreach ($habitacionesNombres as $habitacion) {
                if (!isset($habitacion["existente"])) {
                    $habitacion1 = Habitaciones::where('descripcion', $habitacion["tipo"])->first();
                    $habitacion1->cantidad =  $habitacion["cantidad"];
                    array_push($listHabitaciones, $habitacion1);
                }
            }
            foreach ($listHabitaciones as $hab) {
                $HabitacionReserva = HabitacionReservas::create([
                    'habitacion_id' => $hab["id"],
                    'reserva_id' =>  $reserva_id,
                    'cantidad' =>  $hab["cantidad"],
                    'observaciones' => "",
                    'estado' => true
                ]);
            }

            // Eliminar acompañante / Detalle reserva.
            foreach ($acompañantesEliminados as $acomp) {
                $detalleReserva = DetallesReservas::where([
                    ['reserva_id', '=',   $reserva_id],
                    ['tipo_cliente', '=',   "Acompañante"],
                    ['cliente_id', '=',    $acomp["id"]]
                ])->first();
                $detalleReserva->delete();
            }

            // Eliminar las habitaciones.
            foreach ($habitcionesEliminadas as $habitacion) {
                $dbo_habitacion = Habitaciones::where('descripcion', $habitacion["tipo"])->first();
                array_push($listHabitacionesDelete, $dbo_habitacion);
            }
            foreach ($listHabitacionesDelete as $hab) {
                $habitacionReserva = HabitacionReservas::where([
                    ['reserva_id', '=',   $reserva_id],
                    ['habitacion_id', '=',  $hab["id"]]
                ])->first();
                $habitacionReserva->delete();
            }
            // Fin Eliminar Habitaciones






            DB::commit();
            return response()->json(["sussesMessage" => "Reserva Actualizada"], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(["errorMessage" => $e->getMessage()], 209);
        }
    }
    public function obtenerPrecios($reserva_id)
    {
        $response = [];
        $Reserva = Reservas::find($reserva_id);


        $totalAbonos = 0;
        foreach ($Reserva->Abonos as $abono) {
            $totalAbonos +=  $abono["valor"];
        }

        $response = [
            "esAgencia" =>    $Reserva["esAgencia"],
            "comisionAgencia" =>    $Reserva["comisionAgencia"],
            "descuento" =>    $Reserva["descuento"],
            "costoAdicional" =>    $Reserva["costoAdicional"],
            "costoAdicionalMotivo" =>    $Reserva["costoAdicionalMotivo"],
            "observaciones" =>    $Reserva["observaciones"],
            "totalAbonos" =>  $totalAbonos,
            "abonos" =>      $Reserva->Abonos,
        ];



        return   $response;
    }
    public function obtenerLugarSalida($reserva_id)
    {

        $response = [];

        $Reserva = Reservas::find($reserva_id);

        $Reserva->LugarSalidaTour->LugarSalida;


        $response = [
            "lugar_salida_tours_id" => $Reserva->LugarSalidaTour["id"],
            "lugar_salida_id" =>  $Reserva->LugarSalidaTour->LugarSalida["id"],
            "hora" => $Reserva->LugarSalidaTour["hora"],
            "descripcion" => $Reserva->LugarSalidaTour->LugarSalida["descripcion"]
        ];


        return  $response;
    }
    public function obtenerHabitaciones($reserva_id)
    {

        $response = [];

        $Reserva = Reservas::find($reserva_id);

        $Reserva->HabitacionesReservas;


        foreach ($Reserva->HabitacionesReservas as $habitacionesres) {
            $habitacionesres->Habitacion;

            array_push($response,  [
                "tipo" => $habitacionesres->Habitacion["descripcion"],
                "cantidad" =>   $habitacionesres["cantidad"],
                "existente" => true
            ]);
        }




        return  $response;
    }
    public function obtenerAcompañante($reserva_id)
    {
        $Reserva = Reservas::find($reserva_id);

        $datos = [];

        foreach ($Reserva->DetallesReservas as $detalle) {
            $detalle->CostoTour->TipoAcompañante;
            $detalle->Cliente;


            $costoTour = CostoTour::select(
                'costo_tours.id',
                'costo_tours.programacion_fecha_id',
                'costo_tours.tipo_acompanante_id',
                'tipo_acompanantes.descripcion',
                'costo_tours.aplicapago',
                'costo_tours.precio',
                'costo_tours.estado',

                // 'clientes.nombres',
                // 'clientes.apellidos',
                // 'tipo_acompanantes.descripcion as categoria'
            )
                ->join('tipo_acompanantes', 'tipo_acompanantes.id', 'costo_tours.tipo_acompanante_id')
                ->where('costo_tours.id',  $detalle["costo_tour_id"])
                ->first();

            $detalle->Cliente->existente = true;
            $detalle->Cliente->añadirAlDetalle = false;
            $detalle->Cliente->tipoAcompañante = $costoTour;
            //   $detalle->Cliente->tipoAcompañante = $detalle->CostoTour->TipoAcompañante;
            if ($detalle["tipo_cliente"] != "Titular") {
                array_push($datos,  $detalle->Cliente);
            }
        }




        // array_push($datos, $habitacion1);


        return      $datos;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "resrevas";
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
            $cliente =  $data["cliente"];
            $acompaniantesRequest =  $data["acompaniantes"];
            $informacionPagos =  $data["informacionPagos"];
            $banco =  $data["banco"];

            $lugarSalida_id =  $data["lugarSalida"];
            $programacion_fecha_id =  $data["programacion_fecha_id"];
            $habitacionesNombres =  $data["habitaciones"];
            $listHabitaciones = [];
            $listAcompaniantes = [];



            DB::beginTransaction();


            if (!$cliente["existente"]) {

                $tipoCliente = $data["cliente"]["tipoCliente"]; // Costo_tour
                $cliente = Clientes::create($data["cliente"]);
                $cliente->tipoCliente = $tipoCliente;
            }



            $valorClienteTitular  = $cliente["tipoCliente"]["precio"];
            $valorAcompañantes = 0;

            foreach ($acompaniantesRequest as $acompa) {
                $valorAcompañantes += $acompa["tipoAcompañante"]["precio"];
            }

            foreach ($habitacionesNombres as $habitacion) {
                $habitacion1 = Habitaciones::where('descripcion', $habitacion["tipo"])->first();
                $habitacion1->cantidad =  $habitacion["cantidad"];
                array_push($listHabitaciones, $habitacion1);
            }




            foreach ($acompaniantesRequest as $acompa) {
                if (!$acompa["existente"]) {
                    $newAcompaniante = Clientes::create(
                        [
                            'documento' =>  $acompa["documento"],
                            'nombres' => $acompa["nombres"],
                            'tipoDocumento' => 'cedula',
                            'apellidos' => $acompa["apellidos"],
                            'fechaNacimiento' => $acompa["fechaNacimiento"],
                            'correo' =>  $acompa["correo"],
                            'direccion' => $acompa["direccion"],
                            'genero' => $acompa["genero"],
                            'telefono1' => $acompa["telefono1"],
                            'telefono2' => $acompa["telefono2"],
                            'observaciones' => $acompa["observaciones"],
                            'estado' =>  true
                        ]
                    );
                    $newAcompaniante["tipoAcompañante"] = $acompa["tipoAcompañante"];
                    array_push($listAcompaniantes, $newAcompaniante);
                } else {
                    array_push($listAcompaniantes, $acompa);
                }
            }



            $reserva = Reservas::create([
                'cliente_id'  =>  $cliente["id"],
                'usuario_id' => 1,
                'programacion_fecha_id' =>  $programacion_fecha_id,
                'lugar_salida_tours_id' => $lugarSalida_id,
                'total' =>  $valorClienteTitular +  $valorAcompañantes,
                'esAgencia' =>  $informacionPagos["esAgencia"],
                'comisionAgencia' =>  $informacionPagos["descuentoAgencia"],
                'descuento' => $informacionPagos["descuento"],
                'costoAdicional' => $informacionPagos["costoAdicional"],
                'costoAdicionalMotivo' => $informacionPagos["costoAdicionalMotivo"],
                'observaciones' => $informacionPagos["observaciones"],
                'estado' =>  true
            ]);

            $toReturn =   ["sussesMessage" => "Tour Registrado Correctamente",  "reserva" => $reserva];



            $detalleReservaTitular = DetallesReservas::create([
                'reserva_id' =>  $reserva["id"],
                'costo_tour_id' => $cliente["tipoCliente"]["id"],
                'cliente_id' => $cliente["id"],
                'precioDefault' =>  $cliente["tipoCliente"]["aplicapago"],
                'precio' => $cliente["tipoCliente"]["precio"],
                'observaciones' =>  $cliente["observaciones"],
                'estado' =>  true,
                'tipo_cliente' => 'Titular'
            ]);



            $listaDetallesReservas = [];
            foreach ($listAcompaniantes as $acompañante) {


                $detalleReserva = DetallesReservas::create([
                    'reserva_id' =>  $reserva["id"],
                    'costo_tour_id' => $acompañante["tipoAcompañante"]["id"],
                    'cliente_id' => $acompañante["id"],
                    'precioDefault' =>  $acompañante["tipoAcompañante"]["aplicapago"],
                    'precio' => $acompañante["tipoAcompañante"]["precio"],
                    'observaciones' => "",
                    'estado' =>  true,
                    'tipo_cliente' => 'Acompañante'
                ]);

                array_push($listaDetallesReservas, $detalleReserva);
            }


            foreach ($listHabitaciones as $hab) {
                $HabitacionReserva = HabitacionReservas::create([
                    'habitacion_id' => $hab["id"],
                    'reserva_id' => $reserva["id"],
                    'cantidad' =>  $hab["cantidad"],
                    'observaciones' => "",
                    'estado' => true
                ]);
            }





            if ($informacionPagos["abono"] > 0) {
                $abono = Abonos::create([
                    'reserva_id' => $reserva["id"],
                    'banco_id' => (isset($banco["id"]) != "") ?  $banco["id"] :  1,
                    'tipo_transaccion_id' => (isset($informacionPagos["tipoTransaccion"]["id"]) != "") ?  $informacionPagos["tipoTransaccion"]["id"] :  1,
                    'valor'  => $informacionPagos["abono"],
                    'fecha' => $informacionPagos["fechaDeposito"],
                    'observacion' =>  $informacionPagos["observaciones"],
                    'numerodeposito' =>  $informacionPagos["numeroDeposito"],
                    'estado' => true
                ]);
            }



            DB::commit();
            return response()->json($toReturn, 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(["errorMessage" => $e->getMessage()], 209);
        }

        return  $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function show(Reservas $reservas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservas $reservas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservas $reservas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservas $reservas)
    {
        //
    }
}
