@extends('layouts.landlord')

@section('landlord-content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Create New Listing</h1>
    <form action="{{ route('landlord.store-listing') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-lg p-8">
        @csrf
        <div class="mb-4">
            <label for="listingTitle" class="block text-gray-700 font-bold mb-2">Listing Title</label>
            <input type="text" name="listingTitle" id="listingTitle" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="listingDescription" class="block text-gray-700 font-bold mb-2">Description</label>
            <textarea name="listingDescription" id="listingDescription" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
        </div>
        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-bold mb-2">Price (RM)</label>
            <input type="number" step="0.01" name="price" id="price" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="location" class="block text-gray-700 font-bold mb-2">Location</label>
            <input type="text" name="location" id="location" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="contactInfo" class="block text-gray-700 font-bold mb-2">Contact Info</label>
            <input type="text" name="contactInfo" id="contactInfo" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-4">
            <label for="roomType" class="block text-gray-700 font-bold mb-2">Room Type</label>
            <select name="roomType" id="roomType" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="Single">Single</option>
                <option value="Shared">Shared</option>
                <option value="Studio">Studio</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="images" class="block text-gray-700 font-bold mb-2">Images (Select multiple)</label>
            <input type="file" name="images[]" id="images" multiple accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <button type="submit" class="w-full bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600">Create Listing</button>
    </form>
</div>
@endsection
