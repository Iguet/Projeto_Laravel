<?php

namespace App\Policies;

use App\Demandas;
use App\User;
use auth;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class DemandasPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any demandas.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

        $user = Auth::user();

        return $user->can('Vizualizar Demandas');

    }

    /**
     * Determine whether the user can view the demandas.
     *
     * @param \App\User $user
     * @param \App\Demandas $demandas
     * @return mixed
     */
    public function view(User $user)
    {

        $user = Auth::user();

        return $user->can('Vizualizar Demandas');

    }

    /**
     * Determine whether the user can create demandas.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {

        $user = Auth::user();

        return $user->can('Criar Demandas');

    }

    /**
     * Determine whether the user can update the demandas.
     *
     * @return mixed
     */
    public function update()
    {

        $user = Auth::user();

        return $user->can('Editar Demandas')
                    ? Response::allow()
                    : Response::deny('Você não ter permissão para editar demandas');

    }

    /**
     * Determine whether the user can delete the demandas.
     *
     * @param \App\User $user
     * @param \App\Demandas $demandas
     * @return mixed
     */
    public function delete(User $user)
    {

        $user = Auth::user();

        return $user->can('Deletar Demandas')
            ? Response::allow()
            : Response::deny('Você não ter permissão para deletar demandas');

    }

    /**
     * Determine whether the user can restore the demandas.
     *
     * @param \App\User $user
     * @param \App\Demandas $demandas
     * @return mixed
     */
    public function restore(User $user, Demandas $demandas)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the demandas.
     *
     * @param \App\User $user
     * @param \App\Demandas $demandas
     * @return mixed
     */
    public function forceDelete(User $user, Demandas $demandas)
    {
        //
    }
}
