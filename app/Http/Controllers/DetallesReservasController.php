<?php

namespace App\Http\Controllers;

use App\Models\DetallesReservas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class DetallesReservasController extends Controller
{

    public function EliminarDetalle($id)
    {
        try {
            DB::beginTransaction();
            $detalleReserva = DetallesReservas::select("*")->where("id", "=", $id)->first();
            $detalleReserva->delete();
            DB::commit();
            return response()->json($detalleReserva, 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(["Message" => "Error al eliminar"], 400);
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
     * @param  \App\Models\DetallesReservas  $detallesReservas
     * @return \Illuminate\Http\Response
     */
    public function show(DetallesReservas $detallesReservas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetallesReservas  $detallesReservas
     * @return \Illuminate\Http\Response
     */
    public function edit(DetallesReservas $detallesReservas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetallesReservas  $detallesReservas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetallesReservas $detallesReservas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetallesReservas  $detallesReservas
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetallesReservas $detallesReservas)
    {
        //
    }
}
