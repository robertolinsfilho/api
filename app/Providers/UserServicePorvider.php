<?php

namespace App\Providers;


use App\Repositories\InterfaceUserRepository;
use App\Repositories\UserRepository;
use Carbon\Laravel\ServiceProvider;

class UserServicePorvider extends ServiceProvider
{
    /**
     * User any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(InterfaceUserRepository::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
