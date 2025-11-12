<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ListingController;

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
    Route::middleware('role:Student')->group(function () {
        Route::get('/student/home', function () {
            return view('student.home');
        })->name('student.home');

        Route::get('/student/dashboard', function () {
            return view('dashboards.student');
        })->name('student.dashboard');

        Route::get('/student/rental-requests', function () {
            return view('student.rental-requests');
        })->name('student.rental-requests');

        Route::get('/student/bookmarks', function () {
            return view('student.bookmarks');
        })->name('student.bookmarks');

        Route::get('/student/search', function () {
            return view('student.search');
        })->name('student.search');

        Route::get('/student/accommodation', function () {
            return view('student.accommodation');
        })->name('student.accommodation');

        Route::get('/student/chat', function () {
            return view('student.chat');
        })->name('student.chat');

        Route::get('/student/community', function () {
            return view('student.community');
        })->name('student.community');

        Route::get('/student/complaint', function () {
            return view('student.complaint');
        })->name('student.complaint');

        Route::get('/student/feedback', function () {
            return view('student.feedback');
        })->name('student.feedback');

        Route::get('/student/faqs', function () {
            return view('student.faqs');
        })->name('student.faqs');
    });

    Route::middleware('role:Landlord')->group(function () {
        Route::get('/landlord/dashboard', function () {
            return view('dashboards.landlord');
        })->name('landlord.dashboard');

        Route::get('/landlord/my-listings', function () {
            return view('landlord.my-listings');
        })->name('landlord.my-listings');

        Route::get('/landlord/rental-requests', function () {
            return view('landlord.rental-requests');
        })->name('landlord.rental-requests');

        Route::get('/landlord/approved-listings', [ListingController::class, 'approvedListings'])->name('landlord.approved-listings');

        Route::get('/landlord/chat', function () {
            return view('landlord.chat');
        })->name('landlord.chat');

        Route::get('/landlord/community', function () {
            return view('landlord.community');
        })->name('landlord.community');

        Route::get('/landlord/feedback', function () {
            return view('landlord.feedback');
        })->name('landlord.feedback');

        Route::get('/landlord/faqs', function () {
            return view('landlord.faqs');
        })->name('landlord.faqs');

        Route::get('/landlord/create-listing', [App\Http\Controllers\ListingController::class, 'create'])->name('landlord.create-listing');
        Route::post('/landlord/store-listing', [App\Http\Controllers\ListingController::class, 'store'])->name('landlord.store-listing');

    });

    Route::get('/admin/dashboard', function () {
        return view('dashboards.admin');
    })->middleware('role:Admin')->name('admin.dashboard');
});
