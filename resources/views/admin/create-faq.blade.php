@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header with Back Button -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.faqs.index') }}" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-arrow-left mr-2"></i>Back to FAQs
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Create New FAQ</h1>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 text-green-700 bg-green-100 p-4 rounded">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="mb-4 text-red-700 bg-red-100 p-4 rounded">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FAQ Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Create New FAQ</h2>
            </div>

            <!-- Content -->
            <div class="px-6 py-6">
                <form method="POST" action="{{ route('admin.faqs.store') }}">
                    @csrf
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="user_role" class="block text-sm font-medium text-gray-700">User Role</label>
                                <select name="user_role" id="user_role" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="Student">Student</option>
                                    <option value="Landlord">Landlord</option>
                                </select>
                            </div>
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                <select name="category" id="category" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="Getting Started">Getting Started</option>
                                    <option value="Rental Process">Rental Process</option>
                                    <option value="Property Management">Property Management</option>
                                    <option value="Rental Requests">Rental Requests</option>
                                    <option value="Account & Profile">Account & Profile</option>
                                    <option value="Documents & Verification">Documents & Verification</option>
                                    <option value="Technical Support">Technical Support</option>
                                    <option value="Landlord Communication">Landlord Communication</option>
                                    <option value="Safety & Security">Safety & Security</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="question" class="block text-sm font-medium text-gray-700">Question</label>
                            <input type="text" name="question" id="question" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="answer" class="block text-sm font-medium text-gray-700">Answer</label>
                            <textarea name="answer" id="answer" rows="6" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required></textarea>
                        </div>

                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <a href="{{ route('admin.faqs.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200">Cancel</a>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700">Create FAQ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
