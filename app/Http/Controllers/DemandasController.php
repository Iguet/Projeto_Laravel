<?php

namespace App\Http\Controllers;

use App\Demandas;
use App\Projetos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemandasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Demandas $demandas)
    {

        $dados = DB::table('projetos')
                    ->join('demandas', 'demandas.projeto_id', '=', 'projetos.id')
                    ->select('projetos.name', 'demandas.id', 'demandas.titulo', 'demandas.descricao', 'demandas.estado', 'demandas.created_at')
                    ->get();

        

        return view('demandas\index', [
            'dados' => $dados
        ]);

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
    public function edit(Demandas $demandas, Request $request, $id)
    {

        // dd($request);

        $projetos = Projetos::all();

        $demandas = DB::table('demandas')
            ->select()
            ->where('id', $id)
            ->first();

            // dd($demandas);

        $projetoDemandas = DB::table('projetos')
            ->join('demandas', 'demandas.projeto_id', '=', 'projetos.id')
            ->select('name', 'projetos.id')
            ->where('demandas.id', '=', $id)
            ->first();



        // dd($projetoDemandas);

        return view('demandas\edita', [
            'projetos' => $projetos,
            'projetoDemandas' => $projetoDemandas,
            'demandas' => $demandas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Demandas  $demandas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demandas $demandas, $id)
    {

        $dados = $demandas->find($id);
        // dd($dados);
        $dados->titulo = $request->titulo;
        $dados->descricao = $request->descricao;
        $dados->estado = $request->estado;
        $dados->projeto_id = $request->Projeto;
        $dados->save();

        return redirect()->route('listaDemandas');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Demandas  $demandas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demandas $demandas, $id)
    {
        
        $result = $demandas->find($id);
        // dd($result);
        $result->delete();
        return redirect()->route('listaDemandas');

    }
}
