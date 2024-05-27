<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\auth\FacebookController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');

    return 'Cache cleared!';
});


Route::get('/', function () {
    return view('welcome');
});


Route::get('auth-google', [GoogleController::class, 'redirectToGoogle'])->name('auth-google');
Route::get('auth-google-callback', [GoogleController::class, 'handleGoogleCallback'])->name('auth-google-callback');

Route::get('auth-facebook', [FacebookController::class, 'redirectToFacebook'])->name('auth-facebook');
Route::get('auth-facebook-callback', [FacebookController::class, 'handleFacebookCallback'])->name('auth-facebook-callback');


Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('home', [DashboardController::class, 'dashboard'])->name('home');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('post', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('support', [FrontController::class, 'support'])->name('support');
Route::get('privacy-policy', [FrontController::class, 'privacy_policy'])->name('privacy-policy');
Route::get('terms-and-condition', [FrontController::class, 'terms_condition'])->name('terms-and-condition');




require __DIR__ .'/auth.php';