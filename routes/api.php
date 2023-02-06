<?php

use App\Http\Controllers\Api\Auth\v1\Patient\AuthController as ApiPatientAuthController;
use App\Http\Controllers\Api\v1\DiseaseContrller;
use App\Http\Controllers\Api\v1\DoctorController;
use App\Http\Controllers\Api\v1\NrcController;
use App\Http\Controllers\Api\v1\Patient\AppointmentController as ApiPatientAppointmentController;
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

Route::middleware('auth:sanctum')->get('/profile', function (Request $request) {
    return new PatientProfileResource($request->user());
});


Route::controller(ApiPatientAuthController::class)
    ->prefix('v1/patient/auth')
    ->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::middleware('auth:sanctum')
            ->group(function () {
                Route::get('/logout', 'logout');
                Route::post('/update','update');
            });
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

        Route::controller(ApiPatientAppointmentController::class)
            ->prefix('appointments')
            ->group(function () {
                Route::get('/', 'index');
                Route::post('/store', 'store');
            });

        Route::controller(NrcController::class)
            ->prefix('nrc')
            ->group(function () {
                Route::get('/code','nrcCode');
                Route::get('/{nrc_code}/name','nrcNameMm');
            });
    });
