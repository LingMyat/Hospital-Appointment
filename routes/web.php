<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\DiseaseController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Doctor\AppointmentController as DoctorAppointmentController;
use App\Http\Controllers\Doctor\AuthController as DoctorAuthController;
use App\Http\Controllers\Doctor\ChatController as DoctorChatController;
use App\Http\Controllers\Doctor\DoctorTimeController;
use App\Http\Controllers\Doctor\HomeController as DoctorHomeController;
use App\Http\Controllers\Patient\AppointmentController as PatientAppointmentController;
use App\Http\Controllers\Patient\AuthController as PatientAuthController;
use App\Http\Controllers\Patient\ChatController as PatientChatController;
use App\Http\Controllers\Patient\DoctorController as PatientDoctorController;
use App\Http\Controllers\Patient\HomeController as PatientHomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::prefix('sessions/forget')
    ->group(function () {
        Route::post('/success', function () {
            session()->forget('success');
        })->name('forget.success');
        Route::post('/error', function () {
            session()->forget('error');
        })->name('forget.error');
    });

Route::prefix('admin')
    ->group(function () {
        Route::controller(AuthController::class)
            ->group(function () {
                Route::get('/login', 'loginPage')->name('admin.loginPage');
                Route::post('/login', 'login')->name('admin.login');
                Route::get('/logout', 'logout')->name('admin.logout');
            });

        Route::controller(HomeController::class)
            ->middleware('adminAuthenticated')
            ->group(function () {
                Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
                Route::get('/diseases', 'diseases')->name('admin.diseases');
                Route::get('/sub-diseases', 'subDiseases')->name('admin.sub-diseases');
                Route::get('/permissions', 'permissions')->name('admin.permissions');
                Route::get('/roles', 'roles')->name('admin.roles');
                Route::get('/users', 'users')->name('admin.users');
                Route::get('/rooms', 'rooms')->name('admin.room');
            });

        Route::controller(DiseaseController::class)
            ->middleware('adminAuthenticated')
            ->group(function () {
                Route::prefix('main-diseases')
                    ->group(function () {
                        Route::get('/create', 'mainCreate')->name('admin.main-disease.create');
                        Route::post('/create', 'mainStore')->name('admin.main-disease.store');
                        Route::patch('/{id}/edit', 'mainUpdate')->name('admin.main-disease.update');
                    });

                Route::prefix('sub-diseases')
                    ->group(function () {
                        Route::get('/create', 'subCreate')->name('admin.sub-disease.create');
                        Route::post('/create', 'subStore')->name('admin.sub-disease.store');
                        Route::patch('/{id}/edit', 'subUpdate')->name('admin.sub-disease.update');
                    });

                Route::get('diseases/{id}', 'destroy')->name('admin.disease.destroy');
            });

        Route::controller(PermissionController::class)
            ->middleware('adminAuthenticated')
            ->prefix('permissions')
            ->group(function () {
                Route::get('/create', 'create')->name('admin.permission.create');
                Route::post('/create', 'store');
                Route::get('/{id}/edit', 'edit')->name('admin.permission.edit');
                Route::patch('/{id}/edit', 'update');
                Route::get('/{id}', 'destroy')->name('admin.permission.destroy');
            });

        Route::controller(RoleController::class)
            ->middleware('adminAuthenticated')
            ->prefix('roles')
            ->group(function () {
                Route::get('/create', 'create')->name('admin.role.create');
                Route::post('/create', 'store');
                Route::get('/{id}/edit', 'edit')->name('admin.role.edit');
                Route::patch('/{id}/edit', 'update');
                Route::get('/{id}', 'destroy')->name('admin.role.destroy');
            });

        Route::controller(UserController::class)
            ->middleware('adminAuthenticated')
            ->prefix('users')
            ->group(function () {
                Route::get('/create', 'create')->name('admin.user.create');
                Route::post('/create', 'store');
                Route::get('/{id}/edit', 'edit')->name('admin.user.edit');
                Route::patch('/{id}/edit', 'update');
                Route::get('/{id}', 'destroy')->name('admin.user.destroy');
            });

        Route::controller(ChatController::class)
            ->middleware('adminAuthenticated')
            ->prefix('rooms')
            ->group(function () {
                Route::get('/create', 'create')->name('admin.room.create');
                Route::post('/', 'store')->name('admin.room.store');
            });
    });
//Patient
Route::controller(PatientHomeController::class)
    ->group(function () {
        Route::get('/home', 'home')->name('HOME');
        Route::get('/doctors', 'doctors')->name('patient.doctors');
        Route::get('/chats', 'chats')->name('patient.chat');
    });

Route::controller(PatientDoctorController::class)
    ->prefix('doctors')
    ->group(function () {
        Route::get('/{slug}', 'show')->name('patient.doctor.show');
        Route::get('/{slug}/times', 'doctorTimes')->name('patient.doctor.time');
    });

Route::controller(PatientAuthController::class)
    ->group(function () {
        Route::get('/login', 'loginPage')->name('patient.loginPage');
        Route::post('/login', 'login');
        Route::get('/register', 'registerPage')->name('patient.registerPage');
        Route::post('/register', 'register');
        Route::get('/logout', 'logout')->name('patient.logout');
    });

Route::controller(PatientChatController::class)
    ->prefix('chats')
    ->group(function () {
        Route::get('/show', 'show')->middleware('patientAuth');
        Route::post('/', 'store')->name('patient.chat.store');
        Route::post('/image', 'storeImage')->name('patient.chat.image.store');
    });

Route::controller(PatientAppointmentController::class)
    ->prefix('appointments')
    ->group(function () {
        Route::get('/{id}/form', 'create')->name('patient.appointment.form');
        Route::post('/', 'store')->name('patient.appointment.store');
    });
//Doctor
Route::prefix('doctor')
    ->group(function () {
        Route::controller(DoctorAuthController::class)
            ->group(function () {
                Route::redirect('/', 'doctor/login');
                Route::get('/login', 'loginPage')->name('doctor.loginPage');
                Route::post('/login', 'login');
                Route::get('/register', 'registerPage')->name('doctor.registerPage');
                Route::post('/register', 'register');
                Route::get('/logout', 'logout')->name('doctor.logout');
                Route::patch('/profile', 'update');
            });

        Route::middleware('isDoctorAuthenticate')
            ->group(function () {
                Route::controller(DoctorHomeController::class)
                    ->group(function () {
                        Route::get('/dashboard', 'dashboard')->name('doctor.dashboard');
                        Route::get('/profile', 'profile')->name('doctor.profile');
                    });

                Route::controller(DoctorChatController::class)
                    ->prefix('rooms')
                    ->group(function () {
                        Route::get('/', 'index')->name('doctor.chat');
                        Route::get('/chat', 'show');
                        Route::post('/', 'store')->name('doctor.chat.store');
                        Route::post('/image', 'storeImage')->name('doctor.chat.image.store');
                    });
                Route::controller(DoctorTimeController::class)
                    ->prefix('doctor-time')
                    ->group(function () {
                        Route::get('/', 'doctorTimeForm')->name('doctor.time.form');
                        Route::post('/', 'store')->name('doctor.time.store');
                        Route::patch('/{id}/update', 'update')->name('doctor.time.update');
                        Route::get('/{id}/delete', 'destroy')->name('doctor.time.destroy');
                    });
                Route::controller(DoctorAppointmentController::class)
                    ->prefix('appointments')
                    ->group(function () {
                        Route::get('/', 'index')->name('doctor.appointment');
                        Route::get('/{id}/show', 'show')->name('doctor.appointment.show');
                        Route::post('/{id}/success', 'success')->name('doctor.appointment.update.success');
                        Route::post('/{id}/cancel', 'cancel')->name('doctor.appointment.update.cancel');
                    });
            });
    });
