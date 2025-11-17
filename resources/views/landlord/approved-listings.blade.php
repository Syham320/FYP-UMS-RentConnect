@extends('layouts.landlord')

@section('landlord-content')
<div class="landlord-approved-page max-w-5xl mx-auto">
    <h1 class="text-4xl font-bold mb-6 text-center text-gray-800">Approved Listings</h1>

    <div class="flex justify-center mb-6">
        <a href="{{ route('landlord.create-listing') }}" class="btn-create-listing">
            <i class="fas fa-plus mr-2"></i>
            Create New Listing
        </a>
    </div>


    @if(session('success'))
        <div class="mb-4 text-center text-green-700">{{ session('success') }}</div>
    @endif

    <p class="text-gray-600 text-center mb-6">This page displays your listings that have been approved.</p>

    @if(isset($listings) && $listings->count())
        <div class="listings-grid">
            @foreach($listings as $listing)
                <div class="listing-card" data-id="{{ $listing->listingID }}">
                    @php
                        // Handle both string (JSON) and array formats for images
                        $images = is_string($listing->images) ? json_decode($listing->images, true) : $listing->images;
                        $images = is_array($images) ? $images : [];
                    @endphp
                    <div class="listing-card-image">
                        @if(count($images) > 0)
                           <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($images[0]) }}" alt="{{ $listing->listingTitle }}" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22%3E%3Crect fill=%22%23ddd%22 width=%22100%22 height=%22100%22/%3E%3C/svg%3E'">
                        @else
                            <div class="no-image-placeholder">No Image</div>
                        @endif
                    </div>
                    <div class="listing-card-content">
                        <h2 class="listing-card-title">{{ $listing->listingTitle }}</h2>
                        <p class="listing-card-description">{{ Str::limit($listing->listingDescription, 140) }}</p>
                        <div class="listing-card-meta">
                            <span class="font-semibold">Price:</span> RM{{ number_format($listing->price, 2) }}
                            <span class="font-semibold">Room:</span> {{ $listing->roomType }}
                        </div>
                        <p class="listing-card-description">
                            <span class="font-semibold">Location:</span> {{ $listing->location }}
                        </p>

                        <div class="listing-card-footer">
                            <div>
                                @if($listing->availabilityStatus === 'pending')
                                    <span class="status-badge status-pending">Pending</span>
                                @elseif($listing->availabilityStatus === 'approved')
                                    <span class="status-badge status-approved">Approved</span>
                                @else
                                    <span class="status-badge status-rejected">{{ ucfirst($listing->availabilityStatus) }}</span>
                                @endif
                            </div>
                            <div class="posted-date">Posted: {{ $listing->createdDate?->format('Y-m-d') }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No approved listings yet</h3>
            <p class="text-gray-600">Once your listings are approved by an administrator they will appear here.</p>
        </div>
    @endif
</div>

{{-- Modal markup (scoped to landlord-approved-page) --}}
<div class="landlord-approved-page">
    <div class="modal" role="dialog" aria-modal="true">
        <div class="modal-content modal-card">
            <div class="modal-header modal-hero">
                <button class="modal-close" aria-label="Close">&times;</button>
                <img src="" alt="Listing image" class="modal-main-image">
            </div>
            <div class="modal-body">
                <h3 class="modal-title">Title</h3>
                <div class="modal-status status-badge"></div>
                <p class="modal-description"></p>
                <div class="modal-details">
                    <div class="modal-detail-item">
                        <div class="modal-detail-label">Price</div>
                        <div class="modal-detail-value modal-price"></div>
                    </div>
                    <div class="modal-detail-item">
                        <div class="modal-detail-label">Room Type</div>
                        <div class="modal-detail-value modal-room"></div>
                    </div>
                    <div class="modal-detail-item">
                        <div class="modal-detail-label">Location</div>
                        <div class="modal-detail-value modal-location"></div>
                    </div>
                    <div class="modal-detail-item">
                        <div class="modal-detail-label">Posted</div>
                        <div class="modal-detail-value modal-created"></div>
                    </div>
                </div>
                <div class="modal-gallery">
                    <h4>All Images</h4>
                    <div class="gallery-thumbnails"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Fullscreen Image Viewer --}}
<div class="landlord-approved-page">
    <div class="image-viewer" role="dialog" aria-modal="true">
        <div class="image-viewer-container">
            <img src="" alt="Full size image" class="image-viewer-main">
            <button class="image-viewer-close" aria-label="Close">&times;</button>
            <button class="image-viewer-nav image-viewer-prev" aria-label="Previous">&lsaquo;</button>
            <button class="image-viewer-nav image-viewer-next" aria-label="Next">&rsaquo;</button>
            <div class="image-viewer-counter"><span class="current">1</span> / <span class="total">1</span></div>
        </div>
    </div>
</div>

@php
    $listingsArray = [];
    if(isset($listings) && $listings->count()){
        $listingsArray = $listings->map(function($listing){
            $imgs = is_string($listing->images) ? json_decode($listing->images, true) : $listing->images;
            $imgs = is_array($imgs) ? $imgs : [];
            return [
                'id' => $listing->listingID,
                'title' => $listing->listingTitle,
                'description' => $listing->listingDescription,
                'price' => number_format($listing->price, 2),
                'roomType' => $listing->roomType,
                'location' => $listing->location,
                'status' => $listing->availabilityStatus,
                'created' => $listing->createdDate?->format('Y-m-d'),
                'images' => $imgs
            ];
        })->toArray();
    }
@endphp

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('css/landlord/approved-listings.css') }}">
@endsection

<script>
document.addEventListener('DOMContentLoaded', function(){
    const LISTINGS = @json($listingsArray);
    const modal = document.querySelector('.landlord-approved-page .modal');
    const modalImage = document.querySelector('.landlord-approved-page .modal-main-image');
    const modalTitle = document.querySelector('.landlord-approved-page .modal-title');
    const modalDescription = document.querySelector('.landlord-approved-page .modal-description');
    const modalPrice = document.querySelector('.landlord-approved-page .modal-price');
    const modalRoom = document.querySelector('.landlord-approved-page .modal-room');
    const modalLocation = document.querySelector('.landlord-approved-page .modal-location');
    const modalCreated = document.querySelector('.landlord-approved-page .modal-created');
    const modalStatus = document.querySelector('.landlord-approved-page .modal-status');
    const galleryThumbnails = document.querySelector('.landlord-approved-page .gallery-thumbnails');
    
    // Fullscreen image viewer
    const imageViewer = document.querySelector('.landlord-approved-page .image-viewer');
    const imageViewerMain = document.querySelector('.landlord-approved-page .image-viewer-main');
    const imageViewerClose = document.querySelector('.landlord-approved-page .image-viewer-close');
    const imageViewerPrev = document.querySelector('.landlord-approved-page .image-viewer-prev');
    const imageViewerNext = document.querySelector('.landlord-approved-page .image-viewer-next');
    const imageViewerCurrent = document.querySelector('.landlord-approved-page .image-viewer-counter .current');
    const imageViewerTotal = document.querySelector('.landlord-approved-page .image-viewer-counter .total');
    
    let currentImages = [];
    let currentImageIndex = 0;

    function openModal(listing){
        modalImage.src = listing.images && listing.images.length ? ('/storage/' + listing.images[0]) : '';
        modalTitle.textContent = listing.title || '';
        modalDescription.textContent = listing.description || '';
        modalPrice.textContent = 'RM' + (listing.price || '0.00');
        modalRoom.textContent = listing.roomType || '';
        modalLocation.textContent = listing.location || '';
        modalCreated.textContent = listing.created || '';
        
        // Update status badge class
        modalStatus.textContent = listing.status ? listing.status.toUpperCase() : '';
        modalStatus.className = 'modal-status status-badge';
        if(listing.status === 'pending'){
            modalStatus.classList.add('status-pending');
        } else if(listing.status === 'approved'){
            modalStatus.classList.add('status-approved');
        } else {
            modalStatus.classList.add('status-rejected');
        }
        
        // Populate gallery thumbnails
        currentImages = listing.images || [];
        galleryThumbnails.innerHTML = '';
        if(currentImages && currentImages.length > 0){
            currentImages.forEach(function(img, idx){
                const thumb = document.createElement('div');
                thumb.className = 'gallery-thumbnail';
                thumb.innerHTML = '<img src="/storage/' + img + '" alt="Gallery image ' + (idx + 1) + '">';
                thumb.addEventListener('click', function(){
                    openImageViewer(idx);
                });
                galleryThumbnails.appendChild(thumb);
            });
        }
        
        modal.classList.add('active');
    }

    function closeModal(){
        modal.classList.remove('active');
    }
    
    function openImageViewer(index){
        currentImageIndex = index;
        imageViewerMain.src = '/storage/' + currentImages[currentImageIndex];
        imageViewerCurrent.textContent = currentImageIndex + 1;
        imageViewerTotal.textContent = currentImages.length;
        imageViewer.classList.add('active');
    }
    
    function closeImageViewer(){
        imageViewer.classList.remove('active');
    }
    
    function nextImage(){
        currentImageIndex = (currentImageIndex + 1) % currentImages.length;
        imageViewerMain.src = '/storage/' + currentImages[currentImageIndex];
        imageViewerCurrent.textContent = currentImageIndex + 1;
    }
    
    function prevImage(){
        currentImageIndex = (currentImageIndex - 1 + currentImages.length) % currentImages.length;
        imageViewerMain.src = '/storage/' + currentImages[currentImageIndex];
        imageViewerCurrent.textContent = currentImageIndex + 1;
    }

    document.querySelectorAll('.landlord-approved-page .listing-card').forEach(function(card){
        card.addEventListener('click', function(e){
            const id = card.getAttribute('data-id');
            const listing = LISTINGS.find(l => String(l.id) === String(id));
            if(listing) openModal(listing);
        });
    });

    document.querySelectorAll('.landlord-approved-page .modal-close').forEach(function(btn){
        btn.addEventListener('click', function(e){
            e.stopPropagation();
            closeModal();
        });
    });

    // close modal when clicking backdrop
    modal.addEventListener('click', function(e){
        if(e.target === this) closeModal();
    });
    
    // Image viewer controls
    imageViewerClose.addEventListener('click', closeImageViewer);
    imageViewerNext.addEventListener('click', nextImage);
    imageViewerPrev.addEventListener('click', prevImage);
    
    // Close viewer when clicking backdrop
    imageViewer.addEventListener('click', function(e){
        if(e.target === this || e.target === imageViewerMain) closeImageViewer();
    });
    
    // Keyboard navigation for image viewer
    document.addEventListener('keydown', function(e){
        if(!imageViewer.classList.contains('active')) return;
        if(e.key === 'ArrowRight') nextImage();
        if(e.key === 'ArrowLeft') prevImage();
        if(e.key === 'Escape') closeImageViewer();
    });
});
</script>
@endsection
