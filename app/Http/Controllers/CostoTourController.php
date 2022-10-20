<?php

namespace App\Http\Controllers;

use App\Models\CostoTour;
use Illuminate\Http\Request;
use Exception;

class CostoTourController extends Controller
{


    public function obtenerPrecios($idProgramacionFecha)
    {
        try {
            $CostoTour = CostoTour::select(
                'costo_tours.id',
                'costo_tours.programacion_fecha_id',
                'costo_tours.tipo_acompanante_id',
                'tipo_acompanantes.descripcion',
                'costo_tours.aplicapago',
                'costo_tours.precio',
                'costo_tours.estado',
            )
                ->join('tipo_acompanantes', 'tipo_acompanantes.id', 'costo_tours.tipo_acompanante_id')
                ->where('costo_tours.programacion_fecha_id', $idProgramacionFecha)->get();

            return  $CostoTour;
        } catch (Exception $e) {
            return response()->json(["errorMessage" => $e->getMessage()], 400);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CostoTour  $costoTour
     * @return \Illuminate\Http\Response
     */
    public function show(CostoTour $costoTour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CostoTour  $costoTour
     * @return \Illuminate\Http\Response
     */
    public function edit(CostoTour $costoTour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CostoTour  $costoTour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CostoTour $costoTour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CostoTour  $costoTour
     * @return \Illuminate\Http\Response
     */
    public function destroy(CostoTour $costoTour)
    {
        //
    }
}
