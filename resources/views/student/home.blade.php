@extends('layouts.student')

@section('head')
@parent
<link rel="stylesheet" href="{{ asset('css/student/dashboard.css') }}">
@endsection

@section('student-content')
<div class="dashboard-container">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Available Listings</h1>
    <p class="text-gray-600 text-center mb-8">Browse and find your perfect accommodation.</p>

    <!-- Listings Grid -->
    <div class="dashboard-grid">
        @forelse($listings as $listing)
            @php
                $images = is_string($listing->images) ? json_decode($listing->images, true) : $listing->images;
                $images = is_array($images) ? $images : [];
                $firstImage = !empty($images) ? $images[0] : null;
                $listingData = [
                    'id' => $listing->listingID,
                    'title' => $listing->listingTitle,
                    'price' => $listing->price,
                    'location' => $listing->location,
                    'description' => $listing->listingDescription,
                    'roomType' => $listing->roomType,
                    'contactInfo' => $listing->contactInfo,
                    'images' => $images,
                    'landlord' => [
                        'id' => $listing->user->userID,
                        'name' => $listing->user->userName,
                        'email' => $listing->user->userEmail,
                        'contact' => $listing->user->contactInfo ?? 'N/A'
                    ]
                ];
            @endphp
            <div class="listing-card relative bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300" data-listing='@json($listingData)'>
                <!-- Bookmark Icon -->
                <button class="absolute top-4 right-4 bg-white p-2 rounded-full shadow-md hover:bg-gray-100 transition-colors duration-200 bookmark-btn" data-listing-id="{{ $listing->listingID }}">
                    <i class="fas fa-bookmark text-gray-400 hover:text-blue-500 {{ in_array($listing->listingID, $bookmarkedListings ?? []) ? 'text-blue-500' : '' }}" id="bookmark-icon-{{ $listing->listingID }}"></i>
                </button>

                <!-- Listing Image -->
                <div class="relative">
                    @if($firstImage)
                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($firstImage) }}" alt="Listing Image" class="listing-image w-full h-48 object-cover">
                    @else
                        <img src="https://via.placeholder.com/400x250" alt="No Image" class="listing-image w-full h-48 object-cover">
                    @endif
                </div>

                <!-- Listing Content -->
                <div class="p-4">
                    <h3 class="listing-title text-xl font-semibold text-gray-800 mb-2">{{ $listing->listingTitle }}</h3>
                    <p class="listing-price text-2xl font-bold text-green-600 mb-2">RM {{ number_format($listing->price, 2) }}/month</p>
                    <p class="listing-location text-gray-600 mb-2"><i class="fas fa-map-marker-alt mr-1"></i>{{ $listing->location }}</p>
                    <p class="listing-description text-gray-700 mb-3">{{ Str::limit($listing->listingDescription, 100) }}</p>
                    <p class="text-sm text-gray-500 mb-3"><i class="fas fa-home mr-1"></i>{{ $listing->roomType }}</p>

                    <!-- Landlord Info -->
                    <div class="flex items-center justify-between">
                        <div class="landlord-info flex items-center cursor-pointer" data-landlord-id="{{ $listing->user->userID }}">
                            <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center mr-2">
                                <span class="text-xs text-gray-600">{{ substr($listing->user->userName, 0, 1) }}</span>
                            </div>
                            <span class="text-sm text-gray-600">{{ $listing->user->userName }}</span>
                        </div>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200 submit-request-btn" data-listing-id="{{ $listing->listingID }}">
                            Submit Request
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <i class="fas fa-home text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No Listings Available</h3>
                <p class="text-gray-500">Check back later for new listings.</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Modal for Listing Details -->
<div id="listingModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-4xl w-full max-h-screen overflow-y-auto">
            <div class="relative p-6">
                <button id="closeModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 z-10">
                    <i class="fas fa-times text-xl"></i>
                </button>
                <div id="modalContent">
                    <!-- Content will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Landlord Profile -->
<div id="landlordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold">Landlord Profile</h3>
                    <button id="closeLandlordModal" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div id="landlordContent">
                    <!-- Content will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal functionality
    const listingModal = document.getElementById('listingModal');
    const landlordModal = document.getElementById('landlordModal');
    const closeModal = document.getElementById('closeModal');
    const closeLandlordModal = document.getElementById('closeLandlordModal');

    // Close modals
    closeModal.addEventListener('click', () => listingModal.classList.add('hidden'));
    closeLandlordModal.addEventListener('click', () => landlordModal.classList.add('hidden'));

    // Close on outside click
    listingModal.addEventListener('click', (e) => {
        if (e.target === listingModal) listingModal.classList.add('hidden');
    });
    landlordModal.addEventListener('click', (e) => {
        if (e.target === landlordModal) landlordModal.classList.add('hidden');
    });

    // Listing card click to show details
    document.querySelectorAll('.listing-card').forEach(card => {
        card.addEventListener('click', function(e) {
            // Don't open modal if clicking on buttons
            if (e.target.closest('.bookmark-btn') || e.target.closest('.submit-request-btn') || e.target.closest('.landlord-info')) {
                return;
            }

            const listingId = this.querySelector('.submit-request-btn').dataset.listingId;
            showListingDetails(listingId);
        });
    });

    // Landlord info click
    document.querySelectorAll('.landlord-info').forEach(info => {
        info.addEventListener('click', function() {
            const landlordId = this.dataset.landlordId;
            showLandlordProfile(landlordId);
        });
    });

    // Bookmark functionality
    document.querySelectorAll('.bookmark-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const listingId = this.dataset.listingId;
            const icon = this.querySelector('i');
            const button = this;

            // Disable button during request
            button.disabled = true;

            // Send AJAX request to toggle bookmark
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
                    // Toggle bookmark state based on server response
                    if (data.bookmarked) {
                        icon.classList.remove('text-gray-400');
                        icon.classList.add('text-blue-500');
                    } else {
                        icon.classList.remove('text-blue-500');
                        icon.classList.add('text-gray-400');
                    }
                } else {
                    alert(data.message || 'Failed to toggle bookmark');
                }
            })
            .catch(error => {
                console.error('Error toggling bookmark:', error);
                alert('An error occurred while toggling bookmark');
            })
            .finally(() => {
                // Re-enable button
                button.disabled = false;
            });
        });
    });

    // Submit request functionality
    document.querySelectorAll('.submit-request-btn, .submit-request-modal-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const listingId = this.dataset.listingId;
            const button = this;

            // Disable button during request
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Submitting...';

            // Send AJAX request to submit rental request
            fetch('/student/rental-requests', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    listingID: listingId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message and redirect
                    alert(data.message);
                    window.location.href = '/student/rental-requests';
                } else {
                    alert(data.message || 'Failed to submit rental request');
                }
            })
            .catch(error => {
                console.error('Error submitting rental request:', error);
                alert('An error occurred while submitting the rental request');
            })
            .finally(() => {
                // Re-enable button
                button.disabled = false;
                button.innerHTML = '<i class="fas fa-paper-plane mr-2"></i>Submit Request';
            });
        });
    });
});

function showListingDetails(listingId) {
    const card = document.querySelector(`[data-listing-id="${listingId}"]`);
    if (!card) return;

    const listingData = JSON.parse(card.closest('.listing-card').getAttribute('data-listing'));
    const modalContent = document.getElementById('modalContent');

    let imagesHtml = '';
    if (listingData.images && listingData.images.length > 0) {
        imagesHtml = `
            <div class="mb-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    ${listingData.images.map(image => `
                        <img src="/storage/${image}" alt="Listing Image" class="w-full h-48 object-cover rounded-lg">
                    `).join('')}
                </div>
            </div>
        `;
    } else {
        imagesHtml = `
            <div class="mb-4">
                <img src="https://via.placeholder.com/600x400" alt="No Image" class="w-full h-48 object-cover rounded-lg">
            </div>
        `;
    }

    let carouselHtml = '';
    if (listingData.images && listingData.images.length > 0) {
        carouselHtml = `
            <div class="relative h-96 overflow-hidden rounded-lg">
                <div id="image-carousel" class="flex transition-transform duration-300 ease-in-out">
                    ${listingData.images.map((image, index) => `
                        <img src="/storage/${image}" alt="Listing Image ${index + 1}" class="w-full h-full object-cover flex-shrink-0">
                    `).join('')}
                </div>
                ${listingData.images.length > 1 ? `
                    <button id="prev-btn" class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 transition-all">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button id="next-btn" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 transition-all">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                        ${listingData.images.map((_, index) => `
                            <button class="carousel-dot w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-75 transition-all" data-slide="${index}"></button>
                        `).join('')}
                    </div>
                ` : ''}
            </div>
        `;
    } else {
        carouselHtml = `
            <div class="h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                <i class="fas fa-image text-6xl text-gray-400"></i>
            </div>
        `;
    }

    modalContent.innerHTML = `
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Left Column: Images -->
            <div>
                ${carouselHtml}
            </div>

            <!-- Right Column: Information -->
            <div class="space-y-4">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">${listingData.title}</h3>
                    <p class="text-3xl font-bold text-green-600 mb-4">RM ${parseFloat(listingData.price).toFixed(2)}/month</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-map-marker-alt mr-3 text-blue-500 w-5"></i>
                        <span class="font-medium">${listingData.location}</span>
                    </div>

                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-home mr-3 text-blue-500 w-5"></i>
                        <span class="font-medium">${listingData.roomType}</span>
                    </div>

                    ${listingData.contactInfo ? `
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-phone mr-3 text-blue-500 w-5"></i>
                            <span class="font-medium">${listingData.contactInfo}</span>
                        </div>
                    ` : ''}
                </div>

                <div>
                    <h4 class="font-semibold text-gray-800 mb-2">Description</h4>
                    <p class="text-gray-700 leading-relaxed">${listingData.description}</p>
                </div>

                <div class="border-t pt-4">
                    <button class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition-colors duration-200 font-medium w-full submit-request-modal-btn" data-listing-id="${listingData.id}">
                        <i class="fas fa-paper-plane mr-2"></i>Submit Request
                    </button>
                </div>
            </div>
        </div>
    `;

    // Initialize carousel after setting content
    if (listingData.images && listingData.images.length > 1) {
        initializeCarousel(listingData.images.length);
    }

    document.getElementById('listingModal').classList.remove('hidden');
}

function showLandlordProfile(landlordId) {
    const card = document.querySelector(`[data-landlord-id="${landlordId}"]`);
    if (!card) return;

    const listingData = JSON.parse(card.closest('.listing-card').getAttribute('data-listing'));
    const landlord = listingData.landlord;
    const landlordContent = document.getElementById('landlordContent');

    landlordContent.innerHTML = `
        <div class="text-center">
            <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-4">
                <span class="text-2xl text-blue-600 font-bold">${landlord.name.charAt(0).toUpperCase()}</span>
            </div>
            <h4 class="text-xl font-bold text-gray-800 mb-4">${landlord.name}</h4>
            <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                <div class="flex items-center text-gray-700">
                    <i class="fas fa-envelope mr-3 text-blue-500 w-5"></i>
                    <span class="font-medium">${landlord.email}</span>
                </div>
                ${landlord.contact && landlord.contact !== 'N/A' ? `
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-phone mr-3 text-blue-500 w-5"></i>
                        <span class="font-medium">${landlord.contact}</span>
                    </div>
                ` : ''}
            </div>
        </div>
    `;

    document.getElementById('landlordModal').classList.remove('hidden');
}

function initializeCarousel(totalImages) {
    let currentSlide = 0;
    const carousel = document.getElementById('image-carousel');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const dots = document.querySelectorAll('.carousel-dot');

    function updateCarousel() {
        carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
        dots.forEach((dot, index) => {
            dot.classList.toggle('bg-opacity-100', index === currentSlide);
            dot.classList.toggle('bg-opacity-50', index !== currentSlide);
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalImages;
        updateCarousel();
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalImages) % totalImages;
        updateCarousel();
    }

    function goToSlide(slideIndex) {
        currentSlide = slideIndex;
        updateCarousel();
    }

    // Event listeners
    nextBtn.addEventListener('click', nextSlide);
    prevBtn.addEventListener('click', prevSlide);
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => goToSlide(index));
    });

    // Initialize first dot as active
    updateCarousel();
}
</script>
@endsection
