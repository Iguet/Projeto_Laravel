<?php

namespace Tests\Feature;

use App\Demandas;
use App\Projetos;
use App\User;
use App\UsersProjetos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class DemandasTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();

        Projetos::create($this->projeto());

//        UsersProjetos::create($this->userProjeto());

    }

    public function test_only_logged_users_can_see_demandas()
    {

        $response = $this->get('/demandas');

        $response->assertRedirect('/login');

    }

    public function test_user_have_permission_to_see_demandas()
    {

        $response = $this->actingAs($this->userPadrao())
            ->get('/demandas')
            ->assertOk();

    }

    public function test_user_dont_have_permission_to_see_demandas()
    {

        $this->actingAs($this->user());

        $response = $this->get('/demandas')
            ->assertForbidden();

    }

    public function test_user_has_permission_to_see_the_form_to_create_demandas()
    {

        $response = $this->actingAs($this->adminDemandas())
            ->get('/demandas/cadastrar')
            ->assertOk();

    }

    public function test_user_dont_have_permission_to_see_the_form_to_create_demandas()
    {

        $response = $this->actingAs($this->user())
            ->get('/demandas/cadastrar')
            ->assertForbidden();

    }

    public function test_user_has_permission_to_create_demandas()
    {

        $response = $this->actingAs($this->adminDemandas())
            ->post('/demandas', $this->demanda());

        $this->assertCount(1, Demandas::all());

    }

    public function test_user_dont_have_permission_to_create_demandas()
    {

        $response = $this->actingAs($this->userPadrao())
            ->post('/demandas', $this->demanda())->assertForbidden();

    }

    public function test_user_has_permission_to_see_the_form_to_edit_demandas()
    {

        $this->withoutExceptionHandling();

//        Demandas::create($this->demanda());

        Demandas::create($this->demanda());

        $this->user();

//        dd(Demandas::all());

        $response = $this->actingAs($this->adminDemandas())
            ->get('/demandas/1/1/editar')
            ->assertOk();


    }

    private function user()
    {

        $user = factory(User::class)->create();

        return $user;

    }

    private function demanda()
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

    private function projeto()
    {

        return [
            'id' => 1,
            'name' => 'teste',
            'descricao' => 'descricao teste',
        ];

    }

    private function userProjeto()
    {

        return [
            'users_id' => $this->user()->id,
            'projetos_id' => $this->projeto()['id'],

        ];

    }

    private function permissionsAdminDemandas()
    {

        Permission::create(['name' => 'Criar Demandas']);
        Permission::create(['name' => 'Editar Demandas']);
        Permission::create(['name' => 'Deletar Demandas']);
        Permission::create(['name' => 'Vizualizar Demandas']);

        return Permission::all();

    }

    private function permissionsAdminProjetos()
    {

        Permission::create(['name' => 'Criar Projetos']);
        Permission::create(['name' => 'Editar Projetos']);
        Permission::create(['name' => 'Deletar Projetos']);
        Permission::create(['name' => 'Vizualizar Projetos']);

        return Permission::all();

    }

    private function permissionsUserPadrao()
    {

        Permission::create(['name' => 'Vizualizar Demandas']);

        return Permission::all();

    }

    private function userPadrao()
    {

        return $this->user()->givePermissionTo($this->permissionsUserPadrao());

    }

    private function adminDemandas()
    {

        return $this->user()->givePermissionTo($this->permissionsAdminDemandas());

    }

    private function adminProjetos()
    {

        return $this->user()->givePermissionTo($this->permissionsAdminProjetos());

    }


}
