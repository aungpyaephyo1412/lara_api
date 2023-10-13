<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Middleware\CheckApiToken;
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



Route::prefix("v1")->middleware(["cat"])->group(function (){
    Route::apiResource("items",ItemController::class);

    Route::controller(AuthController::class)->group(function (){
        Route::post("register","store")->name("api.store");
        Route::post("login","check")->name("api.check");
        Route::post("logout","logOut")->name("api.logout");
    });
});
