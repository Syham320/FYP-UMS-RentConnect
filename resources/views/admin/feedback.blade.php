@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Manage User Feedback</h1>

    <!-- Filter Form -->
    <div class="bg-gradient-to-r from-red-50 to-pink-50 p-4 rounded-lg shadow-md mb-6 border border-red-100">
        <div class="flex items-center mb-3">
            <i class="fas fa-filter text-red-600 mr-2"></i>
            <h2 class="text-lg font-semibold text-gray-800">Filter Feedback</h2>
        </div>
        <form method="GET" action="{{ route('admin.feedback') }}" class="grid grid-cols-1 md:grid-cols-6 gap-4">
            <div class="md:col-span-1">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-search text-gray-400 mr-1"></i>Search
                </label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Subject, text or user..." class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200">
            </div>
            <div class="md:col-span-1">
                <label for="feedbackType" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-tag text-gray-400 mr-1"></i>Type
                </label>
                <select name="feedbackType" id="feedbackType" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200">
                    <option value="">All Types</option>
                    <option value="Suggestion" {{ request('feedbackType') == 'Suggestion' ? 'selected' : '' }}>💡 Suggestion</option>
                    <option value="Complaint" {{ request('feedbackType') == 'Complaint' ? 'selected' : '' }}>😞 Complaint</option>
                    <option value="Bug" {{ request('feedbackType') == 'Bug' ? 'selected' : '' }}>🐛 Bug</option>
                </select>
            </div>
            <div class="md:col-span-1">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-info-circle text-gray-400 mr-1"></i>Status
                </label>
                <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200">
                    <option value="">All Statuses</option>
                    <option value="In Review" {{ request('status') == 'In Review' ? 'selected' : '' }}>🔍 In Review</option>
                    <option value="Resolved" {{ request('status') == 'Resolved' ? 'selected' : '' }}>✅ Resolved</option>
                    <option value="Closed" {{ request('status') == 'Closed' ? 'selected' : '' }}>🔒 Closed</option>
                </select>
            </div>
            <div class="md:col-span-1">
                <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-exclamation-triangle text-gray-400 mr-1"></i>Priority
                </label>
                <select name="priority" id="priority" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200">
                    <option value="">All Priorities</option>
                    <option value="High" {{ request('priority') == 'High' ? 'selected' : '' }}>🔴 High</option>
                    <option value="Medium" {{ request('priority') == 'Medium' ? 'selected' : '' }}>🟡 Medium</option>
                    <option value="Low" {{ request('priority') == 'Low' ? 'selected' : '' }}>🟢 Low</option>
                </select>
            </div>
            <div class="md:col-span-1 flex items-end">
                <div class="flex items-center w-full">
                    <input type="checkbox" name="latest" id="latest" value="1" {{ request('latest') == '1' ? 'checked' : '' }} class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                    <label for="latest" class="ml-2 block text-sm font-medium text-gray-700">
                        <i class="fas fa-clock text-gray-400 mr-1"></i>Latest First
                    </label>
                </div>
            </div>
            <div class="md:col-span-1 flex items-end gap-2 justify-end">
                <button type="submit" class="inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-800 hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200">
                    <i class="fas fa-filter mr-1"></i>Apply
                </button>
                <a href="{{ route('admin.feedback') }}" class="inline-flex items-center justify-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200">
                    <i class="fas fa-times mr-1"></i>Clear
                </a>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-700 bg-green-100 p-4 rounded">{{ session('success') }}</div>
    @endif



    @if($feedbacks->count())
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($feedbacks as $feedback)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $feedback->user->userName }}</div>    
                                <div class="text-xs text-gray-400">{{ $feedback->user->userRole }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($feedback->feedbackType === 'Bug') bg-red-100 text-red-800
                                    @elseif($feedback->feedbackType === 'Suggestion') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $feedback->feedbackType }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $feedback->subject }}</div>
                                <div class="text-sm text-gray-500 truncate max-w-xs">{{ Str::limit($feedback->feedbackText, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($feedback->priority === 'High') bg-red-100 text-red-800
                                    @elseif($feedback->priority === 'Medium') bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ $feedback->priority }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($feedback->status === 'In Review') bg-yellow-100 text-yellow-800
                                    @elseif($feedback->status === 'Resolved') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $feedback->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.feedback.show', $feedback->feedbackID) }}" class="text-blue-600 hover:text-blue-900 mr-2">
                                    <i class="fas fa-eye mr-1"></i>View Details
                                </a>
                                @if($feedback->status !== 'Resolved' && $feedback->status !== 'Closed')
                                    <form method="POST" action="{{ route('admin.feedback.update-status', $feedback->feedbackID) }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="Resolved">
                                        <button type="submit" class="text-green-600 hover:text-green-900">
                                            <i class="fas fa-check mr-1"></i>Resolve
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white p-8 text-center rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No feedback found</h3>
            <p class="text-gray-600">There are currently no user feedback submissions to manage.</p>
        </div>
    @endif
</div>


@endsection
