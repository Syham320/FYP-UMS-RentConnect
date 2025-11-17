@extends('layouts.admin')

@section('head')
@parent
<link rel="stylesheet" href="{{ asset('css/admin/profile.css') }}">
@endsection

@section('admin-content')
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
                <a href="{{ route('profile.edit') }}" class="inline-block bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200 transform hover:scale-105">
                    Edit Profile
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
