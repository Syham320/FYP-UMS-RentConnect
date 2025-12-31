@extends('layouts.student')

@section('student-content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">My Accommodation Registrations</h1>
    <p class="text-gray-600 text-center mb-8">Manage your accommodation registration forms and track their approval status.</p>

    @php
        $hasApproved = $accommodations->where('status', 'approved')->where('admin_allowed_new', false)->count() > 0;
    @endphp

    @if(!$hasApproved)
        <div class="mb-8 text-center space-x-4">
            <a href="{{ route('student.accommodation.create') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300 text-lg inline-block">
                Submit Manual Accommodation
            </a>
            <span class="text-gray-600">or</span>
            <a href="{{ route('student.rental-requests') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300 text-lg inline-block">
                Submit Verified Accommodation
            </a>
        </div>
    @else
        <div class="mb-8 text-center">
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 inline-block">
                <p class="text-yellow-800 font-medium">You have an approved accommodation registration.</p>
                <p class="text-yellow-700 text-sm">You cannot submit another accommodation registration unless it is declined or approved for a new semester by an admin.</p>
            </div>
        </div>
    @endif

    @if($accommodations->count() > 0)
        <div class="space-y-4">
            @foreach($accommodations as $accommodation)
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ $accommodation->fullName }}</h3>
                            <p class="text-sm text-gray-600">Submitted on: {{ $accommodation->submittedDate->format('F d, Y') }}</p>
                            @if($accommodation->status == 'approved')
                                <p class="text-green-600 font-semibold mt-2">You are officially a Non-Residential Student!</p>
                            @endif
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($accommodation->status == 'approved') bg-green-100 text-green-800
                            @elseif($accommodation->status == 'rejected') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800 @endif">
                            {{ ucfirst($accommodation->status) }}
                        </span>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('student.accommodation.show', $accommodation->registrationID) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Details</a>
                        @if($accommodation->rentalRequestID)
                            <span class="text-green-600 text-sm font-medium ml-4">Verified</span>
                        @else
                            <span class="text-gray-600 text-sm font-medium ml-4">Manual</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-lg p-6">
            <p class="text-gray-500">You haven't registered any accommodations yet.</p>
        </div>
    @endif
</div>
@endsection
