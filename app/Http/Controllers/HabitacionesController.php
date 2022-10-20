<?php

namespace App\Http\Controllers;

use App\Models\Habitaciones;
use Illuminate\Http\Request;
use Exception;

class HabitacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            return  Habitaciones::all();
        } catch (Exception $e) {
            return response()->json(["errorMessage" => $e->getMessage()], 400);
        }
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
     * @param  \App\Models\Habitaciones  $habitaciones
     * @return \Illuminate\Http\Response
     */
    public function show(Habitaciones $habitaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Habitaciones  $habitaciones
     * @return \Illuminate\Http\Response
     */
    public function edit(Habitaciones $habitaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Habitaciones  $habitaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Habitaciones $habitaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Habitaciones  $habitaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Habitaciones $habitaciones)
    {
        //
    }
}
