<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\InterfaceCarRepository;
use App\Repositories\CarRepository;
class CarServiceProvider extends ServiceProvider
{
    /**
     * User any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(InterfaceCarRepository::class, CarRepository::class);
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
