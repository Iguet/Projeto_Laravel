<?php

namespace App\Http\Controllers;

use App\User;
use auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionsController extends Controller
{
    
    public function permissions(User $users)
    {
        
        $users_without_any_roles = User::doesntHave('roles')->get();
        
        if($users_without_any_roles){

            foreach ($users_without_any_roles as $key) {
                
                $key->givePermissionTo('Vizualizar Demandas', 'Vizualizar Projetos');
                $key->assignRole('User Padrao');
    
            }
        }


    }

    public function edit(User $users)
    {
        
        $data = $users->all();

        $all_roles_in_database = Role::all();

        // dd($all_roles_in_database);
        return view('permissions\index', [
            'roles' => $all_roles_in_database,
            'users' => $data
        ]);


    }

    public function showRoles(Request $request, User $users)
    {
        
        if ($request->has('user')){

            $user = $request->user;

            $data = $users->find($user);

            $dados['permissions'] = $data->getPermissionsViaRoles();
    
            $dados['roles'] = $data->getRoleNames();

        }

        if ($request->has('role')){

            $role = $request->role;

            $role = Role::findByName($role);

            $id = $role->id;

            $dados['permissionsRoles'] = DB::table('permissions')
                                            ->join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                                            ->select('permissions.name')
                                            ->where('role_has_permissions.role_id', '=', $id)
                                            ->get();
        }




       

        // echo json_encode($roles);

        echo json_encode($dados);

    }

    public function update(Request $request, User $users)
    {
        
        
        // $user->syncRoles($request->role);

        // $user = $request->user;
        $user = $users->find($request->user);

        $var = $user->getAllPermissions();

        
        foreach ($var as $key) {
            
            $user->revokePermissionTo($key->id);

        }

        // die('ADAFF');

        foreach ($request->permissoes as $permissao){

            $user->givePermissionTo($permissao);

        }
        
        $user->syncRoles($request->role);

        // die('auqi');

        return redirect()->route('home');

    }

}

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
