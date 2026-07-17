<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::redirect('/', '/custom-login')->name('home');

/*Apply the same middleware to all routes inside this group.*/
Route::middleware(['guest'])->group(function () {
    Route::get('/custom-register',[AuthController::class, 'showRegister'])
    ->name('custom.register');

    Route::post('/custom-register', [AuthController::class, 'register'])
    ->name('custom.register.store');

    Route::get('/custom-login', [AuthController::class, 'showLogin'])
    ->name('custom.login');

    Route::post('/custom-login', [AuthController::class, 'login'])
    ->name('custom.login.store');
});

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Add a resource route for projects, which will handle all CRUD operations
    Route::resource('projects', ProjectController::class);

    Route::resource('projects.tasks', TaskController::class)
    ->shallow()
    ->except(['index', 'show']);
});

Route::post('/custom-logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('custom.logout');

require __DIR__.'/settings.php';
