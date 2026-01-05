@extends('layouts.landlord')

@section('landlord-content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Community & Forum</h1>
    <p class="text-gray-600 text-center mb-8">Connect with other landlords, share property management tips, and discuss rental strategies.</p>

    <!-- Create Post Button -->
    <div class="mb-6 text-right">
        <a href="#" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200">
            <i class="fas fa-plus mr-2"></i>Create New Post
        </a>
    </div>

    <!-- Categories -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Categories</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition duration-200">
                <h3 class="font-bold text-lg text-blue-600">Property Management</h3>
                <p class="text-gray-600">Tips on managing properties and tenant relations.</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition duration-200">
                <h3 class="font-bold text-lg text-green-600">Legal & Regulations</h3>
                <p class="text-gray-600">Discuss rental laws and compliance issues.</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition duration-200">
                <h3 class="font-bold text-lg text-purple-600">Market Trends</h3>
                <p class="text-gray-600">Talk about rental market trends and pricing.</p>
            </div>
        </div>
    </div>

    <!-- Recent Posts -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Recent Posts</h2>
        <div class="space-y-4">
            <!-- Mock Post 1 -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Dealing with difficult tenants</h3>
                        <p class="text-gray-600 mb-4">Strategies for handling problematic tenant situations...</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <span class="mr-4">By: Sarah Wilson</span>
                            <span class="mr-4">1 hour ago</span>
                            <span>3 comments</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Property Management</span>
                    </div>
                </div>
                <div class="mt-4 flex space-x-4">
                    <button class="text-blue-600 hover:text-blue-800">View Post</button>
                    <button class="text-gray-600 hover:text-gray-800">Comment</button>
                    <button class="text-red-600 hover:text-red-800">Report</button>
                </div>
            </div>

            <!-- Mock Post 2 -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">New rental regulations update</h3>
                        <p class="text-gray-600 mb-4">What are your thoughts on the recent changes...</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <span class="mr-4">By: Robert Chen</span>
                            <span class="mr-4">5 hours ago</span>
                            <span>7 comments</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Legal & Regulations</span>
                    </div>
                </div>
                <div class="mt-4 flex space-x-4">
                    <button class="text-blue-600 hover:text-blue-800">View Post</button>
                    <button class="text-gray-600 hover:text-gray-800">Comment</button>
                    <button class="text-red-600 hover:text-red-800">Report</button>
                </div>
            </div>

            <!-- Mock Post 3 -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Rental pricing strategies</h3>
                        <p class="text-gray-600 mb-4">How do you determine competitive rental prices...</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <span class="mr-4">By: Lisa Martinez</span>
                            <span class="mr-4">1 day ago</span>
                            <span>9 comments</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs">Market Trends</span>
                    </div>
                </div>
                <div class="mt-4 flex space-x-4">
                    <button class="text-blue-600 hover:text-blue-800">View Post</button>
                    <button class="text-gray-600 hover:text-gray-800">Comment</button>
                    <button class="text-red-600 hover:text-red-800">Report</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Announcements Section -->
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8">
        <h3 class="text-lg font-semibold text-yellow-800 mb-2">Official Announcements</h3>
        <p class="text-yellow-700">Important updates on property tax changes. Check admin announcements for full details.</p>
    </div>
</div>
@endsection
