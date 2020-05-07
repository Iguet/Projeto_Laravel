<?php

namespace App\Policies;

use App\Projetos;
use App\UsersProjetos;
use App\User;
use auth;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class ProjetosPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any projetos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

        $user = Auth::user();

        return $user->can('Vizualizar Projetos');

    }

    /**
     * Determine whether the user can view the projetos.
     *
     * @param  \App\User  $user
     * @param  \App\Projetos  $projetos
     * @return mixed
     */
    public function view(User $user, Projetos $projetos)
    {
        //
    }

    /**
     * Determine whether the user can create projetos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

        $user = Auth::user();

        return $user->can('Criar Projetos');

    }

    /**
     * Determine whether the user can update the projetos.
     *
     * @param  \App\User  $user
     * @param  \App\Projetos  $projetos
     * @return mixed
     */
    public function update()
    {
        $user = Auth::user();

        return $user->can('Editar Projetos');

    }

    /**
     * Determine whether the user can delete the projetos.
     *
     * @param  \App\User  $user
     * @param  \App\Projetos  $projetos
     * @return mixed
     */
    public function delete(User $user)
    {
        $user = Auth::user();

        return $user->can('Deletar Projetos');
    }

    /**
     * Determine whether the user can restore the projetos.
     *
     * @param  \App\User  $user
     * @param  \App\Projetos  $projetos
     * @return mixed
     */
    public function restore(User $user, Projetos $projetos)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the projetos.
     *
     * @param  \App\User  $user
     * @param  \App\Projetos  $projetos
     * @return mixed
     */
    public function forceDelete(User $user, Projetos $projetos)
    {
        //
    }
}
