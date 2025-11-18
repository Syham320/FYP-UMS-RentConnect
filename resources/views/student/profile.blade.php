@extends('layouts.student')

@section('head')
@parent
<link rel="stylesheet" href="{{ asset('css/student/profile.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('student-content')
<div class="profile-container">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-center">
                @if(Auth::user()->profileImg)
                    <img src="{{ asset('storage/' . Auth::user()->profileImg) }}" alt="Profile" class="profile-avatar">
                @else
                    <div class="profile-avatar bg-gray-400 flex items-center justify-center">
                        <span class="text-4xl text-white font-bold">{{ substr(Auth::user()->userName, 0, 1) }}</span>
                    </div>
                @endif
                <div class="ml-6">
                    <h1 class="profile-name">{{ Auth::user()->userName }}</h1>
                    <p class="profile-role">{{ Auth::user()->role }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Stats -->
    <div class="container mx-auto px-4 -mt-8 relative z-10">
        <div class="profile-stats">
            <div class="stat-card">
                <div class="stat-number">12</div>
                <div class="stat-label">RENTAL REQUESTS</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">8</div>
                <div class="stat-label">BOOKMARKS</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">5</div>
                <div class="stat-label">REVIEWS</div>
            </div>
        </div>
    </div>

    <!-- Profile Details -->
    <div class="container mx-auto px-4 mt-8">
        <div class="profile-details">
            <div class="detail-section">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Personal Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="detail-label">Full Name</div>
                        <div class="detail-value">{{ Auth::user()->userName }}</div>
                    </div>
                    <div>
                        <div class="detail-label">Email Address</div>
                        <div class="detail-value">{{ Auth::user()->userEmail }}</div>
                    </div>
                    <div>
                        <div class="detail-label">Phone Number</div>
                        <div class="detail-value">{{ Auth::user()->contactInfo ?: 'Not provided' }}</div>
                    </div>
                    <div>
                        <div class="detail-label">Role</div>
                        <div class="detail-value">{{ Auth::user()->role }}</div>
                    </div>
                </div>
            </div>

            <div class="detail-section">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Account Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="detail-label">Member Since</div>
                        <div class="detail-value">{{ Auth::user()->created_at->format('F d, Y') }}</div>
                    </div>
                    <div>
                        <div class="detail-label">Last Updated</div>
                        <div class="detail-value">{{ Auth::user()->updated_at->format('F d, Y') }}</div>
                    </div>
                </div>
            </div>

            <!-- Edit Profile Button -->
            <div class="detail-section text-center">
                <a href="{{ route('profile.edit') }}" class="inline-block bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200 transform hover:scale-105">
                    Edit Profile
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
