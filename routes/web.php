<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Auth\RegisterController;

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

// Route::prefix('admin')->middleware('auth')->group(function(){
//     Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
// });

Route::prefix('admin')->group(function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');

    Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('admin.register');
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('users', [UserController::class, 'index'])->name('admin.users');
    Route::get('blogs', [BlogController::class, 'index'])->name('admin.blogs');
    Route::get('logout',[LoginController::class, 'logout']);
});
