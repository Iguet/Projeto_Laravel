<?php

namespace Tests\Browser;

use App\Demandas;
use App\Projetos;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Spatie\Permission\Models\Permission;
use Tests\DuskTestCase;
use Tests\Feature\FunctionsTest;

class DemandasTest extends DuskTestCase
{

    use DatabaseMigrations;

    public function test_cadastro_demandas()
    {

        $data = new FunctionsTest();

        $projeto = $data->createProjeto();

        $demanda = $data->createDemanda();

        $data->adminDemandas();

        $this->browse(function ($first) {

            $first->loginAs(User::find(2))
                ->visit('/demandas')
                ->click('@cadastrar')
                ->assertPathIs('/demandas/cadastrar')
                ->value('@projeto', Projetos::find(1))
                ->value('@user', User::find(2))
                ->value('@titulo', 'teste')
                ->value('@descricao', 'teste')
                ->click('@CriarDemanda');
        });
    }

    public function test_edit_demandas()
    {

        $data = new FunctionsTest();

        $projeto = $data->createProjeto();

        $admin = $data->adminDemandas();

        $demanda = $data->createDemanda();


        $this->browse(function ($first) use ($admin) {

            $first->loginAs($admin)
                ->visit('/demandas')
                ->click('@editar')
                ->assertPathIs('/demandas/1/1/editar');

        });

    }
}
