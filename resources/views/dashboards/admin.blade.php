@extends('layouts.default')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>
    <p>Welcome, {{ Auth::user()->userName }}!</p>
    <p>Role: {{ Auth::user()->userRole }}</p>
    <a href="{{ route('profile.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Edit Profile</a>
    <form method="POST" action="{{ route('logout') }}" class="inline">
        @csrf
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded ml-4">Logout</button>
    </form>
</div>
@endsection
