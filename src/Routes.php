<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use MetaverseSystems\MultiChain\Controllers\BlockchainController;
use MetaverseSystems\MultiChain\Controllers\NodeController;
use MetaverseSystems\MultiChain\Controllers\StreamController;
use MetaverseSystems\MultiChain\Controllers\ItemController;

Route::group(['middleware'=>config('multichain.middleware'), 'prefix'=>'api' ], function () {
    Route::resource('blockchain', BlockchainController::class);
    Route::resource('blockchain/{chain}/node', NodeController::class);
    Route::resource('blockchain/{chain}/stream', StreamController::class);
    Route::resource('blockchain/{chain}/stream/{stream}/item', ItemController::class);
});
