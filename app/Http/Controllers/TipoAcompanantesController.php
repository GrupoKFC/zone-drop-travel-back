<?php

namespace App\Http\Controllers;


use App\Models\TipoAcompanantes;
use Illuminate\Http\Request;

class TipoAcompanantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return TipoAcompanantes::all();
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
     * @param  \App\Models\TipoAcompanantes  $tipoAcompanantes
     * @return \Illuminate\Http\Response
     */
    public function show(TipoAcompanantes $tipoAcompanantes)
    {
        return ["dato" => "ok"];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoAcompanantes  $tipoAcompanantes
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoAcompanantes $tipoAcompanantes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoAcompanantes  $tipoAcompanantes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoAcompanantes $tipoAcompanantes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoAcompanantes  $tipoAcompanantes
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoAcompanantes $tipoAcompanantes)
    {
        //
    }
}
