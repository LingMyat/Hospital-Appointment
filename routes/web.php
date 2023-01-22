<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DiseaseController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
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

Route::get('/logout',function(){
    Auth::logout(auth()->user());
    return to_route('welcome');
})->name('logout');


Route::prefix('admin')
->group(function(){
    Route::controller(AuthController::class)
    ->group(function(){
        Route::get('/login','loginPage')->name('admin.loginPage');
        Route::post('/login','login')->name('admin.login');
    });

    Route::controller(HomeController::class)
    ->middleware('adminAuthenticated')
    ->group(function(){
        Route::get('/dashboard','dashboard')->name('admin.dashboard');
        Route::get('/diseases','diseases')->name('admin.diseases');
        Route::get('/permissions','permissions')->name('admin.permissions');
    });

    Route::controller(DiseaseController::class)
    ->middleware('adminAuthenticated')
    ->group(function(){

    });

    Route::controller(PermissionController::class)
    ->middleware('adminAuthenticated')
    ->prefix('permissions')
    ->group(function(){
        Route::get('/create','create')->name('admin.permissions.create');
        Route::post('/create','store');
        Route::get('/{id}','destory');
    });

});


