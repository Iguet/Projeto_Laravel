<?php

namespace App\Http\Controllers;

use App\Projetos;
use App\User;
use App\UsersProjetos;
use Yajra\DataTables\Services\DataTable;
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

        $lista = DB::table('projetos')->select('id', 'name', 'descricao', 'created_at');

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
        
        $users = User::all();


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Projetos  $projetos
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
        if($request->id){



            $users = User::all();    

            $id = implode($request->id);

            $projetos = DB::table('projetos')->where('id', $request->id)->first();


            $usersComProjetoss = DB::table('users')
                ->select('users.id')
                ->join('users_projetos', 'users.id', 'users_projetos.users_id')
                // ->leftJoin('projetos', 'users_projetos.projetos_id', 'projetos.id')
                ->where('users_projetos.projetos_id', '=', $request->id)
                ->get();

            // $usersComProjetoss->toArray();

            $usersComProjetos = DB::table('users')
                ->select('users.id', 'name', 'email')
                ->join('users_projetos', 'users.id', 'users_projetos.users_id')
                // ->leftJoin('projetos', 'users_projetos.projetos_id', 'projetos.id')
                ->where('users_projetos.projetos_id', '=', $request->id);
                // ->get();

            $usersProjetos = DB::table('users')
                ->distinct('id')
                ->select('id', 'name', 'email')
                ->join('users_projetos', 'users.id', 'users_projetos.users_id')
                // ->leftJoin('projetos', 'users_projetos.projetos_id', 'projetos.id')
                ->where('users_projetos.projetos_id', '<>', $request->id)
                ->union($usersComProjetos)
                ->get();

            // $final = DB::table('users')
            //     ->select('id', 'name', 'email')
            //     ->join('users_projetos', 'users.id', 'users_projetos.users_id')
            //     ->where('users_projetos.users_id', '<>', $usersComProjetos->id)
            //     ->get();

                // SELECT DISTINCT id, name, email FROM users AS U JOIN users_projetos AS UP ON U.id = UP.users_id WHERE UP.projetos_id <> 1 AND UP.users_id <> 2 UNION SELECT DISTINCT id, name, email FROM users AS U JOIN users_projetos AS UP ON U.id = UP.users_id WHERE UP.projetos_id = 1


                dd($usersComProjetoss->toJson());

            return view('projetos\edita', [
                'projetos' => $projetos,
                'users' => $users,
                // 'usersProjetos' => $usersProjetos,
                'usersProjetos' => $usersProjetos
            ]);

        } else {

            echo "
                <script>
                    alert('Selecione um projeto para editar');
                </script>
            ";

        }

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

        DB::table('projetos')->where('id', $request->idProjetos)->update([
            'name' => $request->nome,
            'descricao' => $request->descricao,
            'updated_at' => now()
        ]);

        $consultaProjeto = $request->idProjetos;

        if($request->id){

            $consultaUsersProjetos = DB::table('users')
            ->select('users.id', 'name', 'email')
            ->join('users_projetos', 'users.id', 'users_projetos.users_id')
            // ->leftJoin('projetos', 'users_projetos.projetos_id', 'projetos.id')
            ->where('users_projetos.projetos_id', '=', $request->id)
            ->get();

            
            if($consultaUsersProjetos > 0){

                DB::table('users_projetos')->where('projetos_id', '=', $consultaProjeto)->delete();
                
                foreach ($request->id as $consulta){
                    
                    DB::table('users_projetos')->Insert(
                        [ 'users_id' => $consulta, 'projetos_id' => $request->idProjetos, 'created_at' => now(), 'updated_at' => now() ]
                    );

                }
                    
            } else {

                foreach ($request->id as $consulta){
                    
                    DB::table('users_projetos')->Insert(
                        [ 'users_id' => $consulta, 'projetos_id' => $request->idProjetos, 'created_at' => now(), 'updated_at' => now() ]
                    );

                }
            }

        }

        // dd($consultaUsersProjetos);

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
