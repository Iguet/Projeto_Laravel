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

       $response = $this->get('/projetos')
            ->assertRedirect('/login');

    }

    public function test_user_has_permission_to_see_projetos()
    {

        $response = $this->actingAs($this->data()->userPadrao())
            ->get('/projetos')
            ->assertOk();

    }

    public function test_user_has_permission_to_see_the_form_to_create_projetos()
    {

        $response = $this->actingAs($this->data()->adminProjetos())
            ->get('/projetos/cadastrar')
            ->assertOk();

    }

    public function test_user_dont_have_permission_to_see_the_form_to_create_projetos()
    {

        $response = $this->actingAs($this->data()->userPadrao())
            ->get('/projetos/cadastrar')
            ->assertForbidden();

    }

    public function test_user_has_permission_to_see_the_form_to_edit_projetos()
    {

        $this->withoutExceptionHandling();

        $this->data()->createProjeto();

        $response = $this->actingAs($this->data()->adminProjetos())
            ->get('/projetos/1/editar')
            ->assertOk();

    }

//    public function test_user_dont_have_permission_to_see_the_form_to_edit_projetos()
//    {
//
//        $this->withoutExceptionHandling();
//
////        $this->data()->createProjeto();
//
//        $response = $this->actingAs($this->data()->userPadrao())
//            ->get('/projetos/1/editar')
//            ->assertForbidden();
//
//    }

    public function test_user_has_permission_to_create_projetos()
    {

        $this->withoutExceptionHandling();

        $this->data()->createProjeto();

        $this->data()->createUserProjeto();

        $response = $this->actingAs($this->data()->adminProjetos())
            ->post('/projetos', $this->data()->projeto())
            ->assertRedirect();

        $this->assertCount(1, Projetos::all());

    }

    private function data()
    {

        return $data = new FunctionsTest();

    }


}
