<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
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

Route::controller(AuthController::class)
->prefix('admin')
->group(function(){
    Route::get('/login','loginPage')->name('admin.loginPage');
    Route::post('/login','login')->name('admin.login');
    Route::get('/logout','logout')->name('admin.logout');
});

Route::controller(HomeController::class)
->prefix('admin')
->group(function(){
    Route::get('/dashboard','dashboard')->name('admin.dashboard');
});
