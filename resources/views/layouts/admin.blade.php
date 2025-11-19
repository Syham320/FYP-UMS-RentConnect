@extends('layouts.default')

@php $hideDefaultNavbar = true; @endphp

@section('head')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin/navbar.css') }}">
@endsection

@section('navbar')

<nav class="admin-navbar">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="{{ route('admin.home') }}" class="logo-link flex items-center space-x-3">
                <img src="{{ asset('images/profiles/UMSRentConnect_logo.svg') }}"
                    alt="UMS RentConnect Logo" class="h-10 w-auto filter drop-shadow-md">
                <span class="text-white font-bold text-xl hidden md:block">Admin Panel</span>
            </a>

            <!-- Right side: Hi username -->
            <div class="text-white font-medium">
                Hi, {{ Auth::user()->userName ?? 'Admin' }}!
            </div>
        </div>
    </div>
</nav>
@endsection

@section('content')

<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg flex flex-col min-h-screen">
        <div class="p-6 flex flex-col flex-1">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Admin Menu</h2>
            <nav class="space-y-2 flex-1">

                <a href="{{ route('admin.home') }}" class="block px-4 py-2 text-gray-700 hover:bg-red-100 rounded-lg {{ request()->routeIs('admin.home') ? 'bg-red-200' : '' }}">
                    <i class="fas fa-home mr-2"></i>Home
                </a>
                <a href="{{ route('admin.manage-listings') }}" class="block px-4 py-2 text-gray-700 hover:bg-red-100 rounded-lg {{ request()->routeIs('admin.manage-listings') ? 'bg-red-200' : '' }}">
                    <i class="fas fa-list mr-2"></i>Manage Listings
                </a>
                <a href="{{ route('admin.users') }}" class="block px-4 py-2 text-gray-700 hover:bg-red-100 rounded-lg {{ request()->routeIs('admin.users') ? 'bg-red-200' : '' }}">
                    <i class="fas fa-users mr-2"></i>Manage Users
                </a>
                <a href="{{ route('admin.accommodation') }}" class="block px-4 py-2 text-gray-700 hover:bg-red-100 rounded-lg {{ request()->routeIs('admin.accommodation') ? 'bg-red-200' : '' }}">
                    <i class="fas fa-file-alt mr-2"></i>Manage Accommodation
                </a>
                <a href="{{ route('admin.feedback') }}" class="block px-4 py-2 text-gray-700 hover:bg-red-100 rounded-lg {{ request()->routeIs('admin.feedback') ? 'bg-red-200' : '' }}">
                    <i class="fas fa-comments mr-2"></i>Manage Feedback
                </a>
                <a href="{{ route('admin.faqs.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-red-100 rounded-lg {{ request()->routeIs('admin.faqs.index') ? 'bg-red-200' : '' }}">
                    <i class="fas fa-question-circle mr-2"></i>Manage FAQs
                </a>
            </nav>

            <!-- Profile Section at Bottom -->
            <div class="mt-auto pt-6 border-t border-gray-200">
                @php
                    $user = Auth::user();
                @endphp
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-red-100 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-red-200' : '' }}">
                    <div class="flex-shrink-0 mr-3">
                        @if($user && $user->profileImg)
                            <img src="{{ asset('storage/' . $user->profileImg) }}" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                        @else
                            <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                                <span class="text-xs text-gray-600">{{ $user ? substr($user->userName, 0, 1) : 'A' }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $user ? $user->userName : 'Admin' }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ $user ? $user->userEmail : '' }}</p>
                    </div>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-100 rounded-lg border border-gray-300 hover:border-red-500 transition duration-200">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        @yield('admin-content')
    </main>
</div>
@endsection
