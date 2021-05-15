<?php

namespace MetaverseSystems\MultiChain\Facades;

use Illuminate\Support\Facades\Facade;

class MultiChain extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'multichain';
    }
}
