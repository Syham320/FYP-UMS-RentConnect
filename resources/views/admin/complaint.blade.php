@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Manage User Complaints</h1>

    <!-- Filter Form -->
    <div class="bg-gradient-to-r from-red-50 to-pink-50 p-4 rounded-lg shadow-md mb-6 border border-red-100">
        <div class="flex items-center mb-3">
            <i class="fas fa-filter text-red-600 mr-2"></i>
            <h2 class="text-lg font-semibold text-gray-800">Filter Complaints</h2>
        </div>
        <form method="GET" action="{{ route('admin.complaint') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div class="md:col-span-1">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-search text-gray-400 mr-1"></i>Search
                </label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Description or user..." class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200">
            </div>
            <div class="md:col-span-1">
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-folder text-gray-400 mr-1"></i>Category
                </label>
                <select name="category" id="category" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200">
                    <option value="">All Categories</option>
                    <option value="Safety" {{ request('category') == 'Safety' ? 'selected' : '' }}>🛡️ Safety</option>
                    <option value="Fraud" {{ request('category') == 'Fraud' ? 'selected' : '' }}>⚠️ Fraud</option>
                    <option value="Facilities" {{ request('category') == 'Facilities' ? 'selected' : '' }}>🏢 Facilities</option>
                </select>
            </div>
            <div class="md:col-span-1">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-info-circle text-gray-400 mr-1"></i>Status
                </label>
                <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                    <option value="In review" {{ request('status') == 'In review' ? 'selected' : '' }}>🔍 In Review</option>
                    <option value="Resolved" {{ request('status') == 'Resolved' ? 'selected' : '' }}>✅ Resolved</option>
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
                <a href="{{ route('admin.complaint') }}" class="inline-flex items-center justify-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200">
                    <i class="fas fa-times mr-1"></i>Clear
                </a>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-700 bg-green-100 p-4 rounded">{{ session('success') }}</div>
    @endif

    @if($complaints->count())
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($complaints as $complaint)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $complaint->user ? ($complaint->user->userName ?: 'Unknown User') : 'Unknown User' }}</div>
                                <div class="text-xs text-gray-400">{{ $complaint->user ? ($complaint->user->userRole ?: 'Student') : 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($complaint->complaintCategory === 'Safety') bg-red-100 text-red-800
                                    @elseif($complaint->complaintCategory === 'Fraud') bg-orange-100 text-orange-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ $complaint->complaintCategory }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ Str::limit($complaint->complaintDescription, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($complaint->complaintStatus === 'pending') bg-gray-100 text-gray-800
                                    @elseif($complaint->complaintStatus === 'In review') bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ $complaint->complaintStatus }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $complaint->submittedDate->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.complaint.detail', $complaint->complaintID) }}" class="text-blue-600 hover:text-blue-900 mr-2">
                                    <i class="fas fa-eye mr-1"></i>View Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white p-8 text-center rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No complaints found</h3>
            <p class="text-gray-600">There are currently no user complaint submissions to manage.</p>
        </div>
    @endif
</div>
@endsection
