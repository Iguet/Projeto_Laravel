<?php

namespace App\Policies;

use App\Demandas;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DemandasPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any demandas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the demandas.
     *
     * @param  \App\User  $user
     * @param  \App\Demandas  $demandas
     * @return mixed
     */
    public function view(User $user, Demandas $demandas)
    {
        //
    }

    /**
     * Determine whether the user can create demandas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the demandas.
     *
     * @param  \App\User  $user
     * @param  \App\Demandas  $demandas
     * @return mixed
     */
    public function update(User $user, Demandas $demandas)
    {
        //
    }

    /**
     * Determine whether the user can delete the demandas.
     *
     * @param  \App\User  $user
     * @param  \App\Demandas  $demandas
     * @return mixed
     */
    public function delete(User $user, Demandas $demandas)
    {
        //
    }

    /**
     * Determine whether the user can restore the demandas.
     *
     * @param  \App\User  $user
     * @param  \App\Demandas  $demandas
     * @return mixed
     */
    public function restore(User $user, Demandas $demandas)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the demandas.
     *
     * @param  \App\User  $user
     * @param  \App\Demandas  $demandas
     * @return mixed
     */
    public function forceDelete(User $user, Demandas $demandas)
    {
        //
    }
}
