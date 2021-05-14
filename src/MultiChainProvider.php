<?php

namespace MetaverseSystems\MultiChain;

use Illuminate\Support\ServiceProvider;

class MultiChainProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('multichain.php'),
        ], 'config');
    }
}

