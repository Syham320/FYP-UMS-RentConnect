@extends('layouts.landlord')

@section('landlord-content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Edit Listing</h1>

    @if($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="mb-4 text-green-700">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('landlord.update-listing', $listing->listingID) }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="listingTitle" class="block text-gray-700 font-semibold mb-2">Listing Title</label>
            <input type="text" id="listingTitle" name="listingTitle" value="{{ old('listingTitle', $listing->listingTitle) }}" placeholder="Enter listing title" class="w-full px-3 py-2 border rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="listingDescription" class="block text-gray-700 font-semibold mb-2">Description</label>
            <textarea id="listingDescription" name="listingDescription" placeholder="Enter listing description" class="w-full px-3 py-2 border rounded-lg" rows="4" required>{{ old('listingDescription', $listing->listingDescription) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-semibold mb-2">Price (RM)</label>
            <input type="number" id="price" name="price" value="{{ old('price', $listing->price) }}" step="0.01" placeholder="Enter price" class="w-full px-3 py-2 border rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="location" class="block text-gray-700 font-semibold mb-2">Location</label>
            <input type="text" id="location" name="location" value="{{ old('location', $listing->location) }}" placeholder="Enter location" class="w-full px-3 py-2 border rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="contactInfo" class="block text-gray-700 font-semibold mb-2">Contact Info</label>
            <input type="text" id="contactInfo" name="contactInfo" value="{{ old('contactInfo', $listing->contactInfo) }}" placeholder="Enter contact information" class="w-full px-3 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label for="roomType" class="block text-gray-700 font-semibold mb-2">Room Type</label>
            <select id="roomType" name="roomType" class="w-full px-3 py-2 border rounded-lg" required>
                <option value="">Select room type</option>
                <option value="Single" {{ old('roomType', $listing->roomType) == 'Single' ? 'selected' : '' }}>Single</option>
                <option value="Shared" {{ old('roomType', $listing->roomType) == 'Shared' ? 'selected' : '' }}>Shared</option>
                <option value="Studio" {{ old('roomType', $listing->roomType) == 'Studio' ? 'selected' : '' }}>Studio</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="images" class="block text-gray-700 font-semibold mb-2">Images (Optional - Leave empty to keep current images)</label>
            <input type="file" id="images" name="images[]" multiple accept="image/*" class="w-full px-3 py-2 border rounded-lg">
            <p class="text-sm text-gray-500 mt-1">Select multiple images. Max 2MB per image.</p>
        </div>

        @php
            $images = is_string($listing->images) ? json_decode($listing->images, true) : $listing->images;
            $images = is_array($images) ? $images : [];
        @endphp
        @if($images && count($images) > 0)
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Current Images</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($images as $image)
                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($image) }}" alt="Listing image" class="w-full h-32 object-cover rounded-lg border">
                    @endforeach
                </div>
            </div>
        @endif

        <div class="flex justify-between">
            <a href="{{ route('landlord.my-listings') }}" class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600">Cancel</a>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Update Listing</button>
        </div>
    </form>
</div>
@endsection
