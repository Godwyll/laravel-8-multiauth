<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController as AdminController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

/* Routes for Administrative Management */
// Admins without Authentication
Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
    //Login Routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');;
});

// Admins with Authentication
Route::prefix('/admin')->name('admin.')->middleware('auth:admin')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::resource('/users', UserController::class);
});
