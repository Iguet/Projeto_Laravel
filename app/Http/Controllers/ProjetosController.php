<?php

namespace App\Http\Controllers;

use App\Projetos;
use App\User;
use App\UsersProjetos;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjetosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Projetos $projetos)
    {

        $this->authorize('viewAny', $projetos);

        $user = Auth::user();

        $id = $user->id;

        if ($user->hasAnyRole('Admin Projetos', 'Admin')) {

            $result = $projetos->all();
        } else {

            $result = DB::table('users_projetos')
                ->join('projetos', 'users_projetos.projetos_id', '=', 'projetos.id')
                ->select('projetos.*', 'users_projetos.*')
                ->where('users_projetos.users_id', '=', $id)
                ->get();
        }

        return view('projetos\index', [
            'projetos' => $result,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Projetos $projetos)
    {

        $this->authorize('create', $projetos);

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
    public function store(Request $request, UsersProjetos $usersProjetos, Projetos $projetos)
    {

        $this->authorize('create', $projetos);

        $validatedData = $request->validate([
            'name' => 'unique:projetos|max:50',
            'descricao' => 'required',
        ]);


        $usersProjetos = new UsersProjetos();

        $projetos->name = $request->nome;
        $projetos->descricao = $request->descricao;
        $projetos->save();

        $idProjeto = DB::table('projetos')->where('name', $request->nome)->value('id');

        if ($request->has('id')) {

            foreach ($request->id as $id) {

                DB::table('users_projetos')->insert(
                    ['users_id' => $id, 'projetos_id' => $idProjeto, 'created_at' => now(), 'updated_at' => now()]
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
    public function edit(Request $request, Projetos $projetos, User $users, $id)
    {

        $this->authorize('update', $projetos);

        $result = $projetos->find($id);

        $arraytem = [];
        $arraynaotem = [];


        $usersProjetos = DB::table('users')
            ->join('users_projetos', 'users.id', '=', 'users_projetos.users_id')
            ->select('users.id', 'users.name', 'users.email')
            ->where('projetos_id', '=', $id)
            ->get();

        $dados = $users->all();

        $id = DB::table('users')
            ->select('id')
            ->get();

        foreach ($dados as $usuarios) {

            $flag = false;

            foreach ($usersProjetos as $UP) {

                if ($usuarios->id == $UP->id) {

                    $arraytem[] = $usuarios;
                    $flag = true;

                    break;
                }
            }

            if ($flag == false) {

                $arraynaotem[] = $usuarios;
            }
        }


        return view('projetos\edita', [
            'projetos' => $result,
            'users' => $dados,
            'tem' => $arraytem,
            'naotem' => $arraynaotem,
            'id' => $id

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Projetos  $projetos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Projetos $projetos, UsersProjetos $usersProjetos, $id)
    {

        $this->authorize('update', $projetos);

        $validatedData = $request->validate([
            'name' => 'unique:projetos|max:50',
            'descricao' => 'required',
        ]);

        $usersProjetos = new UsersProjetos;

        $result = $projetos->find($id);

        $result->name = $request->nome;
        $result->descricao = $request->descricao;
        $result->save();

        if ($request->has('id')) {

            $consultaUsersProjetos = DB::table('users')
                ->select('users.id', 'name', 'email')
                ->join('users_projetos', 'users.id', 'users_projetos.users_id')
                ->where('users_projetos.projetos_id', '=', $id)
                ->get();


            if ($consultaUsersProjetos != '') {

                DB::table('users_projetos')->where('projetos_id', '=', $id)->delete();

                foreach ($request->id as $consulta) {

                    DB::table('users_projetos')->Insert(
                        ['users_id' => $consulta, 'projetos_id' => $id, 'created_at' => now(), 'updated_at' => now()]
                    );
                }
            }
        } else {

            DB::table('users_projetos')->where('projetos_id', '=', $id)->delete();
        }

        return redirect()->route('listaProjetos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Projetos  $projetos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projetos $projetos, UsersProjetos $usersProjetos, $id)
    {

        $this->authorize('delete', $projetos);

        $consulta = DB::table('users_projetos')
            ->select('*')
            ->where('projetos_id', $id)
            ->get();

        // dd($consulta);

        $consultaDemanda = DB::table('demandas')
            ->select('*')
            ->where('projeto_id', $id)
            ->get();


        if ($consultaDemanda->isNotEmpty()) {
            // dd($consultaDemanda);

            DB::table('demandas')
                ->where('projeto_id', $id)
                ->delete();
        }

        if ($consulta->isNotEmpty()) {

            DB::table('users_projetos')
                ->where('projetos_id', $id)
                ->delete();
            $projetos->find($id)->delete();
        } else {

            $projetos->find($id)->delete();
        }

        return redirect()->route('listaProjetos');
    }
}
