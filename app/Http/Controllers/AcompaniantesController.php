<?php

namespace App\Http\Controllers;

use App\Models\Acompaniantes;
use Illuminate\Http\Request;
use Exception;

class AcompaniantesController extends Controller
{

    public function find($documento)
    {
        try {

            $acompaniante = Acompaniantes::where('documento', $documento)->first();
            if ($acompaniante)
                return response()->json($acompaniante, 200);
            else
                return response()->json([], 201);
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
     * @param  \App\Models\Acompaniantes  $acompaniantes
     * @return \Illuminate\Http\Response
     */
    public function show(Acompaniantes $acompaniantes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Acompaniantes  $acompaniantes
     * @return \Illuminate\Http\Response
     */
    public function edit(Acompaniantes $acompaniantes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Acompaniantes  $acompaniantes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Acompaniantes $acompaniantes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acompaniantes  $acompaniantes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acompaniantes $acompaniantes)
    {
        //
    }
}
