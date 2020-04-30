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

        // $lista = DB::table('projetos')->select('id', 'name', 'descricao', 'created_at');

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
        
        // if($request->id){



        //     // $users = User::all();  
            
        //     $users = DB::table('users')->select('id', 'name', 'email');

        //     $id = implode($request->id);

        //     $projetos = DB::table('projetos')->where('id', $request->id)->first();

        //     $usersProjetos = DB::table('users')
        //         ->join('users_projetos', 'users.id', '=', 'users_projetos.users_id')
        //         ->select('id', 'name', 'email')
        //         ->where('users_projetos.projetos_id', '=', $request->id)
        //         ->union($users)
        //         ->get();

        //     dd($projetos, $usersProjetos, $users);
            
        //     return view('projetos\edita', [
        //         'projetos' => $projetos,
        //         'users' => $users,

        //     ]);

        // } else {

        //     $projetos = Projetos::all();

        //     echo "
        //         <script>
        //             alert('Selecione um projeto para editar');
        //         </script>
        //     ";

        //     return view('projetos\index', [
        //         'projetos' => $projetos
        //     ]);

        // }

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
