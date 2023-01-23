<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DiseaseController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
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
        Route::get('/roles','roles')->name('admin.roles');
        Route::get('/users','users')->name('admin.users');
    });

    Route::controller(DiseaseController::class)
    ->middleware('adminAuthenticated')
    ->group(function(){

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

});


