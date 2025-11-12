@extends('layouts.landlord')

@section('landlord-content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Approved Listings</h1>
    <div class="mb-6 text-center">
        <a href="{{ route('landlord.create-listing') }}" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600">Create Listings</a>
    </div>
    <p class="text-gray-600 text-center">This page will display your approved rental listings.</p>
    <!-- Placeholder content -->
    <div class="bg-white rounded-lg shadow-lg p-8">
        <p>Feature coming soon...</p>
    </div>
</div>
@endsection
