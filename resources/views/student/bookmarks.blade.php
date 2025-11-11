@extends('layouts.student')

@section('head')
@parent
<link rel="stylesheet" href="{{ asset('css/student/bookmarks.css') }}">
@endsection

@section('student-content')
<div class="bookmarks-container">
    <div class="bookmarks-header">
        <h1 class="bookmarks-title">Bookmarked Listings</h1>
        <div class="bookmarks-count">8 items</div>
    </div>

    <!-- Bookmarks Grid -->
    <div class="bookmarks-grid">
        <!-- Sample Bookmark Card -->
        <div class="bookmark-card">
            <div class="bookmark-ribbon">Bookmarked</div>
            <img src="https://via.placeholder.com/400x250" alt="Listing" class="bookmark-image">
            <div class="bookmark-content">
                <h3 class="bookmark-title">Modern Student Apartment</h3>
                <p class="bookmark-price">RM 650/month</p>
                <p class="bookmark-location">Kota Kinabalu, Near UMS</p>
                <div class="bookmark-actions">
                    <a href="#" class="view-button">View Details</a>
                    <button class="remove-bookmark" title="Remove from bookmarks">×</button>
                </div>
            </div>
        </div>

        <div class="bookmark-card">
            <div class="bookmark-ribbon">Bookmarked</div>
            <img src="https://via.placeholder.com/400x250" alt="Listing" class="bookmark-image">
            <div class="bookmark-content">
                <h3 class="bookmark-title">Shared Room</h3>
                <p class="bookmark-price">RM 350/month</p>
                <p class="bookmark-location">UMS Campus Area</p>
                <div class="bookmark-actions">
                    <a href="#" class="view-button">View Details</a>
                    <button class="remove-bookmark" title="Remove from bookmarks">×</button>
                </div>
            </div>
        </div>

        <div class="bookmark-card">
            <div class="bookmark-ribbon">Bookmarked</div>
            <img src="https://via.placeholder.com/400x250" alt="Listing" class="bookmark-image">
            <div class="bookmark-content">
                <h3 class="bookmark-title">Condo Unit</h3>
                <p class="bookmark-price">RM 850/month</p>
                <p class="bookmark-location">City Center</p>
                <div class="bookmark-actions">
                    <a href="#" class="view-button">View Details</a>
                    <button class="remove-bookmark" title="Remove from bookmarks">×</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Empty State (hidden by default) -->
    <div class="empty-bookmarks" style="display: none;">
        <div class="empty-icon">❤️</div>
        <h3 class="empty-title">No bookmarked listings yet</h3>
        <p class="empty-description">Start exploring and save your favorite accommodations!</p>
        <a href="{{ route('student.dashboard') }}" class="browse-button">Browse Listings</a>
    </div>
</div>
@endsection
