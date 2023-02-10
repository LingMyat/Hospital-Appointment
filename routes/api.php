<?php

use App\Models\Day;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\DoctorResource;
use App\Http\Controllers\Api\v1\NrcController;
use App\Http\Resources\PatientProfileResource;
use App\Http\Controllers\Api\v1\DiseaseContrller;
use App\Http\Controllers\Api\v1\DoctorController;
use App\Http\Controllers\Api\Auth\v1\Doctor\AuthController as ApiDoctorAuthController;
use App\Http\Controllers\Api\Auth\v1\Patient\AuthController as ApiPatientAuthController;
use App\Http\Controllers\Api\V1\Doctor\AppointmentController;
use App\Http\Controllers\Api\v1\Doctor\DoctorTimeController;
use App\Http\Controllers\Api\v1\Patient\AppointmentController as ApiPatientAppointmentController;
use App\Http\Controllers\Api\v1\RoomController;

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
    if ($request->user()->role == 'doctor') {
        return new DoctorResource($request->user());
    }
    return new PatientProfileResource($request->user());
});

Route::get('/days', function () {
    $day = Day::all();
    return ResponseHelper::success($day);
});

Route::controller(DiseaseContrller::class)
    ->prefix('v1')
    ->group(function () {
        Route::get('main-diagnosis', 'mainDisease');
        Route::get('sub-diagnosis', 'subDisease');
    });

Route::controller(RoomController::class)
    ->prefix('v1/rooms')
    ->group(function () {
        Route::get('/', 'index');
        Route::middleware('auth:sanctum')
            ->group(function () {
                Route::get('{id}/room-messages', 'roomMessages');
                Route::post('store-room-message', 'storeRoomMessage');
                Route::post('store-chat-image', 'storeChatImage');
            });
    });



Route::prefix('v1/patient')
    ->group(function () {

        Route::controller(ApiPatientAuthController::class)
            ->prefix('/auth')
            ->group(function () {
                Route::post('/login', 'login');
                Route::post('/register', 'register');
                Route::middleware('auth:sanctum')
                    ->group(function () {
                        Route::delete('/logout', 'logout');
                        Route::post('/update', 'update');
                    });
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
    });

Route::prefix('v1/doctor')
    ->group(function () {

        Route::controller(ApiDoctorAuthController::class)
            ->prefix('/auth')
            ->group(function () {
                Route::post('/login', 'login');
                Route::post('/register', 'register');
                Route::middleware('auth:sanctum')
                    ->group(function () {
                        Route::delete('/logout', 'logout');
                        Route::patch('/update', 'update');
                    });
            });

        Route::middleware('auth:sanctum')
            ->group(function () {
                Route::controller(DoctorTimeController::class)
                    ->prefix('/doctor-time')
                    ->group(function () {
                        Route::post('/', 'store');
                        Route::patch('/{id}', 'update');
                        Route::delete('/{id}', 'destroy');
                    });
                Route::controller(AppointmentController::class)
                    ->prefix('appointments')
                    ->group(function () {
                        Route::get('/', 'index');
                        Route::patch('/{id}', 'update');
                    });
            });
    });
