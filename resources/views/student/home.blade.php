@extends('layouts.student')

@section('head')
@parent
<link rel="stylesheet" href="{{ asset('css/student/dashboard.css') }}">
@endsection

@section('student-content')
<div class="dashboard-container">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Available Listings</h1>
    <p class="text-gray-600 text-center mb-8">Browse and find your perfect accommodation.</p>

    <!-- Listings Placeholder -->
    <div class="dashboard-grid">
        <!-- Sample Listing Card -->
        <div class="listing-card">
            <img src="https://via.placeholder.com/400x250" alt="Listing Image" class="listing-image">
            <div class="listing-content">
                <h3 class="listing-title">Sample Room</h3>
                <p class="listing-price">$500/month</p>
                <p class="listing-location">A cozy room in a shared apartment.</p>
                <p class="listing-description">Perfect for students looking for affordable housing.</p>
            </div>
        </div>

        <!-- More sample cards -->
        <div class="listing-card">
            <img src="https://via.placeholder.com/400x250" alt="Listing Image" class="listing-image">
            <div class="listing-content">
                <h3 class="listing-title">Another Room</h3>
                <p class="listing-price">$600/month</p>
                <p class="listing-location">Spacious room with great amenities.</p>
                <p class="listing-description">Modern facilities and convenient location.</p>
            </div>
        </div>

        <div class="listing-card">
            <img src="https://via.placeholder.com/400x250" alt="Listing Image" class="listing-image">
            <div class="listing-content">
                <h3 class="listing-title">Third Room</h3>
                <p class="listing-price">$450/month</p>
                <p class="listing-location">Perfect for students.</p>
                <p class="listing-description">Student-friendly environment with all necessities.</p>
            </div>
        </div>
    </div>
</div>
@endsection
