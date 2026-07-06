<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    // Add a resource route for projects, which will handle all CRUD operations
    Route::resource('projects', ProjectController::class);

    Route::resource('projects.tasks', TaskController::class)
    ->shallow()
    ->except(['index', 'show']);
});

require __DIR__.'/settings.php';
