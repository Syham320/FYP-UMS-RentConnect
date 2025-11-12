@extends('layouts.landlord')

@section('landlord-content')
<div class="max-w-5xl mx-auto">
    <h1 class="text-4xl font-bold mb-6 text-center text-gray-800">Approved Listings</h1>

    <div class="flex justify-center mb-6">
        <a href="{{ route('landlord.create-listing') }}" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600">Create Listing</a>
    </div>

    @if(session('success'))
        <div class="mb-4 text-center text-green-700">{{ session('success') }}</div>
    @endif

    <p class="text-gray-600 text-center mb-6">This page displays your listings that have been approved.</p>

    @if(isset($listings) && $listings->count())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($listings as $listing)
                <div class="bg-white rounded-lg shadow p-4">
                    @php
                        // Handle both string (JSON) and array formats for images
                        $images = is_string($listing->images) ? json_decode($listing->images, true) : $listing->images;
                        $images = is_array($images) ? $images : [];
                    @endphp
                    <div class="flex">
                        <div class="w-1/3 mr-4">
                            @if(count($images) > 0)
                               <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($images[0]) }}" alt="{{ $listing->listingTitle }}" class="object-cover w-full h-32 rounded" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22%3E%3Crect fill=%22%23ddd%22 width=%22100%22 height=%22100%22/%3E%3C/svg%3E'">
                            @else
                                <div class="bg-gray-100 w-full h-32 rounded flex items-center justify-center text-gray-400">No Image</div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h2 class="text-xl font-semibold mb-1">{{ $listing->listingTitle }}</h2>
                            <p class="text-gray-700 mb-2">{{ Str::limit($listing->listingDescription, 140) }}</p>
                            <div class="text-sm text-gray-600">
                                <span class="mr-3">Price: RM{{ number_format($listing->price, 2) }}</span>
                                <span class="mr-3">Room: {{ $listing->roomType }}</span>
                                <span>Location: {{ $listing->location }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center justify-between">
                        <div>
                            @if($listing->availabilityStatus === 'pending')
                                <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Pending</span>
                            @elseif($listing->availabilityStatus === 'approved')
                                <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Approved</span>
                            @else
                                <span class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded">{{ ucfirst($listing->availabilityStatus) }}</span>
                            @endif
                        </div>
                        <div class="text-sm text-gray-500">Posted: {{ $listing->createdDate?->format('Y-m-d') }}</div>
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
@endsection
