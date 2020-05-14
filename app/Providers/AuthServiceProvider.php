<?php

namespace App\Providers;

use App\Demandas;
use App\Policies\DemandasPolicy;
use App\Policies\ProjetosPolicy;
use App\Projetos;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

        Demandas::class => DemandasPolicy::class,
        Projetos::class => ProjetosPolicy::class

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
