<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Fatura;
use App\Policies\FaturaPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Fatura::class => FaturaPolicy::class,
        // Adicione outros mapeamentos de model/policy aqui
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Definir gates adicionais (opcional)
        Gate::define('admin-access', function ($user) {
            return $user->is_admin;
        });
    }
}