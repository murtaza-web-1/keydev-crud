<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Admin routes - Only authenticated and verified users
Route::middleware(['auth', 'verified'])->group(function () {
    // Admin dashboard route
    Route::get('/admin/dashboard', [AdminController::class, 'showAdminDashboard'])
        ->name('admin.dashboard');

    // User dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Admin user management routes
    Route::prefix('admin')->group(function () {
        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])
            ->name('admin.user.edit');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])
            ->name('admin.user.update');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])
            ->name('admin.user.destroy');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes
require __DIR__.'/auth.php';
