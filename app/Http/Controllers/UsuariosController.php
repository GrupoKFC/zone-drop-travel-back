<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Exception;

class UsuariosController extends Controller
{

    public function login(Request $request)
    {
        try {

            $usuario =   Usuarios::select(
                'usuarios.id',
                'usuarios.nombres',
                'usuarios.apellidos',
            )
                ->join('historial_accesos', 'historial_accesos.usuario_id', 'usuarios.id')
                ->where('historial_accesos.nick', $request->user)
                ->where('historial_accesos.pass', $request->pass)
                ->where('historial_accesos.estado',  1)
                ->first();

            if ($usuario->id) {
            }

            return response()->json(["acceso" => true, "usuario" =>  $usuario, "Message" => "Acceso Correcto"], 200);
        } catch (Exception $e) {
            return response()->json(["acceso" => false, "usuario" => [], "Message" => "Credenciales incorrectas"], 401);
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
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function show(Usuarios $usuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuarios $usuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuarios $usuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuarios $usuarios)
    {
        //
    }
}
