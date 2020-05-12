<?php

namespace App\Http\Controllers;

use App\Demandas;
use App\Http\Requests\DemandasRequest;
use App\Projetos;
use App\User;
use Auth;
use App\Notifications\NovaDemanda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Events\NotificationEvent;

class DemandasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Demandas $demandas)
    {

        $this->authorize('viewAny', $demandas);

        $id = Auth::user()->id;

        $user = Auth::user();

        // $notifications = $user->unreadNotifications;

        // dd($data);

        if ($user->hasAnyRole('Admin Demandas', 'Admin')){

            $dados = DB::table('projetos')
                        ->join('demandas', 'demandas.projeto_id', '=', 'projetos.id')
                        ->join('users', 'users.id', '=', 'demandas.user_id')
                        ->select('projetos.name as nomeProjeto', 'projetos.id as idProjeto', 'users.name', 'demandas.id', 'demandas.titulo', 'demandas.descricao', 'demandas.estado', 'demandas.created_at')
                        ->get();

        } else {

            $dados = DB::table('projetos')
                        ->join('demandas', 'demandas.projeto_id', '=', 'projetos.id')
                        ->join('users', 'users.id', '=', 'demandas.user_id')
                        ->select('projetos.name as nomeProjeto', 'projetos.id as idProjeto', 'users.name', 'demandas.id', 'demandas.titulo', 'demandas.descricao', 'demandas.estado', 'demandas.created_at')
                        ->where('demandas.user_id', '=', $id)
                        ->get();

        }

        return view('demandas\index', [
            'dados' => $dados,
        ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Demandas $demandas)
    {

        $this->authorize('create', $demandas);

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
    public function store(DemandasRequest $request, User $users, Demandas $demandas, NovaDemanda $notification)
    {


        $this->authorize('create', $demandas);

        $demandas = new Demandas;
        $demandas->titulo = $request->Titulo;
        $demandas->descricao = $request->Descricao;
        $demandas->projeto_id = $request->Projeto;
        $demandas->user_id = $request->User;
        $demandas->save();

        $user = $request->User;

        event(new NotificationEvent($user));

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

        $this->authorize('view', $demandas);

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
    public function update(DemandasRequest $request, Demandas $demandas, $id, User $users, NovaDemanda $notification)
    {

        $this->authorize('update', $demandas);

        $dados = $demandas->find($id);
        $dados->titulo = $request->Titulo;
        $dados->descricao = $request->Descricao;
        $dados->estado = $request->Estado;
        $dados->projeto_id = $request->Projeto;
        $dados->user_id = $request->User;
        $dados->save();

        $user = $request->User;

        event(new NotificationEvent($user));

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

        $this->authorize('delete', $demandas);

        $result = $demandas->find($id);

        $coment = DB::table('comentarios')
                    ->where('demanda_id', $id)
                    ->delete();

        $result->delete();
        return redirect()->route('listaDemandas');

    }
}
