<?php

namespace App\Http\Controllers;

use App\Demandas;
use App\Projetos;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DemandasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Demandas $demandas)
    {

        // dd($this->autorize('view', $demandas))

        // Role::create(['name' => 'Admin Projetos']);
        // Role::create(['name' => 'Admin Demandas']);
        // Role::create(['name' => 'Admin']);
        // Role::create(['name' => 'User Padrao']);
        // Permission::create(['name' => 'Criar Projetos']);
        // Permission::create(['name' => 'Criar Demandas']);
        // Permission::create(['name' => 'Editar Projetos']);
        // Permission::create(['name' => 'Editar Demandas']);
        // Permission::create(['name' => 'Deletar Projetos']);
        // Permission::create(['name' => 'Deletar Demandas']);
        // Permission::create(['name' => 'Vizualizar Projetos']);
        // Permission::create(['name' => 'Vizualizar Demandas']);

        // $role = Role::findById(2);

        // $permission = array();

        // $permission = Permission::all();
        // $permission[] = Permission::findById(4);
        // $permission[] = Permission::findById(7);
        // $permission[] = Permission::findById(8);
        // $permission[] = Permission::findById(2);
        // $permission = Permission::findById(1);

        // $role->givePermissionTo($permission);


        $id = Auth::user()->id;

        $dados = DB::table('projetos')
                    ->join('demandas', 'demandas.projeto_id', '=', 'projetos.id')
                    ->join('users', 'users.id', '=', 'demandas.user_id')
                    ->select('projetos.name as nomeProjeto', 'projetos.id as idProjeto', 'users.name', 'demandas.id', 'demandas.titulo', 'demandas.descricao', 'demandas.estado', 'demandas.created_at')
                    ->where('demandas.user_id', '=', $id)
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
        $users = User::all();
       
        return view('demandas\cadastro', [
            'projetos' => $projetos,
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
        // dd($request)

        $validatedData = $request->validate([
            'Titulo' => ['unique:demandas', 'max:50'],
            'Descricao' => ['required'],
            'Projeto' => ['required', 'numeric'],
            'User' => ['required', 'numeric'],
        ]);

        // dd($validatedData);

        $demandas = new Demandas;
        $demandas->titulo = $request->Titulo;
        $demandas->descricao = $request->Descricao;
        $demandas->projeto_id = $request->Projeto;
        $demandas->user_id = $request->User;
        $demandas->save();

        return redirect()->route('listaDemandas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Demandas  $demandas
     * @return \Illuminate\Http\Response
     */
    public function show(Demandas $demandas, Request $request)
    {

        $idProjeto = $request->idProjeto;

        $result = array();

        $result['id'] = DB::table('users_projetos')
            ->join('users', 'users_projetos.users_id', '=', 'users.id')
            ->select('users.id')
            ->where('users_projetos.projetos_id', '=', $idProjeto)
            ->get();

        $result['name'] = DB::table('users_projetos')
            ->join('users', 'users_projetos.users_id', '=', 'users.id')
            ->select('users.name')
            ->where('users_projetos.projetos_id', '=', $idProjeto)
            ->get();

        echo json_encode($result);   

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Demandas  $demandas
     * @return \Illuminate\Http\Response
     */
    public function edit(Demandas $demandas, Request $request, $id, $idProjeto)
    {

        $projetos = Projetos::all();

        $demandas = DB::table('demandas')
            ->select()
            ->where('id', $id)
            ->first();

        $projetoDemandas = DB::table('projetos')
            ->join('demandas', 'demandas.projeto_id', '=', 'projetos.id')
            ->select('name', 'projetos.id')
            ->where('demandas.id', '=', $id)
            ->first();

        $userDemandas = DB::table('users')
            ->join('demandas', 'demandas.user_id', '=', 'users.id')
            ->select('name', 'users.id')
            ->where('demandas.id', '=', $id)
            ->first();

        $usersProjetos = DB::table('users')
                ->join('users_projetos', 'users.id', '=', 'users_projetos.users_id')
                ->select('users.id', 'users.name', 'users.email')
                ->where('projetos_id', '=', $idProjeto)
                ->get();

        return view('demandas\edita', [
            'projetos' => $projetos,
            'projetoDemandas' => $projetoDemandas,
            'usersProjetos' => $usersProjetos,
            'userDemandas' => $userDemandas,
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

        // dd($request);

        $dados = $demandas->find($id);
        $dados->titulo = $request->titulo;
        $dados->descricao = $request->descricao;
        $dados->estado = $request->estado;
        $dados->projeto_id = $request->Projeto;
        $dados->user_id = $request->User;
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
