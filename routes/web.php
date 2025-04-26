<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// USER dashboard - without auth (or you can add auth if you want)
Route::get('/user-dashboard', [AdminController::class, 'showUserDashboard'])->middleware(['auth', 'verified']);

// ADMIN dashboard - with auth and verified
Route::get('/admin-dashboard', [AdminController::class, 'showAdminDashboard'])->middleware(['auth', 'verified']);

// Default dashboard route after login
Route::get('/dashboard', [AdminController::class, 'showUserDashboard'])->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes
require __DIR__.'/auth.php';

// Admin routes (added part)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'showAdminDashboard'])->name('admin.dashboard'); // This is the new route
});
