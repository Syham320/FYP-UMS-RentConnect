<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\RentalRequestController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\FaqController;

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
        Route::get('/student/home', [App\Http\Controllers\ListingController::class, 'studentHome'])->name('student.home');

        Route::get('/student/dashboard', function () {
            return view('dashboards.student');
        })->name('student.dashboard');

        Route::get('/student/rental-requests', [RentalRequestController::class, 'studentRequests'])->name('student.rental-requests');
        Route::post('/student/rental-requests', [RentalRequestController::class, 'store'])->name('student.rental-requests.store');

        Route::get('/student/bookmarks', [App\Http\Controllers\ListingController::class, 'bookmarks'])->name('student.bookmarks');
        Route::post('/student/bookmarks/toggle/{listingId}', [App\Http\Controllers\ListingController::class, 'toggleBookmark'])->name('student.bookmarks.toggle');

        Route::get('/student/search', [App\Http\Controllers\ListingController::class, 'search'])->name('student.search');

        Route::get('/student/profile', function () {
            return view('student.profile');
        })->name('student.profile');

        Route::get('/student/accommodation', [AccommodationController::class, 'index'])->name('student.accommodation');
        Route::get('/student/accommodation/create', [AccommodationController::class, 'create'])->name('student.accommodation.create');
        Route::post('/student/accommodation', [AccommodationController::class, 'store'])->name('student.accommodation.store');
        Route::get('/student/accommodation/{id}', [AccommodationController::class, 'show'])->name('student.accommodation.show');
        Route::get('/student/accommodation/{id}/edit', [AccommodationController::class, 'edit'])->name('student.accommodation.edit');
        Route::put('/student/accommodation/{id}', [AccommodationController::class, 'update'])->name('student.accommodation.update');
        Route::delete('/student/accommodation/{id}', [AccommodationController::class, 'destroy'])->name('student.accommodation.destroy');

        Route::get('/student/chat', [App\Http\Controllers\ChatController::class, 'studentIndex'])->name('student.chat');
        Route::get('/student/chat/initiate-from-listing/{listingId}', [App\Http\Controllers\ChatController::class, 'initiateFromListing'])->name('student.chat.initiate-from-listing');
        Route::post('/student/chat/initiate', [App\Http\Controllers\ChatController::class, 'initiateRequest'])->name('student.chat.initiate');
        Route::post('/student/chat/{chatID}/send', [App\Http\Controllers\ChatController::class, 'studentSendMessage'])->name('student.chat.send');
        Route::delete('/student/chat/{chatID}', [App\Http\Controllers\ChatController::class, 'studentDeleteChat'])->name('student.chat.delete');

        Route::get('/student/community', function () {
            return view('student.community');
        })->name('student.community');

        Route::get('/student/complaint', function () {
            return view('student.complaint');
        })->name('student.complaint');

        Route::get('/student/feedback', [FeedbackController::class, 'userFeedback'])->name('student.feedback');
        Route::get('/student/feedback/{id}', [FeedbackController::class, 'show'])->name('student.feedback.detail');
        Route::get('/student/submit-feedback', function () {
            return view('student.submit-feedback');
        })->name('student.submit-feedback');
        Route::post('/student/feedback', [FeedbackController::class, 'store'])->name('student.feedback.store');

        Route::get('/student/faqs', function () {
            $faqs = \App\Models\Faq::where('user_role', 'Student')->where('is_active', true)->get()->groupBy('category');
            return view('student.faqs', compact('faqs'));
        })->name('student.faqs');

        Route::get('/student/complaint', [App\Http\Controllers\ComplaintController::class, 'userComplaints'])->name('student.complaint');
        Route::get('/student/complaint/{id}', [App\Http\Controllers\ComplaintController::class, 'show'])->name('student.complaint.detail');
        Route::get('/student/submit-complaint', function () {
            return view('student.submit-complaint');
        })->name('student.submit-complaint');
        Route::post('/student/complaint', [App\Http\Controllers\ComplaintController::class, 'store'])->name('student.complaint.store');

    });

    Route::middleware('role:Landlord')->group(function () {
        Route::get('/landlord/dashboard', function () {
            return view('dashboards.landlord');
        })->name('landlord.dashboard');

        Route::get('/landlord/my-listings', [ListingController::class, 'myListings'])->name('landlord.my-listings');

        Route::get('/landlord/rental-requests', [RentalRequestController::class, 'landlordRequests'])->name('landlord.rental-requests');
        Route::get('/landlord/rental-requests/{requestID}/status', [RentalRequestController::class, 'getStatus'])->name('landlord.rental-requests.get-status');
        Route::post('/landlord/rental-requests/{requestID}/status', [RentalRequestController::class, 'updateStatus'])->name('landlord.rental-requests.update-status');

        Route::get('/landlord/approved-listings', [ListingController::class, 'approvedListings'])->name('landlord.approved-listings');

        Route::get('/landlord/chat', [App\Http\Controllers\ChatController::class, 'landlordIndex'])->name('landlord.chat');
        Route::post('/landlord/chat/{chatID}/send', [App\Http\Controllers\ChatController::class, 'landlordSendMessage'])->name('landlord.chat.send');
        Route::delete('/landlord/chat/{chatID}', [App\Http\Controllers\ChatController::class, 'landlordDeleteChat'])->name('landlord.chat.delete');
        Route::post('/landlord/chat/{chatID}/accept', [App\Http\Controllers\ChatController::class, 'landlordAcceptChat'])->name('landlord.chat.accept');
        Route::post('/landlord/chat/{chatID}/decline', [App\Http\Controllers\ChatController::class, 'landlordDeclineChat'])->name('landlord.chat.decline');

        Route::get('/landlord/community', function () {
            return view('landlord.community');
        })->name('landlord.community');

        Route::get('/landlord/feedback', [FeedbackController::class, 'userFeedback'])->name('landlord.feedback');
        Route::get('/landlord/feedback/{id}', [FeedbackController::class, 'show'])->name('landlord.feedback.detail');
        Route::get('/landlord/submit-feedback', function () {
            return view('landlord.submit-feedback');
        })->name('landlord.submit-feedback');
        Route::post('/landlord/feedback', [FeedbackController::class, 'store'])->name('landlord.feedback.store');

        Route::get('/landlord/faqs', function () {
            $faqs = \App\Models\Faq::where('user_role', 'Landlord')->where('is_active', true)->get()->groupBy('category');
            return view('landlord.faqs', compact('faqs'));
        })->name('landlord.faqs');

        Route::get('/landlord/create-listing', [App\Http\Controllers\ListingController::class, 'create'])->name('landlord.create-listing');
        Route::post('/landlord/store-listing', [App\Http\Controllers\ListingController::class, 'store'])->name('landlord.store-listing');
        Route::get('/landlord/edit-listing/{id}', [App\Http\Controllers\ListingController::class, 'edit'])->name('landlord.edit-listing');
        Route::put('/landlord/update-listing/{id}', [App\Http\Controllers\ListingController::class, 'update'])->name('landlord.update-listing');


    });

    Route::middleware('role:Admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('dashboards.admin');
        })->name('admin.dashboard');

        Route::get('/admin/home', function () {
            return view('admin.home');
        })->name('admin.home');

        Route::get('/admin/manage-listings', [ListingController::class, 'manageListings'])->name('admin.manage-listings');
        Route::get('/admin/listing/{id}', [ListingController::class, 'showListing'])->name('admin.listing-detail');
        Route::post('/admin/approve-listing/{id}', [ListingController::class, 'approveListing'])->name('admin.approve-listing');
        Route::post('/admin/reject-listing/{id}', [ListingController::class, 'rejectListing'])->name('admin.reject-listing');

        Route::get('/admin/users', function () {
            $users = \App\Models\User::all();
            return view('admin.users', compact('users'));
        })->name('admin.users');

        Route::get('/admin/accommodation', [AccommodationController::class, 'adminIndex'])->name('admin.accommodation');
        Route::get('/admin/accommodation/{id}', [AccommodationController::class, 'adminShow'])->name('admin.accommodation.show');
        Route::post('/admin/accommodation/{id}/approve', [AccommodationController::class, 'approve'])->name('admin.accommodation.approve');
        Route::post('/admin/accommodation/{id}/reject', [AccommodationController::class, 'reject'])->name('admin.accommodation.reject');
        Route::post('/admin/accommodation/{id}/allow-new', [AccommodationController::class, 'allowNew'])->name('admin.accommodation.allow-new');

        Route::get('/admin/feedback', [FeedbackController::class, 'index'])->name('admin.feedback');
        Route::get('/admin/feedback/{id}', [FeedbackController::class, 'show'])->name('admin.feedback.show');
        Route::post('/admin/feedback/{id}/status', [FeedbackController::class, 'updateStatus'])->name('admin.feedback.update-status');

        Route::get('/admin/faqs', [FaqController::class, 'index'])->name('admin.faqs.index');
        Route::get('/admin/faqs/create', [FaqController::class, 'create'])->name('admin.faqs.create');
        Route::post('/admin/faqs', [FaqController::class, 'store'])->name('admin.faqs.store');
        Route::get('/admin/faqs/{faq}/edit', [FaqController::class, 'edit'])->name('admin.faqs.edit');
        Route::put('/admin/faqs/{faq}', [FaqController::class, 'update'])->name('admin.faqs.update');
        Route::delete('/admin/faqs/{faq}', [FaqController::class, 'destroy'])->name('admin.faqs.destroy');
        Route::post('/admin/faqs/{faq}/toggle', [FaqController::class, 'toggle'])->name('admin.faqs.toggle');

        Route::get('/admin/community', function () {
            return view('admin.community');
        })->name('admin.community');

        Route::get('/admin/complaint', [App\Http\Controllers\ComplaintController::class, 'index'])->name('admin.complaint');
        Route::get('/admin/complaint/{id}', [App\Http\Controllers\ComplaintController::class, 'show'])->name('admin.complaint.detail');
        Route::patch('/admin/complaint/{id}/status', [App\Http\Controllers\ComplaintController::class, 'updateStatus'])->name('admin.complaint.update-status');
    });
}); 