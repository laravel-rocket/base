<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Services\UserServiceInterface::class,
            \App\Services\Production\UserService::class
        );

        $this->app->singleton(
            \App\Services\FileServiceInterface::class,
            \App\Services\Production\FileService::class
        );

        $this->app->singleton(
            \App\Services\AdminUserServiceInterface::class,
            \App\Services\Production\AdminUserService::class
        );

        /* NEW BINDING */
    }
}
