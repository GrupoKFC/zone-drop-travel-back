<?php

namespace App\Http\Controllers;

use App\Models\Bancos;
use Illuminate\Http\Request;
use Exception;

class BancosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return  Bancos::all();
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
     * @param  \App\Models\Bancos  $bancos
     * @return \Illuminate\Http\Response
     */
    public function show(Bancos $bancos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bancos  $bancos
     * @return \Illuminate\Http\Response
     */
    public function edit(Bancos $bancos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bancos  $bancos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bancos $bancos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bancos  $bancos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bancos $bancos)
    {
        //
    }
}
