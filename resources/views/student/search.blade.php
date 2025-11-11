@extends('layouts.student')

@section('head')
@parent
<link rel="stylesheet" href="{{ asset('css/student/search.css') }}">
@endsection

@section('student-content')
<div class="container mx-auto px-4">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Search & Filters</h1>

    <!-- Search and Filters -->
    <div class="search-container">
        <div class="mb-6">
            <input type="text" placeholder="Search for accommodations..." class="search-input">
        </div>

        <div class="filters-grid">
            <div class="filter-group">
                <label class="filter-label">Location</label>
                <select class="filter-select">
                    <option value="">All Locations</option>
                    <option value="kota-kinabalu">Kota Kinabalu</option>
                    <option value="sandakan">Sandakan</option>
                    <option value="tawau">Tawau</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">Price Range</label>
                <select class="filter-select">
                    <option value="">Any Price</option>
                    <option value="0-500">RM 0 - RM 500</option>
                    <option value="500-1000">RM 500 - RM 1000</option>
                    <option value="1000+">RM 1000+</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">Room Type</label>
                <select class="filter-select">
                    <option value="">All Types</option>
                    <option value="single">Single Room</option>
                    <option value="shared">Shared Room</option>
                    <option value="apartment">Apartment</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label">Amenities</label>
                <select class="filter-select">
                    <option value="">Any Amenities</option>
                    <option value="wifi">WiFi</option>
                    <option value="parking">Parking</option>
                    <option value="laundry">Laundry</option>
                </select>
            </div>
        </div>

        <div class="text-center mt-6">
            <button class="search-button">Search Listings</button>
        </div>
    </div>

    <!-- Results Header -->
    <div class="results-header">
        <div class="results-count">Showing 12 results</div>
        <select class="sort-select">
            <option value="newest">Newest First</option>
            <option value="price-low">Price: Low to High</option>
            <option value="price-high">Price: High to Low</option>
        </select>
    </div>

    <!-- Search Results -->
    <div class="dashboard-grid">
        <!-- Sample Result Card -->
        <div class="listing-card">
            <img src="https://via.placeholder.com/400x250" alt="Listing" class="listing-image">
            <div class="listing-content">
                <h3 class="listing-title">Modern Student Apartment</h3>
                <p class="listing-price">RM 650/month</p>
                <p class="listing-location">Kota Kinabalu, Near UMS</p>
                <p class="listing-description">Fully furnished apartment with modern amenities, perfect for students.</p>
            </div>
        </div>

        <div class="listing-card">
            <img src="https://via.placeholder.com/400x250" alt="Listing" class="listing-image">
            <div class="listing-content">
                <h3 class="listing-title">Shared Room</h3>
                <p class="listing-price">RM 350/month</p>
                <p class="listing-location">UMS Campus Area</p>
                <p class="listing-description">Clean shared room in a student house with all utilities included.</p>
            </div>
        </div>

        <div class="listing-card">
            <img src="https://via.placeholder.com/400x250" alt="Listing" class="listing-image">
            <div class="listing-content">
                <h3 class="listing-title">Condo Unit</h3>
                <p class="listing-price">RM 850/month</p>
                <p class="listing-location">City Center</p>
                <p class="listing-description">Luxury condo with gym, pool, and security. Great location.</p>
            </div>
        </div>
    </div>

    <!-- No Results State (hidden by default) -->
    <div class="no-results" style="display: none;">
        <div class="no-results-icon">🔍</div>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">No listings found</h3>
        <p class="text-gray-600">Try adjusting your search criteria or filters.</p>
    </div>
</div>
@endsection
