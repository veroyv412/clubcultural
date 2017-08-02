<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SocialAccountService;

class SocialAccountProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\SocialAccountService', function ($app) {
            return new SocialAccountService($app);
        });
    }
}
