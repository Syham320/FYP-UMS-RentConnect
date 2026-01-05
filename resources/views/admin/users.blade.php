@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Manage Users</h1>

    <!-- Filter Form -->
    <div class="bg-gradient-to-r from-red-50 to-pink-50 p-4 rounded-lg shadow-md mb-6 border border-red-100">
        <div class="flex items-center mb-3">
            <i class="fas fa-filter text-red-600 mr-2"></i>
            <h2 class="text-lg font-semibold text-gray-800">Filter Users</h2>
        </div>
        <form method="GET" action="{{ route('admin.users') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-1">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-search text-gray-400 mr-1"></i>Search
                </label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Name or email..." class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200">
            </div>
            <div class="md:col-span-1">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-user-tag text-gray-400 mr-1"></i>Role
                </label>
                <select name="role" id="role" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200">
                    <option value="">All Roles</option>
                    <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>👑 Admin</option>
                    <option value="Landlord" {{ request('role') == 'Landlord' ? 'selected' : '' }}>🏠 Landlord</option>
                    <option value="Student" {{ request('role') == 'Student' ? 'selected' : '' }}>🎓 Student</option>
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
                <a href="{{ route('admin.users') }}" class="inline-flex items-center justify-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200">
                    <i class="fas fa-times mr-1"></i>Clear
                </a>
            </div>
        </form>
    </div>

    @if(isset($users) && $users->count())
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $user->userName }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->userEmail }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($user->userRole === 'Admin') bg-red-100 text-red-800
                                    @elseif($user->userRole === 'Landlord') bg-green-100 text-green-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ $user->userRole }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->contactInfo ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->created_at?->format('Y-m-d') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white p-8 text-center rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No users found</h3>
            <p class="text-gray-600">There are currently no users in the system.</p>
        </div>
    @endif
</div>
@endsection
