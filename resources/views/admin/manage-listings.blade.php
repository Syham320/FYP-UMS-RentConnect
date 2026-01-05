@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Manage Listings</h1>

    <!-- Filter Form -->
    <div class="bg-gradient-to-r from-red-50 to-pink-50 p-4 rounded-lg shadow-md mb-6 border border-red-100">
        <div class="flex items-center mb-3">
            <i class="fas fa-filter text-red-600 mr-2"></i>
            <h2 class="text-lg font-semibold text-gray-800">Filter Listings</h2>
        </div>
        <form method="GET" action="{{ route('admin.manage-listings') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-1">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-search text-gray-400 mr-1"></i>Search
                </label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Title or landlord..." class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200">
            </div>
            <div class="md:col-span-1">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-info-circle text-gray-400 mr-1"></i>Status
                </label>
                <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>✅ Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>❌ Rejected</option>
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
                <a href="{{ route('admin.manage-listings') }}" class="inline-flex items-center justify-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200">
                    <i class="fas fa-times mr-1"></i>Clear
                </a>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-700 bg-green-100 p-4 rounded">{{ session('success') }}</div>
    @endif

    @if(isset($listings) && $listings->count())
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Landlord</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($listings as $listing)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $listing->listingTitle }}
                                </div>
                                <div class="text-sm text-gray-500">{{ Str::limit($listing->listingDescription, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $listing->user->userName ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($listing->availabilityStatus === 'pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                @elseif($listing->availabilityStatus === 'approved')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $listing->createdDate?->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.listing-detail', $listing->listingID) }}" class="text-blue-600 hover:text-blue-900 mr-4">
                                    <i class="fas fa-eye mr-1"></i>View Detail
                                </a>
                                @if($listing->availabilityStatus === 'pending')
                                    <form method="POST" action="{{ route('admin.approve-listing', $listing->listingID) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-900 mr-2">Approve</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.reject-listing', $listing->listingID) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-900">Reject</button>
                                    </form>
                                @else
                                    <span class="text-gray-500">{{ ucfirst($listing->availabilityStatus) }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white p-8 text-center rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No listings found</h3>
            <p class="text-gray-600">There are currently no listings to manage.</p>
        </div>
    @endif
</div>
@endsection
