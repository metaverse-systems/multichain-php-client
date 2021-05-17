<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use MetaverseSystems\MultiChain\Controllers\BlockchainController;
use MetaverseSystems\MultiChain\Controllers\StreamController;

Route::group(['middleware'=>config('multichain.middleware'), 'prefix'=>'api' ], function () {
    Route::resource('blockchain', BlockchainController::class);
    Route::resource('blockchain/{name}/stream', StreamController::class);
});
