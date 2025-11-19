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
                <h1 class="text-3xl font-bold text-gray-900">Edit FAQ</h1>
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
                <h2 class="text-xl font-semibold text-gray-900">Edit FAQ</h2>
            </div>

            <!-- Content -->
            <div class="px-6 py-6">
                <form method="POST" action="{{ route('admin.faqs.update', $faq) }}">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="user_role" class="block text-sm font-medium text-gray-700">User Role</label>
                                <select name="user_role" id="user_role" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="Student" {{ $faq->user_role === 'Student' ? 'selected' : '' }}>Student</option>
                                    <option value="Landlord" {{ $faq->user_role === 'Landlord' ? 'selected' : '' }}>Landlord</option>
                                </select>
                            </div>
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                <select name="category" id="category" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="Getting Started" {{ $faq->category === 'Getting Started' ? 'selected' : '' }}>Getting Started</option>
                                    <option value="Rental Process" {{ $faq->category === 'Rental Process' ? 'selected' : '' }}>Rental Process</option>
                                    <option value="Property Management" {{ $faq->category === 'Property Management' ? 'selected' : '' }}>Property Management</option>
                                    <option value="Rental Requests" {{ $faq->category === 'Rental Requests' ? 'selected' : '' }}>Rental Requests</option>
                                    <option value="Account & Profile" {{ $faq->category === 'Account & Profile' ? 'selected' : '' }}>Account & Profile</option>
                                    <option value="Documents & Verification" {{ $faq->category === 'Documents & Verification' ? 'selected' : '' }}>Documents & Verification</option>
                                    <option value="Technical Support" {{ $faq->category === 'Technical Support' ? 'selected' : '' }}>Technical Support</option>
                                    <option value="Landlord Communication" {{ $faq->category === 'Landlord Communication' ? 'selected' : '' }}>Landlord Communication</option>
                                    <option value="Safety & Security" {{ $faq->category === 'Safety & Security' ? 'selected' : '' }}>Safety & Security</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="question" class="block text-sm font-medium text-gray-700">Question</label>
                            <input type="text" name="question" id="question" value="{{ old('question', $faq->faqQuestion) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="answer" class="block text-sm font-medium text-gray-700">Answer</label>
                            <textarea name="answer" id="answer" rows="6" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>{{ old('answer', $faq->faqAnswer) }}</textarea>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" {{ $faq->is_active ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_active" class="ml-2 block text-sm text-gray-900">Active</label>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <a href="{{ route('admin.faqs.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200">Cancel</a>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700">Update FAQ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
