@extends('layouts.admin')

@section('head')
@parent
<link rel="stylesheet" href="{{ asset('css/admin/profile.css') }}">
@endsection

@section('admin-content')
<div class="container mx-auto">
    <!-- Welcome Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Admin Dashboard</h1>
        <p class="text-gray-600">Welcome back, {{ Auth::user()->userName }}!</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-semibold uppercase">Total Users</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ \App\Models\User::count() }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <i class="fas fa-users text-blue-500 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Listings Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-semibold uppercase">Total Listings</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ \App\Models\Listing::count() }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-home text-green-500 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Pending Listings Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-semibold uppercase">Pending Approval</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ \App\Models\Listing::where('availabilityStatus', 'pending')->count() }}</p>
                </div>
                <div class="bg-yellow-100 rounded-full p-3">
                    <i class="fas fa-clock text-yellow-500 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Approved Listings Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-semibold uppercase">Approved</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ \App\Models\Listing::where('availabilityStatus', 'approved')->count() }}</p>
                </div>
                <div class="bg-purple-100 rounded-full p-3">
                    <i class="fas fa-check-circle text-purple-500 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('admin.manage-listings') }}" class="bg-gradient-to-br from-red-500 to-orange-600 text-white p-6 rounded-lg shadow-md hover:shadow-xl transition-all transform hover:scale-105">
            <div class="flex items-center space-x-4">
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-list text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-1">Manage Listings</h3>
                    <p class="text-sm opacity-90">Approve or reject pending listings</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.users') }}" class="bg-gradient-to-br from-green-500 to-green-600 text-white p-6 rounded-lg shadow-md hover:shadow-xl transition-all transform hover:scale-105">
            <div class="flex items-center space-x-4">
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-users text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-1">Manage Users</h3>
                    <p class="text-sm opacity-90">View and manage user accounts</p>
                </div>
            </div>
        </a>

        <a href="{{ route('profile.edit') }}" class="bg-gradient-to-br from-purple-500 to-purple-600 text-white p-6 rounded-lg shadow-md hover:shadow-xl transition-all transform hover:scale-105">
            <div class="flex items-center space-x-4">
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <i class="fas fa-user text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-1">My Profile</h3>
                    <p class="text-sm opacity-90">View and edit your profile</p>
                </div>
            </div>
        </a>
    </div>

    

    <!-- Recent Activity -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Recent Listings</h2>
        @php
            $recentListings = \App\Models\Listing::with('user')->orderBy('createdDate', 'desc')->take(5)->get();
        @endphp
        
        @if($recentListings->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Landlord</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentListings as $listing)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ Str::limit($listing->listingTitle, 30) }}</div>
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
                                    {{ $listing->createdDate?->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <a href="{{ route('admin.manage-listings') }}" class="text-red-600 hover:text-red-900 font-medium">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 text-center py-4">No listings found</p>
        @endif
    </div>
</div>
@endsection
