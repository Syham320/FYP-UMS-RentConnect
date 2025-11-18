@extends('layouts.student')

@section('student-content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">My Rental Requests</h1>
    <p class="text-gray-600 text-center mb-8">Here you can view all your submitted rental requests, including listing details and submission dates.</p>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($requests->count() > 0)
        <div class="space-y-6">
            @foreach($requests as $request)
                <div class="bg-white rounded-lg shadow-lg p-6 border-l-4
                    @if($request->requestStatus == 'pending') border-yellow-500
                    @elseif($request->requestStatus == 'accepted') border-green-500
                    @else border-red-500
                    @endif">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800">{{ $request->listing->listingTitle }}</h2>
                            <p class="text-gray-600">{{ $request->listing->location }}</p>
                            <p class="text-lg font-medium text-green-600">RM {{ number_format($request->listing->price, 2) }}/month</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full
                                @if($request->requestStatus == 'pending') text-yellow-800 bg-yellow-100
                                @elseif($request->requestStatus == 'accepted') text-green-800 bg-green-100
                                @else text-red-800 bg-red-100
                                @endif">
                                {{ ucfirst($request->requestStatus) }}
                            </span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            <p>Submitted on: {{ $request->requestDate ? $request->requestDate->format('F j, Y \a\t g:i A') : 'Date not available' }}</p>
                            <p>Landlord: {{ $request->listing->user->userName }}
                                @if($request->requestStatus == 'pending') - Awaiting approval
                                @elseif($request->requestStatus == 'accepted') - Request accepted
                                @else - Request declined
                                @endif
                            </p>
                            @if($request->requestStatus == 'declined')
                                <p class="text-red-600 text-sm mt-1"><strong>Reason:</strong> The property is not available anymore</p>
                            @endif
                        </div>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded view-details-btn" data-request-id="{{ $request->requestID }}" data-listing-id="{{ $request->listing->listingID }}">
                            View Details
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-file-alt text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No Rental Requests Yet</h3>
            <p class="text-gray-500">You haven't submitted any rental requests. Browse listings to get started!</p>
            <a href="{{ route('student.home') }}" class="inline-block mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded">
                Browse Listings
            </a>
        </div>
    @endif

    <!-- Note about pending status -->
    @if($requests->where('requestStatus', 'pending')->count() > 0)
        <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">
                        Pending Requests
                    </h3>
                    <div class="mt-2 text-sm text-yellow-700">
                        <p>You have {{ $requests->where('requestStatus', 'pending')->count() }} pending rental request(s). You will be notified once a decision is made.</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Pass requests data to JavaScript -->
<script>
    window.requestsData = @json($requests);
</script>

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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal functionality
    const listingModal = document.getElementById('listingModal');
    const closeModal = document.getElementById('closeModal');

    // Close modal
    closeModal.addEventListener('click', () => listingModal.classList.add('hidden'));

    // Close on outside click
    listingModal.addEventListener('click', (e) => {
        if (e.target === listingModal) listingModal.classList.add('hidden');
    });

    // View details button click
    document.querySelectorAll('.view-details-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const listingId = this.dataset.listingId;
            showListingDetails(listingId);
        });
    });
});

function showListingDetails(listingId) {
    // Find the listing data from the page
    const requests = window.requestsData;
    const request = requests.find(r => r.listing.listingID == listingId);
    if (!request) return;

    const listing = request.listing;
    const landlord = listing.user;
    const modalContent = document.getElementById('modalContent');

    let imagesHtml = '';
    const images = Array.isArray(listing.images) ? listing.images : (listing.images ? JSON.parse(listing.images) : []);
    if (images && images.length > 0) {
        imagesHtml = `
            <div class="mb-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    ${images.map(image => `
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
    if (images && images.length > 0) {
        carouselHtml = `
            <div class="relative h-96 overflow-hidden rounded-lg">
                <div id="image-carousel" class="flex transition-transform duration-300 ease-in-out">
                    ${images.map((image, index) => `
                        <img src="/storage/${image}" alt="Listing Image ${index + 1}" class="w-full h-full object-cover flex-shrink-0">
                    `).join('')}
                </div>
                ${images.length > 1 ? `
                    <button id="prev-btn" class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 transition-all">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button id="next-btn" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 transition-all">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                        ${images.map((_, index) => `
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
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">${listing.listingTitle}</h3>
                    <p class="text-3xl font-bold text-green-600 mb-4">RM ${parseFloat(listing.price).toFixed(2)}/month</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-map-marker-alt mr-3 text-blue-500 w-5"></i>
                        <span class="font-medium">${listing.location}</span>
                    </div>

                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-home mr-3 text-blue-500 w-5"></i>
                        <span class="font-medium">${listing.roomType}</span>
                    </div>

                    ${listing.contactInfo ? `
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-phone mr-3 text-blue-500 w-5"></i>
                            <span class="font-medium">${listing.contactInfo}</span>
                        </div>
                    ` : ''}
                </div>

                <div>
                    <h4 class="font-semibold text-gray-800 mb-2">Description</h4>
                    <p class="text-gray-700 leading-relaxed">${listing.listingDescription}</p>
                </div>

                <div class="border-t pt-4">
                        <div class="bg-gray-100 rounded-lg p-4">
                        <h5 class="font-semibold text-gray-800 mb-2">Request Status</h5>
                        <div class="flex items-center">
                            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full mr-3
                                ${request.requestStatus == 'pending' ? 'text-yellow-800 bg-yellow-100' :
                                  request.requestStatus == 'accepted' ? 'text-green-800 bg-green-100' :
                                  'text-red-800 bg-red-100'}">
                                ${request.requestStatus.charAt(0).toUpperCase() + request.requestStatus.slice(1)}
                            </span>
                            <span class="text-sm text-gray-600">
                                Submitted on ${request.requestDate && request.requestDate.date ? new Date(request.requestDate.date).toLocaleDateString('en-US', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric',
                                    hour: '2-digit',
                                    minute: '2-digit'
                                }) : 'Date not available'}
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    `;

    // Initialize carousel after setting content
    if (images && images.length > 1) {
        initializeCarousel(images.length);
    }

    document.getElementById('listingModal').classList.remove('hidden');
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
