@extends('layouts.student')

@section('student-content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">My Accommodation</h1>
    <p class="text-gray-600 text-center mb-8">Manage your accommodation status and submit accommodation forms.</p>

    <!-- Accommodation Status -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Accommodation Status</h2>
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-4 h-4 bg-yellow-500 rounded-full mr-3"></div>
                <span class="text-lg font-medium text-gray-700">No Active Accommodation</span>
            </div>
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                Add Accommodation Form
            </button>
        </div>
        <p class="text-gray-600 mt-2">You currently have no active accommodation. Click the button above to submit an accommodation form.</p>
    </div>

    <!-- Submitted Accommodation Forms -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Submitted Accommodation Forms</h2>

        <!-- If no forms submitted -->
        <div class="text-center py-8">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No accommodation forms submitted</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by submitting your first accommodation form.</p>
            <div class="mt-6">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                    Submit Accommodation Form
                </button>
            </div>
        </div>

        <!-- Mockup of submitted forms (uncomment when forms are submitted) -->
<!--         
        <div class="space-y-4">
            <div class="border border-gray-200 rounded-lg p-4">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Accommodation Form #001</h3>
                        <p class="text-sm text-gray-600">Submitted on: October 15, 2023 at 2:30 PM</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        Under Review
                    </span>
                </div>
                <p class="text-sm text-gray-600">Preferred location: Near UMS Campus, Kota Kinabalu</p>
                <div class="mt-3">
                    <button class="text-blue-600 hover:text-blue-500 text-sm font-medium">View Details</button>
                </div>
            </div>
        </div> -->
       
    </div>

    <!-- Information Section -->
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">
                    Accommodation Process
                </h3>
                <div class="mt-2 text-sm text-blue-700">
                    <p>1. Submit your non-resident declaration form with required documents.</p>
                    <p>2. University administration will review and approve your status.</p>
                    <p>3. Once approved, you'll be eligible to access off-campus rental listings.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
