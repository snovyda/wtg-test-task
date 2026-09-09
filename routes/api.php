<?php

use App\Http\Controllers\Api\Imports\ImportCreateController;
use App\Http\Controllers\Api\Imports\ImportStatusController;
use App\Http\Controllers\Api\Offers\OfferReservationController;
use App\Http\Controllers\Api\Properties\PropertyFindController;

Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {

    Route::post('/imports', ImportCreateController::class);
    Route::get('/imports/{import}', ImportStatusController::class);

    Route::get('/properties', PropertyFindController::class);

    Route::post('/offers/{offerId}/reservations', OfferReservationController::class);
});
