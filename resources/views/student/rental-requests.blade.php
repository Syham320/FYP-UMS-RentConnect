@extends('layouts.student')

@section('student-content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">My Rental Requests</h1>
    <p class="text-gray-600 text-center mb-8">Here you can view all your submitted rental requests, including listing details and submission dates.</p>

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
                    <p>Submitted on: October 15, 2023 at 2:30 PM</p>
                    <p>Landlord: Ahmad bin Abdullah - Awaiting approval</p>
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
                    <span class="inline-block px-3 py-1 text-sm font-semibold text-red-800 bg-red-100 rounded-full">Rejected</span>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    <p>Submitted on: October 10, 2023 at 4:45 PM</p>
                    <p>Landlord: Muhammad bin Ismail - Request rejected</p>
                    <p class="text-red-600 font-medium">Reason: Property no longer available</p>
                </div>
                <button class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    View Details
                </button>
            </div>
        </div>

    </div>

    <!-- Note about pending status -->
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
                    <p>All rental requests are currently pending landlord approval. You will be notified once a decision is made.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
