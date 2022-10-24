<?php

namespace App\Http\Controllers;

use App\Models\Acompaniantes;
use App\Models\Clientes;
use App\Models\DetallesReservas;
use App\Models\Habitaciones;
use Illuminate\Support\Facades\DB;
use App\Models\Reservas;
use Illuminate\Http\Request;
use Exception;

class ReservasController extends Controller
{
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
            $toReturn =  ["sussesMessage" => "Tour Registrado Correctamente"];
            $data = $request->json()->all();
            $cliente =  $data["cliente"];
            $acompaniantesRequest =  $data["acompaniantes"];
            $informacionPagos =  $data["informacionPagos"];
            $bancoId =  $data["bancoId"];

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
                $habitacion = Habitaciones::where('descripcion', $habitacion)->first();
                array_push($listHabitaciones, $habitacion);
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
                'observaciones' => $informacionPagos["observaciones"],
                'estado' =>  true
            ]);


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
