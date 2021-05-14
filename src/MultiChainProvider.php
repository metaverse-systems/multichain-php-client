<?php

namespace MetaverseSystems\MultiChain;

use Illuminate\Support\ServiceProvider;
use MetaverseSystems\MultiChain\Commands\InstallMultiChainDaemon;

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
            InstallMultiChainDaemon::class
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}

