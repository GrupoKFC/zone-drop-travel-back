<?php

namespace App\Http\Controllers;

use App\Models\Abonos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class AbonosController extends Controller
{


    public function EliminarAbono($id)
    {
        try {
            DB::beginTransaction();
            $abono = Abonos::select("*")->where("id", "=", $id)->first();
            $abono->delete();
            DB::commit();
            return response()->json($abono, 200);
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
        return "ejeje";
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
            DB::beginTransaction();
            $abono = Abonos::create($request->all());
            DB::commit();
            return response()->json($abono, 201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Abonos  $abonos
     * @return \Illuminate\Http\Response
     */
    public function show(Abonos $abonos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Abonos  $abonos
     * @return \Illuminate\Http\Response
     */
    public function edit(Abonos $abonos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Abonos  $abonos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Abonos $abonos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Abonos  $abonos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Abonos $abonos)
    {
        //
    }
}
