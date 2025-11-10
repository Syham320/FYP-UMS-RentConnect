<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;

// Landing page
Route::get('/', function () {
    return view('landing');
});

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/profile/edit', [ProfileController::class, 'showEditForm'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/delete', [ProfileController::class, 'delete'])->name('profile.delete');

    // Role-based dashboards
    Route::get('/student/dashboard', function () {
        return view('dashboards.student');
    })->middleware('role:Student')->name('student.dashboard');

    Route::get('/landlord/dashboard', function () {
        return view('dashboards.landlord');
    })->middleware('role:Landlord')->name('landlord.dashboard');

    Route::get('/admin/dashboard', function () {
        return view('dashboards.admin');
    })->middleware('role:Admin')->name('admin.dashboard');
});
