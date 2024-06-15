<?php

use App\Http\Controllers\PublicApi\HumanEventController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => '/v1'], function () {
    Route::get('/login', [HumanEventController::class, 'login']);
    Route::post('/human-event'   , [HumanEventController::class, 'insertHumanEvent']);
});

