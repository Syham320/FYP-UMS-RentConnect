@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header with Back Button -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.feedback') }}" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Feedback List
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Feedback Details</h1>
            </div>
        </div>

        <!-- Feedback Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-900">{{ $feedback->subject }}</h2>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 text-sm font-medium rounded-full
                            @if($feedback->status === 'In Review') bg-yellow-100 text-yellow-800
                            @elseif($feedback->status === 'Resolved') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ $feedback->status }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="px-6 py-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- User Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">
                            <i class="fas fa-user mr-2"></i>User Information
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <p class="text-sm text-gray-900">{{ $feedback->user->userName }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <p class="text-sm text-gray-900">{{ $feedback->user->userEmail }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Role</label>
                                <p class="text-sm text-gray-900">{{ $feedback->user->userRole }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Feedback Details -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">
                            <i class="fas fa-info-circle mr-2"></i>Feedback Details
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Type</label>
                                <span class="px-2 py-1 text-sm font-medium rounded-full
                                    @if($feedback->feedbackType === 'Bug') bg-red-100 text-red-800
                                    @elseif($feedback->feedbackType === 'Suggestion') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $feedback->feedbackType }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Priority</label>
                                <span class="px-2 py-1 text-sm font-medium rounded-full
                                    @if($feedback->priority === 'High') bg-red-100 text-red-800
                                    @elseif($feedback->priority === 'Medium') bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ $feedback->priority }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Submitted</label>
                                <p class="text-sm text-gray-900">{{ $feedback->timeStamp->format('M d, Y \a\t H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feedback Message -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">
                        <i class="fas fa-comment mr-2"></i>Message
                    </h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $feedback->feedbackText }}</p>
                    </div>
                </div>

                <!-- Actions -->
                @if($feedback->status !== 'Resolved' && $feedback->status !== 'Closed')
                <div class="border-t border-gray-200 pt-6 mt-6">
                    <div class="flex justify-end">
                        <form method="POST" action="{{ route('admin.feedback.update-status', $feedback->feedbackID) }}" class="inline">
                            @csrf
                            <input type="hidden" name="status" value="Resolved">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                                <i class="fas fa-check mr-2"></i>Mark as Resolved
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
