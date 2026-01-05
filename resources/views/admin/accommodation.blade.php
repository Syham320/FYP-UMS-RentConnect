@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Accommodation Registrations</h1>

    <!-- Filter Form -->
    <div class="bg-gradient-to-r from-red-50 to-pink-50 p-6 rounded-lg shadow-md mb-6 border border-red-200">
        <form method="GET" action="{{ route('admin.accommodation') }}" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-0">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-search mr-1"></i>Search by Matric Number or Student Name
                </label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Enter matric number or name" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
            </div>
            <div class="flex-1 min-w-0">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-filter mr-1"></i>Filter by Status
                </label>
                <select name="status" id="status" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>✅ Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>❌ Rejected</option>
                </select>
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="latest" id="latest" value="1" {{ request('latest') == '1' ? 'checked' : '' }} class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                <label for="latest" class="ml-2 block text-sm text-gray-900">
                    <i class="fas fa-clock mr-1"></i>Latest First
                </label>
            </div>
            <div class="flex gap-2 ml-auto">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <i class="fas fa-filter mr-2"></i>Apply Filters
                </button>
                <a href="{{ route('admin.accommodation') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <i class="fas fa-times mr-2"></i>Clear
                </a>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-700 bg-green-100 p-4 rounded">{{ session('success') }}</div>
    @endif

    @if($accommodations->count() > 0)
        <div class="bg-white shadow-md rounded-lg overflow-hidden overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matric Number</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($accommodations as $accommodation)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $accommodation->fullName }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $accommodation->matricNumber ?: 'Not provided' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($accommodation->status == 'approved') bg-green-100 text-green-800
                                    @elseif($accommodation->status == 'rejected') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                    {{ ucfirst($accommodation->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.accommodation.show', $accommodation->registrationID) }}" class="text-blue-600 hover:text-blue-900 mr-2">
                                    <i class="fas fa-eye mr-1"></i>View Details
                                </a>
                                @if($accommodation->status == 'pending')
                                    <form method="POST" action="{{ route('admin.accommodation.approve', $accommodation->registrationID) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-900 mr-2">
                                            <i class="fas fa-check mr-1"></i>Approve
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.accommodation.reject', $accommodation->registrationID) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-times mr-1"></i>Reject
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500">{{ ucfirst($accommodation->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white p-8 text-center rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No accommodation registrations found</h3>
            <p class="text-gray-600">There are currently no accommodation registrations to manage.</p>
        </div>
    @endif
</div>


@endsection
