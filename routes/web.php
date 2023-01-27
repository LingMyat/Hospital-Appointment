<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\DiseaseController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Doctor\AuthController as DoctorAuthController;
use App\Http\Controllers\Doctor\ChatController as DoctorChatController;
use App\Http\Controllers\Doctor\HomeController as DoctorHomeController;
use App\Http\Controllers\Patient\AuthController as PatientAuthController;
use App\Http\Controllers\Patient\DoctorController as PatientDoctorController;
use App\Http\Controllers\Patient\HomeController as PatientHomeController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/',function(){
    return view('welcome');
})->name('welcome');

Route::prefix('admin')
->group(function(){
    Route::controller(AuthController::class)
    ->group(function(){
        Route::get('/login','loginPage')->name('admin.loginPage');
        Route::post('/login','login')->name('admin.login');
        Route::get('/logout','logout')->name('admin.logout');
    });

    Route::controller(HomeController::class)
    ->middleware('adminAuthenticated')
    ->group(function(){
        Route::get('/dashboard','dashboard')->name('admin.dashboard');
        Route::get('/diseases','diseases')->name('admin.diseases');
        Route::get('/sub-diseases','subDiseases')->name('admin.sub-diseases');
        Route::get('/permissions','permissions')->name('admin.permissions');
        Route::get('/roles','roles')->name('admin.roles');
        Route::get('/users','users')->name('admin.users');
        Route::get('/rooms','rooms')->name('admin.room');
    });

    Route::controller(DiseaseController::class)
    ->middleware('adminAuthenticated')
    ->group(function(){
        Route::prefix('main-diseases')
        ->group(function(){
            Route::get('/create','mainCreate')->name('admin.main-disease.create');
            Route::post('/create','mainStore')->name('admin.main-disease.store');
            Route::patch('/edit/{id}','mainUpdate')->name('admin.main-disease.update');
        });

        Route::prefix('sub-diseases')
        ->group(function(){
            Route::get('/create','subCreate')->name('admin.sub-disease.create');
            Route::post('/create','subStore')->name('admin.sub-disease.store');
            Route::patch('/edit/{id}','subUpdate')->name('admin.sub-disease.update');
        });

        Route::get('diseases/{id}','destroy')->name('admin.disease.destroy');
    });

    Route::controller(PermissionController::class)
    ->middleware('adminAuthenticated')
    ->prefix('permissions')
    ->group(function(){
        Route::get('/create','create')->name('admin.permission.create');
        Route::post('/create','store');
        Route::get('/edit/{id}','edit')->name('admin.permission.edit');
        Route::patch('/edit/{id}','update');
        Route::get('/{id}','destroy')->name('admin.permission.destroy');
    });

    Route::controller(RoleController::class)
    ->middleware('adminAuthenticated')
    ->prefix('roles')
    ->group(function(){
        Route::get('/create','create')->name('admin.role.create');
        Route::post('/create','store');
        Route::get('/edit/{id}','edit')->name('admin.role.edit');
        Route::patch('/edit/{id}','update');
        Route::get('/{id}','destroy')->name('admin.role.destroy');
    });

    Route::controller(UserController::class)
    ->middleware('adminAuthenticated')
    ->prefix('users')
    ->group(function(){
        Route::get('/create','create')->name('admin.user.create');
        Route::post('/create','store');
        Route::get('/edit/{id}','edit')->name('admin.user.edit');
        Route::patch('/edit/{id}','update');
        Route::get('/{id}','destroy')->name('admin.user.destroy');
    });

    Route::controller(ChatController::class)
    ->middleware('adminAuthenticated')
    ->prefix('rooms')
    ->group(function(){
        Route::get('/create','create')->name('admin.room.create');
    });

});
//Patient
Route::controller(PatientHomeController::class)
->group(function(){
    Route::get('/home','home')->name('HOME');
    Route::get('/doctors','doctors')->name('patient.doctors');
});

Route::controller(PatientDoctorController::class)
->prefix('doctors')
->group(function(){
    Route::get('/{slug}','show')->name('patient.doctor.show');
});

Route::controller(PatientAuthController::class)
->group(function(){
    Route::get('/login','loginPage')->name('patient.loginPage');
    Route::post('/login','login');
    Route::get('/register','registerPage')->name('patient.registerPage');
    Route::post('/register','register');
    Route::get('/logout','logout')->name('patient.logout');
});

//Doctor
Route::prefix('doctor')
->group(function(){
    Route::controller(DoctorAuthController::class)
    ->group(function(){
        Route::redirect('/','doctor/login');
        Route::get('/login','loginPage')->name('doctor.loginPage');
        Route::post('/login','login');
        Route::get('/register','registerPage')->name('doctor.registerPage');
        Route::post('/register','register');
        Route::get('/logout','logout')->name('doctor.logout');
        Route::patch('/profile','update');
    });

    Route::controller(DoctorHomeController::class)
    ->group(function(){
        Route::get('/dashboard','dashboard')->name('doctor.dashboard');
        Route::get('/profile','profile')->name('doctor.profile');
    });

    Route::controller(DoctorChatController::class)
    ->prefix('chat')
    ->group(function(){
        Route::get('/','index')->name('doctor.chat');
    });
});


