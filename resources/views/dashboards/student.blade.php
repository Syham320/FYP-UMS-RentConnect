@extends('layouts.default')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Student Dashboard</h1>

        <!-- Profile Card -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                <!-- Profile Picture -->
                <div class="flex-shrink-0">
                    @if(Auth::user()->profileImg)
                        <img src="{{ asset('storage/' . Auth::user()->profileImg) }}" alt="Profile Picture" class="w-32 h-32 rounded-full object-cover border-4 border-blue-500">
                    @else
                        <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center border-4 border-blue-500">
                            <span class="text-4xl text-gray-600">{{ substr(Auth::user()->userName, 0, 1) }}</span>
                        </div>
                    @endif
                </div>

                <!-- User Information -->
                <div class="flex-grow text-center md:text-left">
                    <h2 class="text-3xl font-semibold text-gray-800 mb-4">Welcome, {{ Auth::user()->userName }}!</h2>
                    <div class="space-y-3">
                        <div class="flex flex-col md:flex-row md:items-center">
                            <span class="font-medium text-gray-600 md:w-32">Full Name:</span>
                            <span class="text-gray-800">{{ Auth::user()->userName }}</span>
                        </div>
                        <div class="flex flex-col md:flex-row md:items-center">
                            <span class="font-medium text-gray-600 md:w-32">Email:</span>
                            <span class="text-gray-800">{{ Auth::user()->userEmail }}</span>
                        </div>
                        <div class="flex flex-col md:flex-row md:items-center">
                            <span class="font-medium text-gray-600 md:w-32">Contact:</span>
                            <span class="text-gray-800">{{ Auth::user()->contactInfo ?: 'Not provided' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('profile.edit') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-200 text-center">
                Edit Profile
            </a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-200">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
