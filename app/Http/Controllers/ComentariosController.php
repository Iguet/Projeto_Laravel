<?php

namespace App\Http\Controllers;

use App\Comentarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComentariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $id = $request->id;

        $result['dados'] = DB::table('comentarios')
            ->join('demandas', 'demandas.id', '=', 'comentarios.demanda_id')
            ->join('users', 'users.id', '=', 'demandas.user_id')
            ->select('users.name', 'comentarios.comentario', 'comentarios.created_at')
            ->where('demanda_id', $id)
            ->get();

        echo json_encode($result);
        // return view('comentarios\index');
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Comentarios $comentarios)
    {

        $comentarios->comentario = $request->comentario;
        $comentarios->demanda_id = $request->idDemanda;
        $comentarios->save();

        // dd($result);

        $result['dados'] = DB::table('comentarios')
            ->join('demandas', 'demandas.id', '=', 'comentarios.demanda_id')
            ->join('users', 'users.id', '=', 'demandas.user_id')
            ->select('users.name', 'comentarios.comentario', 'comentarios.created_at')
            ->where('demanda_id', $request->idDemanda)
            ->latest()
            ->first();

        echo json_encode($result);

        // return redirect()->route('editaDemandas');


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Comentarios $comentarios
     * @return \Illuminate\Http\Response
     */
    public function show(Comentarios $comentarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Comentarios $comentarios
     * @return \Illuminate\Http\Response
     */
    public function edit(Comentarios $comentarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Comentarios $comentarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comentarios $comentarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Comentarios $comentarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comentarios $comentarios)
    {
        //
    }
}
