<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Admin Projetos']);
        Role::create(['name' => 'Admin Demandas']);
        Role::create(['name' => 'User Padrao']);
        
    }
}
