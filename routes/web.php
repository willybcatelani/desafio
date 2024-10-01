<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartnerSellController;

Route::group(['prefix' => 'api'], function () {
    Route::post('/partner-sells', [PartnerSellController::class, 'store'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
});
