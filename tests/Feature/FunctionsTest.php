<?php

namespace Tests\Feature;

use App\Demandas;
use App\Projetos;
use App\User;
use App\UsersProjetos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class FunctionsTest extends TestCase
{

    use RefreshDatabase;

    public function user()
    {

        $user = factory(User::class)->create();

        return $user;

    }

    public function demanda()
    {

        return [
            'id' => 1,
            'titulo' => 'teste',
            'descricao' => 'teste',
            'projeto_id' => $this->projeto()['id'],
            'user_id' => $this->user()->id,
            'estado' => 'nova'
        ];

    }

    public function projeto()
    {

        return [
            'id' => 1,
            'name' => 'teste',
            'descricao' => 'descricao teste',
        ];

    }

    public function userProjeto()
    {

        return [
            'users_id' => $this->user()->id,
            'projetos_id' => $this->projeto()['id'],

        ];

    }

    public function createDemanda()
    {

        return Demandas::create($this->demanda());

    }

    public function createProjeto()
    {

        return Projetos::create($this->projeto());

    }

    public function createUserProjeto()
    {

        return UsersProjetos::create($this->userProjeto());

    }

    public function permissionsAdminDemandas()
    {

        Permission::create(['name' => 'Criar Demandas']);
        Permission::create(['name' => 'Editar Demandas']);
        Permission::create(['name' => 'Deletar Demandas']);
        Permission::create(['name' => 'Vizualizar Demandas']);

        return Permission::all();

    }

    public function permissionsAdminProjetos()
    {

        Permission::create(['name' => 'Criar Projetos']);
        Permission::create(['name' => 'Editar Projetos']);
        Permission::create(['name' => 'Deletar Projetos']);
        Permission::create(['name' => 'Vizualizar Projetos']);

        return Permission::all();

    }

    public function permissionsUserPadrao()
    {

        Permission::create(['name' => 'Vizualizar Demandas']);
        Permission::create(['name' => 'Vizualizar Projetos']);

        return Permission::all();

    }

    public function userPadrao()
    {

        return $this->user()->givePermissionTo($this->permissionsUserPadrao());

    }

    public function adminDemandas()
    {

        return $this->user()->givePermissionTo($this->permissionsAdminDemandas());

    }

    public function adminProjetos()
    {

        return $this->user()->givePermissionTo($this->permissionsAdminProjetos());

    }

}
