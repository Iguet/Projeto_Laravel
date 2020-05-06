<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

}
