<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(User $users)
    {

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
