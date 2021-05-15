<?php

namespace MetaverseSystems\MultiChain;

use Illuminate\Support\ServiceProvider;
use MetaverseSystems\MultiChain\MultiChainClient;

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

        $this->app->bind('multichain', function($app) {
            return new MultiChainClient(config('multichain.host'), config('multichain.port'), config('multichain.user'), config('multichain.pass'));
        });
    }
}

