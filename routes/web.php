<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\User\HomeController;


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

Route::get('/', [App\Http\Controllers\User\HomeController::class, 'index'])->name('user.home');
Route::get('blog/{id}', [App\Http\Controllers\User\HomeController::class, 'show'])->name('user.show');
Route::get('about', function(){
    return view('user.about');
})->name('user.about');

Route::get('contact', function(){
    return view('user.contact');
})->name('user.contact');

Route::prefix('admin')->group(function(){
    Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('register', [RegisterController::class, 'register']);
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login.post');
    Route::get('logout',[LoginController::class, 'logout']);
    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    Route::get('email/verify/{token}', [RegisterController::class, 'verifyAccount'])->name('user.verify');
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
        Route::resource('users', UserController::class)->except(['update']);
        Route::post('users/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::resource('blogs', BlogController::class)->except(['update']);
        Route::post('blogs/update/{id}', [BlogController::class, 'update'])->name('blogs.update');
        Route::post('blogs/uploadImages', [BlogController::class, 'uploadImage'])->name('blogs.images.upload');
        Route::post('blogs/removeImage', [BlogController::class, 'removeImage'])->name('blogs.removeImage');
    });    
});
