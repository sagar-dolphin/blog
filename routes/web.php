<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;


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
    Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('register', [RegisterController::class, 'register']);
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('logout',[LoginController::class, 'logout']);
    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    Route::get('email/verify/{token}', [RegisterController::class, 'verifyAccount'])->name('user.verify');
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
        Route::get('users', [UserController::class, 'index'])->name('admin.users');
        Route::get('blogs', [BlogController::class, 'index'])->name('admin.blogs');
    });
});
