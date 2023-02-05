<?php

use App\Http\Controllers\Api\Auth\v1\Patient\AuthController as ApiV1PatientAuthController;
use App\Http\Controllers\Api\v1\DiseaseContrller;
use App\Http\Controllers\Api\v1\DoctorController;
use App\Http\Resources\PatientProfileResource;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return new PatientProfileResource($request->user());
});


Route::controller(ApiV1PatientAuthController::class)
    ->prefix('v1/patient/auth')
    ->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::get('/logout', 'logout')->middleware('auth:sanctum');
    });

Route::prefix('v1/patient')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::controller(DiseaseContrller::class)
            ->group(function () {
                Route::get('main-diagnosis', 'mainDisease');
                Route::get('sub-diagnosis', 'subDisease');
            });

        Route::controller(DoctorController::class)
            ->group(function () {
                Route::get('doctors', 'doctors');
            });
    });
