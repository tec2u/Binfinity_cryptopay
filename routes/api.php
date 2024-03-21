<?php

use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\ApiApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(PaymentController::class)->group(function () {
    Route::post('/notity', 'notity')->name('notity');//autentica login de usuarios
});


Route::prefix('/app')->name('api.app')->group(function () {
    Route::controller(ApiApp::class)->group(function () {
        Route::post('/login', 'login')->name('.login');
        //protegida
        Route::middleware('token.auth')->group(function () {
            Route::post('/teste', 'teste')->name('.teste');
        });
    });
});

