<?php

namespace Tests\Feature;

use App\Projetos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ProjetosTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();


    }

    public function test_only_logged_users_can_see_projetos()
    {

       $this->get('/projetos')
            ->assertRedirect('/login');

    }

    public function test_user_has_permission_to_see_projetos()
    {

        $this->actingAs($this->data()->userPadrao())
            ->get('/projetos')
            ->assertOk();

    }

    public function test_user_has_permission_to_see_the_form_to_create_projetos()
    {

        $this->actingAs($this->data()->adminProjetos())
            ->get('/projetos/cadastrar')
            ->assertOk();

    }

    public function test_user_dont_have_permission_to_see_the_form_to_create_projetos()
    {

        $this->actingAs($this->data()->userPadrao())
            ->get('/projetos/cadastrar')
            ->assertForbidden();

    }

    public function test_user_has_permission_to_see_the_form_to_edit_projetos()
    {

        $this->withoutExceptionHandling();

        $this->data()->createProjeto();

        $this->actingAs($this->data()->adminProjetos())
            ->get('/projetos/1/editar')
            ->assertOk();

    }

    public function test_user_dont_have_permission_to_see_the_form_to_edit_projetos()
    {

        $this->withoutExceptionHandling();

//        $this->data()->createProjeto();

        $response = $this->actingAs($this->data()->userPadrao())
            ->get('/projetos/1/editar');

        $response->assertForbidden();

    }

    public function test_user_has_permission_to_create_projetos()
    {

        $this->actingAs($this->data()->adminProjetos())
            ->post('/projetos', $this->data()->projeto(), $this->data()->userProjeto())
            ->assertRedirect();

        $this->assertCount(1, Projetos::all());

    }

    public function test_user_dont_have_permission_to_create_projetos()
    {

        $this->actingAs($this->data()->userPadrao())
            ->post('/projetos', $this->data()->projeto(), $this->data()->userProjeto())
            ->assertForbidden();

        $this->assertCount(0, Projetos::all());

    }

    public function test_user_has_permission_to_update_projetos()
    {

        $this->withoutExceptionHandling();

        $this->data()->createProjeto();

        $this->data()->createUserProjeto();

        $this->actingAs($this->data()->adminProjetos())
            ->put('/projetos/1', $this->data()->projeto(), $this->data()->userProjeto())
            ->assertRedirect();

    }

//    public function test_user_dont_have_permission_to_update_projetos()
//    {
//
//        $this->withoutExceptionHandling();
//
//        $this->data()->createProjeto();
//
//        $this->data()->createUserProjeto();
//
//        $response = $this->actingAs($this->data()->userPadrao())
//            ->put('/projetos/1', $this->data()->projeto(), $this->data()->userProjeto())
//            ->assertForbidden();
//
//    }

    public function test_user_has_permission_to_delete_projetos()
    {

        $this->data()->createProjeto();
        $this->data()->createUserProjeto();

        $this->actingAs($this->data()->adminProjetos())
            ->post('/projetos/delete/1')
            ->assertRedirect();

    }

    public function test_user_dont_have_permission_to_delete_projetos()
    {

        $this->data()->createProjeto();
        $this->data()->createUserProjeto();

        $this->actingAs($this->data()->userPadrao())
            ->post('/projetos/delete/1')
            ->assertForbidden();

        $this->assertCount(1, Projetos::all());

    }

    private function data()
    {

        return $data = new FunctionsTest();

    }


}
