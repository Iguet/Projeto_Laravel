<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(User $users)
    {
        
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Admin Projetos']);
        Role::create(['name' => 'Admin Demandas']);
        Role::create(['name' => 'User Padrao']);
        
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
        
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
        ]);

        $user = $users->find(1);
        
        $user->givePermissionTo([
            'Criar Projetos',
            'Criar Demandas',
            'Editar Projetos',
            'Editar Demandas',
            'Deletar Projetos',
            'Deletar Demandas',
            'Vizualizar Projetos',
            'Vizualizar Demandas'
        ]);

        $user->assignRole('Admin');

    }
}
