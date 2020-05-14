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

        Projetos::create($this->data()->projeto());

    }

    public function test_only_logged_users_can_see_demandas()
    {

        $response = $this->get('/demandas');

        $response->assertRedirect('/login');

    }

    public function test_user_have_permission_to_see_demandas()
    {

        $response = $this->actingAs($this->data()->userPadrao())
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

        $response = $this->actingAs($this->data()->adminDemandas())
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

        $response = $this->actingAs($this->data()->adminDemandas())
            ->post('/demandas', $this->data()->demanda());

        $this->assertCount(1, Demandas::all());

    }

    public function test_user_dont_have_permission_to_create_demandas()
    {

        $response = $this->actingAs($this->data()->userPadrao())
            ->post('/demandas', $this->data()->demanda())
            ->assertStatus(403);

    }

    public function test_user_has_permission_to_see_the_form_to_edit_demandas()
    {

//        $this->withoutExceptionHandling();

        $this->data()->createDemanda();

        $response = $this->actingAs($this->data()->adminDemandas())
            ->get('/demandas/1/1/editar')
            ->assertOk();


    }

//    public function test_user_dont_have_permission_to_update_demandas()
//    {
//
//        $this->withoutExceptionHandling();
//
//        Demandas::create($this->demanda());
//
//        $response = $this->actingAs($this->userPadrao())
//            ->put('/demandas/1', $this->demanda());
//
//        $response = $this->assertIsArray([
//            'allowed' => 'false',
//            'message' => 'Você não ter permissão para editar demandas',
//            'code' => 'null'
//        ]);
//
////        $response->;
////            ->assertStatus(401);
//
//
//    }

    public function test_user_has_permission_to_update_demandas()
    {

        $this->withoutExceptionHandling();

        $this->data()->createDemanda();

        $response = $this->actingAs($this->data()->adminDemandas())
            ->put('/demandas/1', $this->data()->demanda())
            ->assertRedirect();

        $this->assertCount(1, Demandas::all());

    }

//    public function test_user_dont_have_permission_to_delete_demandas()
//    {
//
//        $this->withoutExceptionHandling();
//
////        Demandas::create($this->demanda());
//
//        $response = $this->actingAs($this->userPadrao())
//            ->post('/demandas/delete/1')
//            ->assertRedirect();
//
//        $this->assertCount(0, Demandas::all());
//
//    }

    public function test_user_has_permission_to_delete_demandas()
    {
        $this->withoutExceptionHandling();

        $this->data()->createDemanda();

        $response = $this->actingAs($this->data()->adminDemandas())
            ->post('/demandas/delete/1')
            ->assertRedirect();

        $this->assertCount(0, Demandas::all());

    }

    private function user()
    {

        $user = factory(User::class)->create();

        return $user;

    }

    private function data()
    {

        return $data = new FunctionsTest();

    }

}
