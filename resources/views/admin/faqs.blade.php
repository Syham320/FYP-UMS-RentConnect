@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Manage FAQs</h1>
        <a href="{{ route('admin.faqs.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
            <i class="fas fa-plus mr-2"></i>Add New FAQ
        </a>
    </div>

    <!-- Filter Form -->
    <div class="bg-gradient-to-r from-red-50 to-pink-50 p-4 rounded-lg shadow-md mb-6 border border-red-100">
        <div class="flex items-center mb-3">
            <i class="fas fa-filter text-red-600 mr-2"></i>
            <h2 class="text-lg font-semibold text-gray-800">Filter FAQs</h2>
        </div>
        <form method="GET" action="{{ route('admin.faqs.index') }}" class="grid grid-cols-1 md:grid-cols-6 gap-4">
            <div class="md:col-span-1">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-search text-gray-400 mr-1"></i>Search
                </label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Question or answer..." class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200">
            </div>
            <div class="md:col-span-1">
                <label for="user_role" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-user-tag text-gray-400 mr-1"></i>Role
                </label>
                <select name="user_role" id="user_role" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200">
                    <option value="">All Roles</option>
                    <option value="Student" {{ request('user_role') == 'Student' ? 'selected' : '' }}>🎓 Student</option>
                    <option value="Landlord" {{ request('user_role') == 'Landlord' ? 'selected' : '' }}>🏠 Landlord</option>
                </select>
            </div>
            <div class="md:col-span-1">
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-folder text-gray-400 mr-1"></i>Category
                </label>
                <select name="category" id="category" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200">
                    <option value="">All Categories</option>
                    <option value="Getting Started" {{ request('category') == 'Getting Started' ? 'selected' : '' }}>🚀 Getting Started</option>
                    <option value="Rental Process" {{ request('category') == 'Rental Process' ? 'selected' : '' }}>📋 Rental Process</option>
                    <option value="Property Management" {{ request('category') == 'Property Management' ? 'selected' : '' }}>🏢 Property Management</option>
                    <option value="Rental Requests" {{ request('category') == 'Rental Requests' ? 'selected' : '' }}>📝 Rental Requests</option>
                </select>
            </div>
            <div class="md:col-span-1">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-toggle-on text-gray-400 mr-1"></i>Status
                </label>
                <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200">
                    <option value="">All Statuses</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>✅ Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>❌ Inactive</option>
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
                <a href="{{ route('admin.faqs.index') }}" class="inline-flex items-center justify-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-200">
                    <i class="fas fa-times mr-1"></i>Clear
                </a>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-700 bg-green-100 p-4 rounded">{{ session('success') }}</div>
    @endif



    @if($faqs->count())
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Question</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Answer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($faqs as $faq)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($faq->user_role === 'Student') bg-blue-100 text-blue-800
                                    @elseif($faq->user_role === 'Landlord') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $faq->user_role }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($faq->category === 'Getting Started') bg-blue-100 text-blue-800
                                    @elseif($faq->category === 'Rental Process') bg-green-100 text-green-800
                                    @elseif($faq->category === 'Property Management') bg-orange-100 text-orange-800
                                    @elseif($faq->category === 'Rental Requests') bg-purple-100 text-purple-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $faq->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $faq->faqQuestion }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500 truncate max-w-xs">{{ Str::limit($faq->faqAnswer, 80) }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($faq->is_active) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                                    {{ $faq->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.faqs.edit', $faq) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                                <form method="POST" action="{{ route('admin.faqs.toggle', $faq) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-yellow-600 hover:text-yellow-900 mr-2">
                                        {{ $faq->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Are you sure you want to delete this FAQ?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white p-8 text-center rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No FAQs found</h3>
            <p class="text-gray-600">There are currently no FAQs in the system.</p>
        </div>
    @endif
</div>


@endsection
