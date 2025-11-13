@extends('layouts.default')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>
    <p>Welcome, {{ Auth::user()->userName }}!</p>
    <p>Role: {{ Auth::user()->userRole }}</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('admin.manage-listings') }}" class="bg-blue-500 text-white p-6 rounded-lg shadow-md hover:bg-blue-600 transition">
            <h3 class="text-xl font-semibold mb-2">Manage Listings</h3>
            <p>Approve or reject pending listings</p>
        </a>

        <a href="{{ route('admin.users') }}" class="bg-green-500 text-white p-6 rounded-lg shadow-md hover:bg-green-600 transition">
            <h3 class="text-xl font-semibold mb-2">Manage Users</h3>
            <p>View and manage user accounts</p>
        </a>

        <a href="{{ route('profile.edit') }}" class="bg-purple-500 text-white p-6 rounded-lg shadow-md hover:bg-purple-600 transition">
            <h3 class="text-xl font-semibold mb-2">Profile</h3>
            <p>Edit your profile information</p>
        </a>
    </div>

    <form method="POST" action="{{ route('logout') }}" class="inline">
        @csrf
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Logout</button>
    </form>
</div>
@endsection
