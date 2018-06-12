<?php

namespace RicLeP\SocialLogin;

use Illuminate\Support\ServiceProvider;

class SocialLoginServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
		$this->loadRoutesFrom(__DIR__.'/routes.php');

		$this->loadMigrationsFrom(__DIR__.'../migrations');
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
