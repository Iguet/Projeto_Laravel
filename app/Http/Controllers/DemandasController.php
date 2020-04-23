<?php

namespace App\Http\Controllers;

use App\Demandas;
use App\Projetos;
use Illuminate\Http\Request;

class DemandasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('demandas\index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projetos = Projetos::all();
        
       
        return view('demandas\cadastro', [
            'projetos' => $projetos
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // dd($request);
        $demandas = new Demandas;
        $demandas->titulo = $request->Titulo;
        $demandas->descricao = $request->Descricao;
        $demandas->projeto_id = $request->Projeto;
        $demandas->save();

        return redirect()->route('listaDemandas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Demandas  $demandas
     * @return \Illuminate\Http\Response
     */
    public function show(Demandas $demandas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Demandas  $demandas
     * @return \Illuminate\Http\Response
     */
    public function edit(Demandas $demandas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Demandas  $demandas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demandas $demandas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Demandas  $demandas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demandas $demandas)
    {
        //
    }
}
