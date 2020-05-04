<?php

namespace App\Http\Controllers;

use App\Projetos;
use App\User;
use App\UsersProjetos;
use DataTables;
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

        // $user = Auth::user();

        // $id = $user->id;

        $path = base_path();


        // $lista = DB::table('projetos')->select('id', 'name', 'descricao', 'created_at');

        return view('projetos\index', [
            'projetos' => $projetos,
            
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
        
        // $validatedData = $request->validate([
        //     'title' => 'required|unique:posts|max:255',
        //     'body' => 'required',
        // ]);

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
        
        // $users = User::all();

        // die('asaadas');

        // dd($array);
        
        $users = DB::table('users')
        ->select();

        return dataTables::of($users)->make(true);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Projetos  $projetos
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Projetos $projetos, User $users, $id)
    {
            
            $result = $projetos->find($id);

            $array = [];

            // $path = base_path();

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
                    
                    if($usuarios->id == $UP->id){
                        
                        $array[] = 1;
                        $flag = true;

                        break;

                    }

                }
                
                if($flag == false){

                    $array[] = 0;

                }

            }
            
            // dd($array);
            
            return view('projetos\edita', [
                'projetos' => $result,
                'users' => $dados,
                'array' => $array,
                'id' => $id

            ]);



            // return $array;


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
    public function destroy(Projetos $projetos, UsersProjetos $usersProjetos, $id)
    {

        // $usersProjetos->select($id)
        //     ->where('projetos_id')
        //     ->delete();

        DB::table('users_projetos')
            ->where('projetos_id', $id)
            ->delete();
        
        $projetos->find($id)->delete();

        return redirect()->route('listaProjetos');

    }
}
