<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('/events', EventController::class);
    Route::post('/events/{event}/remove-image', [EventController::class, 'removeImage']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
