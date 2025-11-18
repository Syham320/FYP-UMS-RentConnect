@extends('layouts.student')

@section('head')
@parent
<link rel="stylesheet" href="{{ asset('css/student/bookmarks.css') }}">
@endsection

@section('student-content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header with Back Button -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('student.accommodation') }}" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Accommodations
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Accommodation Details</h1>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Personal Information</h2>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Full Name</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $accommodation->fullName }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Matric Number</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $accommodation->matricNumber }}</p>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Accommodation Details</h2>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Address</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $accommodation->address }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Landlord Name</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $accommodation->landlordName }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Rental Type</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $accommodation->rentalType }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">Status & Documents</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <span class="mt-1 px-2 py-1 text-xs font-semibold rounded-full
                        @if($accommodation->status == 'approved') bg-green-100 text-green-800
                        @elseif($accommodation->status == 'rejected') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                        {{ ucfirst($accommodation->status) }}
                    </span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Submitted Date</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $accommodation->submittedDate->format('M d, Y') }}</p>
                </div>
            </div>
        </div>

        @if($accommodation->rentalAgreement || $accommodation->paymentProof)
        <div class="mt-6">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">Uploaded Documents</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if($accommodation->rentalAgreement)
                <div>
                    <label class="block text-sm font-medium text-gray-700">Rental Agreement</label>
                    <a href="{{ Storage::disk('public')->url($accommodation->rentalAgreement) }}" target="_blank" class="mt-1 inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                        View Document
                    </a>
                </div>
                @endif
                @if($accommodation->paymentProof)
                <div>
                    <label class="block text-sm font-medium text-gray-700">Payment Proof</label>
                    <a href="{{ Storage::disk('public')->url($accommodation->paymentProof) }}" target="_blank" class="mt-1 inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                        View Document
                    </a>
                </div>
                @endif
            </div>
        </div>
        @endif

    </div>
</div>
@endsection
