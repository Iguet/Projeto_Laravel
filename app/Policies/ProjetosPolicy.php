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
        $idUser = Auth::user()->id;

        $users = User::permission('Editar Projetos')->get();

        $flag = "";

        foreach ($users as $key) {
            
            if($key->id === $idUser){

                $flag = $key->id;
                
            }


        }

        return $flag === $idUser;


        // $idUser = Auth::user()->id;

        // $users = User::permission('Editar Projetos')->get();

        // foreach ($users as $key) {
            
        //     if($key->id === $idUser){

        //         echo("AQUI");

        //     } else {

        //         echo("fodase");
        //     }


        // }

        // dd($users);

        // return $result;
    }

    /**
     * Determine whether the user can delete the projetos.
     *
     * @param  \App\User  $user
     * @param  \App\Projetos  $projetos
     * @return mixed
     */
    public function delete(User $user, Projetos $projetos)
    {
        //
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
