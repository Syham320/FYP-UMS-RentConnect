@extends('layouts.landlord')

@section('landlord-content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Rental Requests</h1>
    <p class="text-gray-600 text-center mb-8">Here you can view all rental requests for your listings from students.</p>

    <!-- Mockup Rental Requests -->
    <div class="space-y-6">
        <!-- Rental Request 1 -->
        <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-yellow-500">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Cozy Apartment Near UMS Campus</h2>
                    <p class="text-gray-600">Jalan UMS, Kota Kinabalu, Sabah 88400, Malaysia</p>
                    <p class="text-lg font-medium text-green-600">RM 800/month</p>
                </div>
                <div class="text-right">
                    <span class="inline-block px-3 py-1 text-sm font-semibold text-yellow-800 bg-yellow-100 rounded-full">Pending</span>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    <p>Requested by: Ahmad bin Abdullah (Student ID: 12345)</p>
                    <p>Submitted on: October 15, 2023 at 2:30 PM</p>
                    <p>Message: I'm interested in this property for the upcoming semester.</p>
                </div>
                <div class="space-x-2">
                    <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                        Accept
                    </button>
                    <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                        Decline
                    </button>
                </div>
            </div>
        </div>

        <!-- Rental Request 2 -->
        <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-green-500">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Modern Studio in City Center</h2>
                    <p class="text-gray-600">Jalan Tun Fuad Stephens, Kota Kinabalu, Sabah 88000, Malaysia</p>
                    <p class="text-lg font-medium text-green-600">RM 950/month</p>
                </div>
                <div class="text-right">
                    <span class="inline-block px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">Accepted</span>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    <p>Requested by: Siti binti Hassan (Student ID: 12346)</p>
                    <p>Submitted on: October 12, 2023 at 10:15 AM</p>
                    <p>Accepted on: October 13, 2023 at 3:45 PM</p>
                    <p>Message: Looking for a quiet place to study. This seems perfect.</p>
                </div>
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    View Details
                </button>
            </div>
        </div>

        <!-- Rental Request 3 -->
        <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-red-500">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Spacious 2BR House in Likas</h2>
                    <p class="text-gray-600">Jalan Likas, Kota Kinabalu, Sabah 88450, Malaysia</p>
                    <p class="text-lg font-medium text-green-600">RM 1,200/month</p>
                </div>
                <div class="text-right">
                    <span class="inline-block px-3 py-1 text-sm font-semibold text-red-800 bg-red-100 rounded-full">Declined</span>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    <p>Requested by: Muhammad bin Ismail (Student ID: 12347)</p>
                    <p>Submitted on: October 10, 2023 at 4:45 PM</p>
                    <p>Declined on: October 11, 2023 at 9:20 AM</p>
                    <p>Message: Interested in sharing with roommates.</p>
                    <p class="text-red-600 font-medium">Reason: Property already rented</p>
                </div>
                <button class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    View Details
                </button>
            </div>
        </div>

    </div>

    <!-- Note about managing requests -->
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">
                    Managing Rental Requests
                </h3>
                <div class="mt-2 text-sm text-blue-700">
                    <p>Review each request carefully. You can accept or decline requests based on your availability and preferences. Accepted requests will allow students to contact you directly.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
