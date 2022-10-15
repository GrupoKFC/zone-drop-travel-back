<?php

namespace App\Http\Controllers;

use App\Models\LugaresSalidas;
use Illuminate\Http\Request;

class LugaresSalidasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LugaresSalidas::all();
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
     * @param  \App\Models\LugaresSalidas  $lugaresSalidas
     * @return \Illuminate\Http\Response
     */
    public function show(LugaresSalidas $lugaresSalidas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LugaresSalidas  $lugaresSalidas
     * @return \Illuminate\Http\Response
     */
    public function edit(LugaresSalidas $lugaresSalidas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LugaresSalidas  $lugaresSalidas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LugaresSalidas $lugaresSalidas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LugaresSalidas  $lugaresSalidas
     * @return \Illuminate\Http\Response
     */
    public function destroy(LugaresSalidas $lugaresSalidas)
    {
        //
    }
}
