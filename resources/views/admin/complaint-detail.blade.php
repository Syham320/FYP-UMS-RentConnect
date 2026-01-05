@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header with Back Button -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.complaint') }}" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Complaints
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Complaint Details</h1>
            </div>
        </div>

        <!-- Complaint Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-900">{{ $complaint->complaintCategory }}</h2>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 text-sm font-medium rounded-full
                            @if($complaint->complaintStatus === 'pending') bg-gray-100 text-gray-800
                            @elseif($complaint->complaintStatus === 'In review') bg-yellow-100 text-yellow-800
                            @else bg-green-100 text-green-800 @endif">
                            {{ $complaint->complaintStatus }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="px-6 py-6">
                <div class="grid grid-cols-1 gap-6 mb-6">
                    <!-- Complaint Details -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">
                            <i class="fas fa-info-circle mr-2"></i>Complaint Details
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Category</label>
                                <span class="px-2 py-1 text-sm font-medium rounded-full
                                    @if($complaint->complaintCategory === 'Safety') bg-red-100 text-red-800
                                    @elseif($complaint->complaintCategory === 'Fraud') bg-orange-100 text-orange-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ $complaint->complaintCategory }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Submitted By</label>
                                <p class="text-sm text-gray-900">{{ $complaint->user->userName }} </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Submitted</label>
                                <p class="text-sm text-gray-900">{{ $complaint->submittedDate->format('M d, Y \a\t H:i') }}</p>
                            </div>
                            @if($complaint->complaintFile)
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Attachment</label>
                                <a href="{{ asset('storage/' . $complaint->complaintFile) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">
                                    <i class="fas fa-paperclip mr-1"></i>View Attachment
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Complaint Description -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">
                        <i class="fas fa-comment mr-2"></i>Description
                    </h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $complaint->complaintDescription }}</p>
                    </div>
                </div>

                <!-- Status Update Form -->
                <div class="border-t border-gray-200 pt-6 mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">
                        <i class="fas fa-edit mr-2"></i>Update Status
                    </h3>
                    <form method="POST" action="{{ route('admin.complaint.update-status', $complaint->complaintID) }}" class="flex items-center space-x-4">
                        @csrf
                        @method('PATCH')
                        <div class="flex-1">
                            <select name="complaintStatus" id="complaintStatus" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                                <option value="pending" {{ $complaint->complaintStatus === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="In review" {{ $complaint->complaintStatus === 'In review' ? 'selected' : '' }}>In Review</option>
                                <option value="Resolved" {{ $complaint->complaintStatus === 'Resolved' ? 'selected' : '' }}>Resolved</option>
                            </select>
                        </div>
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                            Update Status
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
