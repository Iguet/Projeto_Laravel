<?php

namespace Tests\Browser;

use App\Demandas;
use App\Projetos;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Spatie\Permission\Models\Permission;
use Tests\Browser\Pages\DemandasIndex;
use Tests\DuskTestCase;
use Tests\Feature\FunctionsTest;

class DemandasTest extends DuskTestCase
{

    use DatabaseMigrations;

    public function test_cadastro_demandas()
    {

        $data = new FunctionsTest();

        $data->createUser();

        $data->adminDemandas();

        $data->createProjeto();

        $data->createUserProjeto();

        $data->createDemanda();

        $this->browse(function ($first) {

            $first->loginAs(User::find(1))
                ->visit(new DemandasIndex())
                ->click('@cadastrar')
                ->select('@user', User::find(1)->id)
                ->value('@titulo', 'teste')
                ->value('@descricao', 'teste')
                ->assertPathIs('/demandas')

            ;
        });
    }

    public function test_edit_demandas()
    {

        $data = new FunctionsTest();

        $data->createUser();

        $admin = $data->adminDemandas();

        $projeto = $data->createProjeto();

        $demanda = $data->createDemanda();

        $this->browse(function ($first) {

            $first->loginAs(User::find(1))
                ->visit(new DemandasIndex())
                ->click('@editar')
                ->assertPathIs('demandas/1/1/editar');
        });

    }
}
