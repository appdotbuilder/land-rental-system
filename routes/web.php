<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Admin-only routes
    Route::middleware('can:admin-access')->group(function () {
        Route::resource('lands', LandController::class);
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
