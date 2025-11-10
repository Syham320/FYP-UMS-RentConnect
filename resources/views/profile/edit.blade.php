@extends('layouts.default')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md relative">
        <!-- Close Button -->
        <button onclick="window.location.href='{{ Auth::user()->userRole === 'Student' ? route('student.dashboard') : (Auth::user()->userRole === 'Landlord' ? route('landlord.dashboard') : route('admin.dashboard')) }}'" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>

        <!-- Current Profile Image Display -->
        <div class="mb-6 text-center">
            @if($user->profileImg)
                <img src="{{ asset('storage/' . $user->profileImg) }}" alt="Current Profile Image" class="w-24 h-24 rounded-full mx-auto mb-2 object-cover">
            @else
                <div class="w-24 h-24 rounded-full mx-auto mb-2 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500">No Image</span>
                </div>
            @endif
        </div>

        <h2 class="text-2xl font-bold mb-6 text-center">Edit Profile</h2>

        @if($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="userName" class="block text-gray-700">Name</label>
                <input type="text" id="userName" name="userName" value="{{ old('userName', $user->userName) }}" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="userEmail" class="block text-gray-700">Email</label>
                <input type="email" id="userEmail" name="userEmail" value="{{ old('userEmail', $user->userEmail) }}" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="contactInfo" class="block text-gray-700">Contact Info</label>
                <input type="text" id="contactInfo" name="contactInfo" value="{{ old('contactInfo', $user->contactInfo) }}" class="w-full px-3 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
                <label for="profileImg" class="block text-gray-700">Change Profile Image</label>
                <input type="file" id="profileImg" name="profileImg" class="w-full px-3 py-2 border rounded-lg" accept="image/*">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Update Profile</button>
        </form>

        <form method="POST" action="{{ route('profile.delete') }}" class="mt-6">
            @csrf
            <button type="submit" class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600" onclick="return confirm('Are you sure you want to delete your account?')">Delete Account</button>
        </form>
    </div>
</div>
@endsection
