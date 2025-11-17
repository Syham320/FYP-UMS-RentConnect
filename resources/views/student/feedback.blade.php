@extends('layouts.student')

@section('student-content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Feedback & Support</h1>
    <p class="text-gray-600 text-center mb-8">Share your feedback and get help with frequently asked questions.</p>

    <!-- Feedback Section -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Share Your Feedback</h2>
        <p class="text-gray-600 mb-6">We value your feedback! Help us improve the UMS Rent Connect platform by sharing your thoughts, suggestions, or reporting any issues you've encountered.</p>

        <div class="text-center">
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300 text-lg">
                Submit Feedback
            </button>
            <p class="text-sm text-gray-500 mt-3">Click here to open the feedback form</p>
        </div>
    </div>

    <!-- Recent Feedback -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Your Recent Feedback</h2>

        <!-- Mockup of submitted feedback -->
        <div class="space-y-4">
            <div class="border border-gray-200 rounded-lg p-4">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">App Performance Issue</h3>
                        <p class="text-sm text-gray-600">Submitted on: October 15, 2023 at 3:45 PM</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        In Review
                    </span>
                </div>
                <p class="text-sm text-gray-600">Type: Bug Report | Priority: Medium</p>
                <p class="text-sm text-gray-700 mt-2">The search functionality is slow when filtering by location...</p>
            </div>

            <div class="border border-gray-200 rounded-lg p-4">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Feature Request: Dark Mode</h3>
                        <p class="text-sm text-gray-600">Submitted on: October 12, 2023 at 11:20 AM</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Resolved
                    </span>
                </div>
                <p class="text-sm text-gray-600">Type: Feature Request | Priority: Low</p>
                <p class="text-sm text-gray-700 mt-2">It would be great to have a dark mode option for better usability at night...</p>
            </div>
        </div>
    </div>

   
@endsection
