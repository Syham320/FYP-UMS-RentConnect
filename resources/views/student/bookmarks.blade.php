@extends('layouts.student')

@section('head')
@parent
<link rel="stylesheet" href="{{ asset('css/student/bookmarks.css') }}">
@endsection

@section('student-content')
<div class="bookmarks-container">
    <div class="bookmarks-header">
        <h1 class="bookmarks-title">Bookmarked Listings</h1>
        <div class="bookmarks-count">{{ $bookmarkedListings->count() }} {{ $bookmarkedListings->count() === 1 ? 'item' : 'items' }}</div>
    </div>

    @if($bookmarkedListings->count() > 0)
        <!-- Bookmarks Grid -->
        <div class="bookmarks-grid">
            @foreach($bookmarkedListings as $listing)
                @php
                    $images = is_string($listing->images) ? json_decode($listing->images, true) : $listing->images;
                    $images = is_array($images) ? $images : [];
                    $firstImage = !empty($images) ? $images[0] : null;
                @endphp
                <div class="bookmark-card" data-listing-id="{{ $listing->listingID }}">
                    <div class="bookmark-ribbon">Bookmarked</div>
                    @if($firstImage)
                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($firstImage) }}" alt="{{ $listing->listingTitle }}" class="bookmark-image">
                    @else
                        <img src="https://via.placeholder.com/400x250" alt="No Image" class="bookmark-image">
                    @endif
                    <div class="bookmark-content">
                        <h3 class="bookmark-title">{{ $listing->listingTitle }}</h3>
                        <p class="bookmark-price">RM {{ number_format($listing->price, 2) }}/month</p>
                        <p class="bookmark-location"><i class="fas fa-map-marker-alt mr-1"></i>{{ $listing->location }}</p>
                        <p class="bookmark-room-type"><i class="fas fa-home mr-1"></i>{{ $listing->roomType }}</p>
                        <div class="bookmark-actions">
                            <a href="{{ route('student.home') }}#listing-{{ $listing->listingID }}" class="view-button">View Details</a>
                            <button class="remove-bookmark" data-listing-id="{{ $listing->listingID }}" title="Remove from bookmarks">×</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="empty-bookmarks">
            <div class="empty-icon">❤️</div>
            <h3 class="empty-title">No bookmarked listings yet</h3>
            <p class="empty-description">Start exploring and save your favorite accommodations!</p>
            <a href="{{ route('student.home') }}" class="browse-button">Browse Listings</a>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Remove bookmark functionality
    document.querySelectorAll('.remove-bookmark').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const listingId = this.dataset.listingId;
            const card = this.closest('.bookmark-card');
            const button = this;

            if (!confirm('Are you sure you want to remove this bookmark?')) {
                return;
            }

            // Disable button during request
            button.disabled = true;

            // Send AJAX request to remove bookmark
            fetch(`/student/bookmarks/toggle/${listingId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove card with animation
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.9)';
                    setTimeout(() => {
                        card.remove();
                        
                        // Update count
                        const countElement = document.querySelector('.bookmarks-count');
                        const remainingCards = document.querySelectorAll('.bookmark-card').length;
                        countElement.textContent = `${remainingCards} ${remainingCards === 1 ? 'item' : 'items'}`;
                        
                        // Show empty state if no bookmarks left
                        if (remainingCards === 0) {
                            document.querySelector('.bookmarks-grid').style.display = 'none';
                            const emptyState = document.createElement('div');
                            emptyState.className = 'empty-bookmarks';
                            emptyState.innerHTML = `
                                <div class="empty-icon">❤️</div>
                                <h3 class="empty-title">No bookmarked listings yet</h3>
                                <p class="empty-description">Start exploring and save your favorite accommodations!</p>
                                <a href="{{ route('student.home') }}" class="browse-button">Browse Listings</a>
                            `;
                            document.querySelector('.bookmarks-container').appendChild(emptyState);
                        }
                    }, 300);
                } else {
                    alert(data.message || 'Failed to remove bookmark');
                    button.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error removing bookmark:', error);
                alert('An error occurred while removing bookmark');
                button.disabled = false;
            });
        });
    });
});
</script>
@endsection
