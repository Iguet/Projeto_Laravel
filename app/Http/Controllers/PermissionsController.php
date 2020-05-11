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

        echo json_encode($dados);

    }

    public function update(Request $request, User $users)
    {
        
        $user = $users->find($request->user);

        $var = $user->getAllPermissions();

        
        foreach ($var as $key) {
            
            $user->revokePermissionTo($key->id);

        }

        foreach ($request->permissoes as $permissao){

            $user->givePermissionTo($permissao);

        }
        
        $user->syncRoles($request->role);

        return redirect()->route('home');

    }

}
