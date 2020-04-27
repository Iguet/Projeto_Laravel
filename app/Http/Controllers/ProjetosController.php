<?php

namespace App\Http\Controllers;

use App\Projetos;
use App\User;
use App\UsersProjetos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjetosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $projetos = Projetos::all();
       
        return view('projetos\index', [
            'projetos' => $projetos
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $users = User::all();
        
        return view('projetos\cadastro', [
            'users' => $users
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
        
        $projetos = new Projetos();
        $usersProjetos = new UsersProjetos();

        $projetos->name = $request->nome;
        $projetos->descricao = $request->descricao;
        $projetos->save();
        
        $idProjeto = DB::table('projetos')->where('name', $request->nome)->value('id');

        if($idProjeto){
            
            foreach ($request->id as $id) {

                DB::table('users_projetos')->insert(
                    [ 'users_id' => $id, 'projetos_id' => $idProjeto, 'created_at' => now(), 'updated_at' => now() ]
                );

            }

        }

        return redirect()->route('listaProjetos');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Projetos  $projetos
     * @return \Illuminate\Http\Response
     */
    public function show(Projetos $projetos)
    {

       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Projetos  $projetos
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
        // dd($request);

        $users = User::all();
        $usersProjetos = UsersProjetos::all();
        $projetos = new Projetos;
        

        $projetos = DB::table('projetos')->where('id', $request->id)->first();
        
        // dd($projetos);

        return view('projetos\edita', [
            'projetos' => $projetos,
            'users' => $users,
            'usersProjetos' => $usersProjetos
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Projetos  $projetos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Projetos $projetos)
    {

        
        $usersProjetos = new UsersProjetos;

        // DB::table('projetos')->where('id', $request->idProjetos)->update([
        //     'name' => $request->nome,
        //     'descricao' => $request->descricao,
        //     'updated_at' => now()
        // ]);
        
        // $dados = DB::table('projetos')
        // ->join('demandas', 'demandas.projeto_id', '=', 'projetos.id')
        // ->select('projetos.name', 'demandas.id', 'demandas.titulo', 'demandas.descricao', 'demandas.estado', 'demandas.created_at')->get();

        // dd($request);

        // $usersProjetos = DB::table('users_projetos')->join('users', function ($join) {
        //     $join->on('users.id', '=', 'users_projetos.users_id')
        //          ->where('users_projetos.projetos_id', '=', $request->id);
        // })->get();

        // $consulta = $request->id;

        foreach ($request->id as $consulta){

            $usersProjetos = DB::select('SELECT id, name, email FROM users AS U INNER JOIN users_projetos AS UP ON U.id = UP.users_id WHERE UP.projetos_id = ?', [$consulta]);
        }
        

        // DB::select('select * from users where active = ?', [1])

        dd($usersProjetos);

        // SELECT id_Usuario, nome_Usuario, email FROM usuario AS U INNER JOIN usuario_has_projeto AS UP ON U.id_Usuario = UP.usuario_id_Usuario WHERE UP.projeto_id_Projeto = '{$id}'"

        if($request->id > 0){

            foreach($request->id as $id){

                DB::table('users_projetos')->where('users_id', $usersProjetos->users_id)->delete();

                DB::table('users_projetos')->updateOrInsert([
                    'users_id' => $id,
                    'projetos_id' => $request->idProjetos,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

            }

        }

        return redirect()->route('listaProjetos');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Projetos  $projetos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projetos $projetos)
    {
        //
    }
}
