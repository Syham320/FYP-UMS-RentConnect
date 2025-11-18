@extends('layouts.landlord')

@section('landlord-content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-4xl font-bold mb-6 text-center text-gray-800">My Listings</h1>

    @if(session('success'))
        <div class="mb-4 text-center text-green-700">{{ session('success') }}</div>
    @endif

    <p class="text-gray-600 text-center mb-6">This page displays your approved listings that can be edited.</p>

    @if(isset($listings) && $listings->count())
        <div class="space-y-4">
            @foreach($listings as $listing)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="flex">
                        @php
                            // Handle both string (JSON) and array formats for images
                            $images = is_string($listing->images) ? json_decode($listing->images, true) : $listing->images;
                            $images = is_array($images) ? $images : [];
                        @endphp
                        <div class="w-48 h-32 flex-shrink-0">
                            @if(count($images) > 0)
                                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($images[0]) }}" alt="{{ $listing->listingTitle }}" class="w-full h-full object-cover" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22%3E%3Crect fill=%22%23ddd%22 width=%22100%22 height=%22100%22/%3E%3C/svg%3E'">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500 text-sm">No Image</div>
                            @endif
                        </div>
                        <div class="flex-1 p-4">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $listing->listingTitle }}</h3>
                                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($listing->listingDescription, 100) }}</p>
                                    <div class="grid grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <span class="font-medium text-gray-700">Price:</span> RM{{ number_format($listing->price, 2) }}
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">Room:</span> {{ $listing->roomType }}
                                        </div>
                                        <div class="col-span-2">
                                            <span class="font-medium text-gray-700">Location:</span> {{ $listing->location }}
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-4 flex flex-col items-end space-y-2">
                                    <span class="inline-block px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Approved</span>
                                    <a href="{{ route('landlord.edit-listing', $listing->listingID) }}" class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-600 bg-blue-50 rounded-md hover:bg-blue-100 transition-colors duration-200">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>

                                </div>
                            </div>
                            <div class="mt-3 text-xs text-gray-500">
                                Posted: {{ $listing->createdDate?->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No listings yet</h3>
            <p class="text-gray-600">Create your first listing to get started.</p>
        </div>
    @endif
</div>




@endsection
