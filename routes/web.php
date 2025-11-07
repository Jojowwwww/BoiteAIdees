<?php

use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return view('pages.welcome');
})->name('home');

Route::get('/inscription', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/inscription', [AuthController::class, 'register']);

Route::get('/connexion', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/connexion', [AuthController::class, 'login']);
Route::post('/deconnexion', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [IdeaController::class, 'index'])->name('dashboard');

   Route::resource('idea', IdeaController::class)->except(['show']);
});