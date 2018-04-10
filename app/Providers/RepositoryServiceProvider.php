<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{   
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        \App\Contracts\Repositories\UserRepositoryInterface::class => \App\Repositories\UserRepository::class,
        \App\Contracts\Repositories\RoleRepositoryInterface::class => \App\Repositories\RoleRepository::class,
        \App\Contracts\Repositories\ActiveRepositoryInterface::class => \App\Repositories\ActiveRepository::class,
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
