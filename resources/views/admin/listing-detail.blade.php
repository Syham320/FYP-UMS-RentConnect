@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('admin.manage-listings') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Manage Listings
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-900">{{ $listing->listingTitle }}</h1>

        </div>

        <div class="p-6">
            <!-- Status Badge -->
            <div class="mb-6">
                @if($listing->availabilityStatus === 'pending')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                        <i class="fas fa-clock mr-1"></i>
                        Pending Approval
                    </span>
                @elseif($listing->availabilityStatus === 'approved')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <i class="fas fa-check mr-1"></i>
                        Approved
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                        <i class="fas fa-times mr-1"></i>
                        Rejected
                    </span>
                @endif
            </div>

            <!-- Main Image at Top -->
            @if($listing->images && count($listing->images) > 0)
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-images mr-2 text-gray-600"></i>
                        Images
                    </h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="relative group cursor-pointer max-w-md mx-auto" onclick="openImageModal(0)">
                            <img src="{{ asset('storage/' . $listing->images[0]) }}" alt="Main Listing Image" class="w-full h-64 object-cover rounded-lg shadow-md border border-gray-200 transition duration-300 group-hover:shadow-lg">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition duration-300 rounded-lg flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-search-plus text-white text-3xl mb-2 opacity-0 group-hover:opacity-100 transition duration-300"></i>
                                    <p class="text-white text-sm opacity-0 group-hover:opacity-100 transition duration-300">Click to view all images</p>
                                </div>
                            </div>
                            @if(count($listing->images) > 1)
                                <div class="absolute bottom-2 right-2 bg-black bg-opacity-75 text-white px-2 py-1 rounded text-xs">
                                    +{{ count($listing->images) - 1 }} more
                                </div>
                            @endif
                        </div>
                        <div class="text-xs text-gray-500 text-center mt-2">
                            Click to view all images ({{ count($listing->images) }} total)
                        </div>
                    </div>
                </div>
            @else
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-images mr-2 text-gray-600"></i>
                        Images
                    </h3>
                    <div class="bg-gray-50 rounded-lg p-8 text-center">
                        <i class="fas fa-image text-gray-400 text-4xl mb-2"></i>
                        <p class="text-gray-500">No images available</p>
                    </div>
                </div>
            @endif

            <!-- Information Sections -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Left Column: Listing Information and Description -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-home mr-2 text-gray-600"></i>
                            Listing Information
                        </h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-sm font-medium text-gray-600">Title</span>
                                <span class="text-sm text-gray-900">{{ $listing->listingTitle }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-sm font-medium text-gray-600">Price</span>
                                <span class="text-sm text-gray-900 font-semibold">RM {{ number_format($listing->price, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-sm font-medium text-gray-600">Location</span>
                                <span class="text-sm text-gray-900">{{ $listing->location }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-sm font-medium text-gray-600">Room Type</span>
                                <span class="text-sm text-gray-900">{{ $listing->roomType }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-sm font-medium text-gray-600">Contact Info</span>
                                <span class="text-sm text-gray-900">{{ $listing->contactInfo ?? 'Not provided' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <h4 class="text-md font-medium text-gray-900 mb-2 flex items-center">
                            <i class="fas fa-file-alt mr-2 text-gray-600"></i>
                            Description
                        </h4>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm text-gray-700 leading-relaxed">{{ $listing->listingDescription }}</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Landlord and Timeline -->
                <div class="space-y-6">
                    <!-- Landlord Information -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-user mr-2 text-gray-600"></i>
                            Landlord Information
                        </h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-sm font-medium text-gray-600">Name</span>
                                <span class="text-sm text-gray-900">{{ $listing->user->userName ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-sm font-medium text-gray-600">Email</span>
                                <span class="text-sm text-gray-900">{{ $listing->user->userEmail ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-sm font-medium text-gray-600">Phone</span>
                                <span class="text-sm text-gray-900">{{ $listing->user->contactInfo ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Image Modal -->
            <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50" style="display: none;">
                <div class="relative max-w-4xl max-h-screen p-4">
                    <button onclick="closeImageModal()" class="absolute top-2 right-2 text-white text-2xl hover:text-gray-300 z-60">
                        <i class="fas fa-times"></i>
                    </button>
                    <button onclick="prevImage()" class="absolute left-2 top-1/2 transform -translate-y-1/2 text-white text-2xl hover:text-gray-300 z-60">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button onclick="nextImage()" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-white text-2xl hover:text-gray-300 z-60">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <img id="modalImage" src="" alt="Full Size Image" class="max-w-full max-h-full object-contain rounded-lg">
                    <div class="text-white text-center mt-2" id="imageCounter"></div>
                </div>
            </div>



            <!-- Actions -->
            @if($listing->availabilityStatus === 'pending')
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-cogs mr-2 text-gray-600"></i>
                        Actions
                    </h3>
                    <div class="flex space-x-4">
                        <form method="POST" action="{{ route('admin.approve-listing', $listing->listingID) }}" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-300 shadow-md hover:shadow-lg">
                                <i class="fas fa-check mr-2"></i>
                                Approve Listing
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.reject-listing', $listing->listingID) }}" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition duration-300 shadow-md hover:shadow-lg">
                                <i class="fas fa-times mr-2"></i>
                                Reject Listing
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
let currentImageIndex = 0;
let images = @json($listing->images ?? []);

function openImageModal(index) {
    currentImageIndex = index;
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const imageCounter = document.getElementById('imageCounter');

    modalImage.src = '{{ asset('storage/') }}/' + images[currentImageIndex];
    imageCounter.textContent = (currentImageIndex + 1) + ' of ' + images.length;
    modal.style.display = 'flex';
}

function closeImageModal() {
    document.getElementById('imageModal').style.display = 'none';
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % images.length;
    updateModalImage();
}

function prevImage() {
    currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
    updateModalImage();
}

function updateModalImage() {
    const modalImage = document.getElementById('modalImage');
    const imageCounter = document.getElementById('imageCounter');

    modalImage.src = '{{ asset('storage/') }}/' + images[currentImageIndex];
    imageCounter.textContent = (currentImageIndex + 1) + ' of ' + images.length;
}

// Close modal when clicking outside the image
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    if (document.getElementById('imageModal').style.display === 'flex') {
        if (e.key === 'ArrowRight') {
            nextImage();
        } else if (e.key === 'ArrowLeft') {
            prevImage();
        } else if (e.key === 'Escape') {
            closeImageModal();
        }
    }
});
</script>
@endsection
