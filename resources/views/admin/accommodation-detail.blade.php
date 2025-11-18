@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header with Back Button -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.accommodation') }}" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Accommodation List
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Accommodation Registration Details</h1>
            </div>
        </div>

        <!-- Accommodation Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-900">{{ $accommodation->fullName }}</h2>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 text-sm font-medium rounded-full
                            @if($accommodation->status === 'approved') bg-green-100 text-green-800
                            @elseif($accommodation->status === 'rejected') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800 @endif">
                            {{ ucfirst($accommodation->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="px-6 py-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Student Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">
                            <i class="fas fa-user mr-2"></i>Student Information
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Student Name</label>
                                <p class="text-sm text-gray-900">{{ $accommodation->student->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                                <p class="text-sm text-gray-900">{{ $accommodation->fullName }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Matric Number</label>
                                <p class="text-sm text-gray-900">{{ $accommodation->matricNumber }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Accommodation Details -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">
                            <i class="fas fa-home mr-2"></i>Accommodation Details
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Address</label>
                                <p class="text-sm text-gray-900">{{ $accommodation->address }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Landlord Name</label>
                                <p class="text-sm text-gray-900">{{ $accommodation->landlordName }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Rental Type</label>
                                <p class="text-sm text-gray-900">{{ $accommodation->rentalType }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Submitted Date</label>
                                <p class="text-sm text-gray-900">{{ $accommodation->submittedDate->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Documents -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">
                        <i class="fas fa-file-alt mr-2"></i>Documents
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rental Agreement</label>
                            @if($accommodation->rentalAgreement)
                                <a href="{{ Storage::url($accommodation->rentalAgreement) }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <i class="fas fa-eye mr-2"></i>View Document
                                </a>
                            @else
                                <p class="text-sm text-gray-500">Not provided</p>
                            @endif
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Payment Proof</label>
                            @if($accommodation->paymentProof)
                                <a href="{{ Storage::url($accommodation->paymentProof) }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <i class="fas fa-eye mr-2"></i>View Document
                                </a>
                            @else
                                <p class="text-sm text-gray-500">Not provided</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                @if($accommodation->status === 'pending')
                <div class="border-t border-gray-200 pt-6 mt-6">
                    <div class="flex justify-end space-x-2">
                        <form method="POST" action="{{ route('admin.accommodation.approve', $accommodation->registrationID) }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                                <i class="fas fa-check mr-2"></i>Approve
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.accommodation.reject', $accommodation->registrationID) }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                                <i class="fas fa-times mr-2"></i>Reject
                            </button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
