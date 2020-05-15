<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Feature\FunctionsTest;

class ProjetosTest extends DuskTestCase
{

    use DatabaseMigrations;

    public function testCadastro()
    {

        $data = new FunctionsTest();

        $data->createUser();

        $data->adminProjetos();

        $user = User::find(1);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/projetos')
                ->click('@criar')
                ->value('@nome', 'teste')
                ->value('@descricao', 'teste')
                ->check('@user' ,'1')
                ->click('@novo')
                ->assertPathIs('/projetos');
        });
    }

    public function testUpdate()
    {

        $data = new FunctionsTest();

        $data->createUser();

        $data->adminProjetos();

        $data->createProjeto();

        $data->userProjeto();

        $user = User::find(1);

        $this->browse(function (Browser $browser) use ($user) {

            $browser->loginAs($user)
                ->visit('/projetos')
                ->click('@editar')
                ->assertPathIs('/projetos/1/editar');

        });

    }
}
