<?php

use App\Http\Controllers\Api\Imports\ImportCreateController;
use App\Http\Controllers\Api\Imports\ImportStatusController;

Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {

    Route::post('/imports', ImportCreateController::class);
    Route::get('/imports/{import}', ImportStatusController::class);

});
