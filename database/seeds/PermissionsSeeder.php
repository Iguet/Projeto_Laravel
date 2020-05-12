<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Permission::create(['name' => 'Criar Projetos']);
        Permission::create(['name' => 'Criar Demandas']);
        Permission::create(['name' => 'Editar Projetos']);
        Permission::create(['name' => 'Editar Demandas']);
        Permission::create(['name' => 'Deletar Projetos']);
        Permission::create(['name' => 'Deletar Demandas']);
        Permission::create(['name' => 'Vizualizar Projetos']);
        Permission::create(['name' => 'Vizualizar Demandas']);

        $Admin = Role::findById(1);
        $AdminProjetos = Role::findById(2);
        $AdminDemandas = Role::findById(3);
        $UserPadrao = Role::findById(4);
        
        $permissionAdmin = array();
        $permissionAdminProjetos = array();
        $permissionAdminDemandas = array();
        $permissionUserPadrao = array();
        
        $permissionAdmin[] = Permission::all();
        
        $permissionAdminProjetos[] = Permission::findById(1);
        $permissionAdminProjetos[] = Permission::findById(3);
        $permissionAdminProjetos[] = Permission::findById(5);
        $permissionAdminProjetos[] = Permission::findById(7);
        $permissionAdminProjetos[] = Permission::findById(8);
        
        $permissionAdminDemandas[] = Permission::findById(2);
        $permissionAdminDemandas[] = Permission::findById(4);
        $permissionAdminDemandas[] = Permission::findById(6);
        $permissionAdminDemandas[] = Permission::findById(7);
        $permissionAdminDemandas[] = Permission::findById(8);
        
        $permissionUserPadrao[] = Permission::findById(7);
        $permissionUserPadrao[] = Permission::findById(8);
        
        $Admin->givePermissionTo($permissionAdmin);
        $AdminProjetos->givePermissionTo($permissionAdminProjetos);
        $AdminDemandas->givePermissionTo($permissionAdminDemandas);
        $UserPadrao->givePermissionTo($permissionUserPadrao);
        

    }
}
