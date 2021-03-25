<?php

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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Routes for Administrative Management */
// Admins without Authentication
Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
    //Login Routes
    Route::get('/login',[App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login',[App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('login.submit');;
});

// Admins with Authentication
Route::prefix('/admin')->name('admin.')->namespace('Admin')->middleware('auth:admin')->group(function(){
    Route::get('/',[App\Http\Controllers\Admin\HomeController::class, 'index'])->name('index');
    
});
