<?php

use App\Http\Controllers\Api\Auth\v1\Doctor\AuthController as ApiDoctorAuthController;
use App\Http\Controllers\Api\Auth\v1\Patient\AuthController as ApiPatientAuthController;
use App\Http\Controllers\Api\v1\DiseaseContrller;
use App\Http\Controllers\Api\v1\DoctorController;
use App\Http\Controllers\Api\v1\NrcController;
use App\Http\Controllers\Api\v1\Patient\AppointmentController as ApiPatientAppointmentController;
use App\Http\Controllers\Api\v1\Patient\RoomController as ApiPatientRomController;
use App\Http\Resources\DoctorResource;
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
    if($request->user()->role=='doctor'){
        return new DoctorResource($request->user());
    }
    return new PatientProfileResource($request->user());
});


Route::controller(ApiPatientAuthController::class)
    ->prefix('v1/patient/auth')
    ->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::middleware('auth:sanctum')
            ->group(function () {
                Route::delete('/logout', 'logout');
                Route::post('/update', 'update');
            });
    });

Route::prefix('v1/patient')
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
            ->middleware('auth:sanctum')
            ->group(function () {
                Route::get('/', 'index');
                Route::post('/store', 'store');
            });

        Route::controller(NrcController::class)
            ->prefix('nrc')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('/code', 'nrcCode');
                Route::get('/{nrc_code}/name', 'nrcNameMm');
            });
        Route::controller(ApiPatientRomController::class)
            ->prefix('rooms')
            ->group(function () {
                Route::get('/', 'index');
                Route::get('{id}/room-messages', 'roomMessages')->middleware('auth:sanctum');
                Route::post('store-room-message', 'storeRoomMessage')->middleware('auth:sanctum');
                Route::post('store-chat-image', 'storeChatImage')->middleware('auth:sanctum');
            });
    });


Route::controller(ApiDoctorAuthController::class)
    ->prefix('v1/doctor/auth')
    ->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::middleware('auth:sanctum')
            ->group(function () {
                Route::delete('/logout', 'logout');
                Route::post('/update', 'update');
            });
    });
