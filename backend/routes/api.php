<?php

use App\Http\Controllers\GeoController;
use App\Http\Controllers\GetController;
use App\Models\User;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        $user = User::with('city')->find($request->user()->id);
        return response()->json($user);
    });
});



Route::get('/get', [GetController::class, 'index']);

Route::group(['prefix' => 'geo'], function () {
    Route::get('/cities/{name?}', [GeoController::class, 'getCities']);

    Route::get('/countries', [GeoController::class, 'getCountries']);

    Route::get('/regions', [GeoController::class, 'getRegions']);
});

