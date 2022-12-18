<?php

namespace MetaverseSystems\MultiChain;

use Illuminate\Support\ServiceProvider;
use MetaverseSystems\MultiChain\Commands\InstallMultiChainDaemon;
use MetaverseSystems\MultiChain\MultiChainClient;
use MetaverseSystems\MultiChain\Commands\CreateChain;
use MetaverseSystems\MultiChain\Commands\StartChain;

class MultiChainProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(!$this->app->routesAreCached())
        {
            require __DIR__.'/Routes.php';
        }

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('multichain.php'),
        ], 'config');

        $this->app->bind('multichain', function($app) {
            return new MultiChainClient(config('multichain.host'), config('multichain.port'), config('multichain.user'), config('multichain.pass'));
        });
    }
}

