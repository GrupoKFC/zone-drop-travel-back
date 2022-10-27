<?php

namespace App\Http\Controllers;

use App\Models\TipoTransacciones;
use Illuminate\Http\Request;

class TipoTransaccionesController extends Controller
{
    public function listSelect()
    {
        return TipoTransacciones::all();
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
     * @param  \App\Models\TipoTransacciones  $tipoTransacciones
     * @return \Illuminate\Http\Response
     */
    public function show(TipoTransacciones $tipoTransacciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoTransacciones  $tipoTransacciones
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoTransacciones $tipoTransacciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoTransacciones  $tipoTransacciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoTransacciones $tipoTransacciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoTransacciones  $tipoTransacciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoTransacciones $tipoTransacciones)
    {
        //
    }
}
